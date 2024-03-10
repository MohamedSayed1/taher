<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\SubscriptionEmail;
use App\Models\Offer;
use App\Models\Package;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\TheoryPackage;
use App\Models\TheorySubscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\Session;
use Validator;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_subscriptions = Subscription::where('user_id', auth()->user()->id)->whereDate('expiration_date', '>', now())->get();
        $previous_subscriptions = Subscription::where('user_id', auth()->user()->id)->whereDate('expiration_date', '<', now())->get();
        return view('site.account', compact('current_subscriptions', 'previous_subscriptions'));
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return redirect()->back()->with("error", trans('messages.Your current password does not matches with the password you provided. Please try again.'));
        }

        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", trans('messages.New Password cannot be same as your current password. Please choose a different password.'));
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect()->back()->with("success", trans('messages.Password changed successfully !'));
    }


    public function choseStart()
    {


        if(Auth()->check())
        {
            $if_subscribed = Subscription::where(['user_id' => auth()->user()->id])->whereDate('expiration_date', '>', now())->first();
            if ($if_subscribed != null) {
                return redirect()->route('exams');
            }else{
                $packeds = Package::where('active',1)->get();
                $methods= Mollie::api()->methods->allActive();
                return  view('site.getpayment')
                    ->with('packeds',$packeds)
                    ->with('methods',$methods);
            }
        }else{
            $youtube = Setting::first()->login_youtube;
            if ($youtube != null) {
                $regExp = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/';
                $match = preg_match($regExp, $youtube, $matches);
                $video_id = ($match && strlen($matches[7]) == 11) ? $matches[7] : 'not_valid';
            }
            $youtubeId = isset($video_id)?$video_id:null;
            return  view('site.register-gate')
                ->with('youtubeId',$youtubeId);
        }

    }
    public function purchasePackage(Request $request)
    {
        $data = $request->all();
        $rules = [
            'package' => 'required'
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails())
        {
            return redirect()->back()->with($validator->errors());
        }

        $package = Package::find($data['package']);
        if ($package->offer) {
            $type = 'offer';
            $id = $package->offer->id;
        } else {
            $type = 'package';
            $id = $package->id;
        }
        if ($type == 'package') {
            $package = Package::find($id);
            if ($package) {
                    $payment = Mollie::api()->payments->create([
                        "amount" => [
                            "currency" => "EUR",
                            "value" => number_format($package->price, 2, '.', '')  // You must send the correct number of decimals, thus we enforce the use of strings
                        ],
                        "description" => "Purchase Package #" . $package->{'name_' . App::getLocale()},
                        "redirectUrl" => route('purchaseDone', auth()->user()->id),
                        "webhookUrl" => route('webhooks.mollie'),
                        "metadata" => [
                            "order_id" => $id . auth()->user()->id,
                            "price" => $package->price,
                            "expiration_duration_in_dayes" => $package->expiration_duration_in_dayes,
                            "package_id" => $package->id,
                            "offer_discount" => 0,
                            "offer_id" => null,
                            "user_id" => auth()->user()->id,
                            "user_name" => auth()->user()->name,
                            "lang" => App::getLocale(),
                        ],
                        "method" => $data['payment'],
                    ]);
                    return redirect($payment->getCheckoutUrl(), 303);
            } else {
                abort(404);
            }
        } elseif ($type == 'offer') {
            $offer = Offer::find($id);
            if ($offer) {
                if (Carbon::now()->gt(date('Y-m-d H:i', strtotime($offer->end_date)))) {
                    return redirect()->back()->with("error1", trans('messages.This offer is expired you can subscrib available offers'));
                }
                    if (($offer->package->price - $offer->discount_amount) < 0) {
                        return redirect()->back()->with("error1", trans('messages.This offer is expired you can subscrib available offers'));
                    }
                    // return number_format(($offer->package->price - $offer->discount_amount), 2, '.', '');
                    $payment = Mollie::api()->payments->create([
                        "amount" => [
                            "currency" => "EUR",
                            "value" => number_format(($offer->package->price - $offer->discount_amount), 2, '.', '')  // You must send the correct number of decimals, thus we enforce the use of strings
                        ],
                        "description" => "Purchase Package #" . $offer->package->{'name_' . App::getLocale()},
                        "redirectUrl" => route('purchaseDone', auth()->user()->id),
                        "webhookUrl" => route('webhooks.mollie'),
                        "metadata" => [
                            "order_id" => $id . auth()->user()->id,
                            "price" => $offer->package->price,
                            "expiration_duration_in_dayes" => $offer->package->expiration_duration_in_dayes,
                            "package_id" => $offer->package->id,
                            "offer_discount" => $offer->discount_amount,
                            "offer_id" => $offer->id,
                            "user_id" => auth()->user()->id,
                            "user_name" => auth()->user()->name,
                            "lang" => App::getLocale(),
                        ],
                        "method" => $data['payment'],
                    ]);
                    return redirect($payment->getCheckoutUrl(), 303);

            } else {
                abort(404);
            }
        }
    }

    public function purchaseTheoryPackage(Request $request)
    {

        $package = TheoryPackage::find($request->theory_package);
        $whatsapp_num = $request->whatsapp_num;
        $name = $request->name;
        $email = $request->email;
        if ($package) {
            if (Auth::check()) {
                $if_subscribed = TheorySubscription::where(['user_id' => auth()->user()->id, 'theory_package_id' => $request->theory_package])->whereDate('expiration_date', '>', now())->first();
                if ($if_subscribed) {
                    return redirect()->route('viewTheoryPackage', $request->theory_package)->with("error", trans('messages.You already subscriped this package'));
                }
            }else{
                $subscription = new TheorySubscription;
                $subscription->theory_package_id =  $package->id;
                $subscription->whatsapp = $whatsapp_num;
                $subscription->name = $name;
                $subscription->email = $email;
                $subscription->price = $package->price;
                $subscription->user_id = null;
                $subscription->subscription_date = date('Y-m-d H:i');
                $subscription->expiration_date = date('Y-m-d H:i', strtotime('+' . $package->expiration_duration_in_dayes . ' days'));
                $subscription->pay_type = 'not_paid';
                $subscription->is_paid = 0;
                $subscription->massage = "processing";
                $subscription->save();
                $idSub = $subscription->id;
            }
            // add new Record with not paid
            $user_id= Auth::check() ? auth()->user()->id : 0;
            $payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => number_format($package->price, 2, '.', '')  // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                "description" => "Purchase Package #" . $package->{'name_' . App::getLocale()},
                "redirectUrl" => route('purchaseTheoryDone', [Auth::check() ? auth()->user()->id : 0, $request->theory_package,isset($idSub)?$idSub:0]),
                "webhookUrl" => route('webhooks.mollieTheory'),
                "metadata" => [
                    "order_id" => $request->theory_package . $user_id,
                    "price" => $package->price,
                    "expiration_duration_in_dayes" => $package->expiration_duration_in_dayes,
                    "theory_package_id" => $package->id,
                    "whatsapp_num" => $whatsapp_num,
                    "name" => $name,
                    "email" => $email,
                    "subid" => isset($idSub)?$idSub:0,
                    "user_id" => Auth::check() ? Auth::user()->id : 0,
                    "user_name" => Auth::check() ? Auth::user()->name : $name,
                    "user_type" => Auth::check() ? 'user' : 'guest',
                    "lang" => App::getLocale(),
                ],
            ]);
            return redirect($payment->getCheckoutUrl(), 303);

        } else {
            abort(404);
        }
    }

    public function handleWebhookNotification(Request $request)
    {
        $setting = Setting::find(1);
        $data['first_phone'] = $setting->main_phone;
        $data['secound_phone'] = $setting->secoundry_phone;
        $data['email'] = $setting->email;
        $data['address_ar'] = $setting->address_ar;
        $data['address_nl'] = $setting->address_nl;
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);
        $oldsubscribtion = Subscription::where(['user_id' => $payment->metadata->user_id, 'package_id' => $payment->metadata->package_id])->first();
        $updateUserFlash = User::find($payment->metadata->user_id);
        if ($payment->isPaid()) {
            $oldsubscribtion = Subscription::where(['user_id' => $payment->metadata->user_id, 'package_id' => $payment->metadata->package_id])->first();
            if ($oldsubscribtion) {
                $oldsubscribtion->offer_discount = $payment->metadata->offer_discount;
                $oldsubscribtion->price = $payment->metadata->price;
                $oldsubscribtion->subscription_date = date('Y-m-d H:i');
                $oldsubscribtion->expiration_date = date('Y-m-d H:i', strtotime('+' . $payment->metadata->expiration_duration_in_dayes . ' days'));
                $oldsubscribtion->pay_type = 'visa';
                $oldsubscribtion->renewed_times += 1;
                $oldsubscribtion->save();
                $data['user'] = $updateUserFlash;
                $data['packageName'] = $oldsubscribtion->package->{'name_' . $payment->metadata->lang};
                $data['subscribtion'] = $oldsubscribtion;
                $data['lang'] = $payment->metadata->lang;
                Mail::to($updateUserFlash->email)->send(new SubscriptionEmail($data));
                // Mail::to('Adnaanaltaher@aatheorie.nl')->send(new SubscriptionEmail($data));
            } else {
                $subscription = new Subscription;
                $subscription->package_id = $payment->metadata->package_id;
                $subscription->offer_id = $payment->metadata->offer_id;
                $subscription->offer_discount = $payment->metadata->offer_discount;
                $subscription->price = $payment->metadata->price;
                $subscription->user_id = $payment->metadata->user_id;
                $subscription->subscription_date = date('Y-m-d H:i');
                $subscription->expiration_date = date('Y-m-d H:i', strtotime('+' . $payment->metadata->expiration_duration_in_dayes . ' days'));
                $subscription->pay_type = 'visa';
                $subscription->save();
                $data['user'] = $updateUserFlash;
                $data['packageName'] = $subscription->package->{'name_' . $payment->metadata->lang};
                $data['subscribtion'] = $subscription;
                $data['lang'] = $payment->metadata->lang;
                Mail::to($updateUserFlash->email)->send(new SubscriptionEmail($data));

                //  Mail::to('Adnaanaltaher@aatheorie.nl')->send(new SubscriptionEmail($data));
            }
            $updateUserFlash->flash_message = trans('messages.Subscribed successfully');
            $updateUserFlash->package_id = null;
            $updateUserFlash->save();
        } elseif ($payment->isCanceled()) {
            $updateUserFlash->flash_message = trans('messages.Payment canceled');
            $updateUserFlash->save();
        } elseif ($payment->isExpired()) {
            $updateUserFlash->flash_message = trans('messages.Payment expired');
            $updateUserFlash->save();
        } elseif ($payment->isFailed()) {
            $updateUserFlash->flash_message = trans('messages.Payment Failed');
            $updateUserFlash->save();
        }
    }

    public function handleWebhookTheoryNotification(Request $request)
    {
        $setting = Setting::find(1);
        $data['first_phone'] = $setting->main_phone;
        $data['secound_phone'] = $setting->secoundry_phone;
        $data['email'] = $setting->email;
        $data['address_ar'] = $setting->address_ar;
        $data['address_nl'] = $setting->address_nl;
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);
        if ($payment->metadata->user_type == "user") {
        $updateUserFlash = User::find($payment->metadata->user_id);
        if ($payment->isPaid()) {
                $oldsubscribtion = TheorySubscription::where(['user_id' => $payment->metadata->user_id, 'theory_package_id' => $payment->metadata->theory_package_id])->first();
                if (!empty($oldsubscribtion)) {
                    $oldsubscribtion->price = $payment->metadata->price;
                    $oldsubscribtion->whatsapp = $payment->metadata->whatsapp_num;
                    $oldsubscribtion->subscription_date = date('Y-m-d H:i');
                    $oldsubscribtion->expiration_date = date('Y-m-d H:i', strtotime('+' . $payment->metadata->expiration_duration_in_dayes . ' days'));
                    $oldsubscribtion->pay_type = 'visa';
                    $oldsubscribtion->renewed_times += 1;
                    $oldsubscribtion->save();
                    $data['user'] = $updateUserFlash;
                    $data['packageName'] = $oldsubscribtion->package->{'name_' . $payment->metadata->lang};
                    $data['subscribtion'] = $oldsubscribtion;
                    $data['lang'] = $payment->metadata->lang;
                    Mail::to($updateUserFlash->email)->send(new SubscriptionEmail($data));
                    //   Mail::to('Adnaanaltaher@aatheorie.nl')->send(new SubscriptionEmail($data));
                } else {
                    $subscription = new TheorySubscription;
                    $subscription->theory_package_id = $payment->metadata->theory_package_id;
                    $subscription->whatsapp = $payment->metadata->whatsapp_num;
                    $subscription->price = $payment->metadata->price;
                    $subscription->user_id = $payment->metadata->user_id;
                    $subscription->subscription_date = date('Y-m-d H:i');
                    $subscription->expiration_date = date('Y-m-d H:i', strtotime('+' . $payment->metadata->expiration_duration_in_dayes . ' days'));
                    $subscription->pay_type = 'visa';
                    $subscription->save();
                    $data['user'] = $updateUserFlash;
                    $data['packageName'] = $subscription->package->{'name_' . $payment->metadata->lang};
                    $data['subscribtion'] = $subscription;
                    $data['lang'] = $payment->metadata->lang;
                    Mail::to($updateUserFlash->email)->send(new SubscriptionEmail($data));
                    //   Mail::to('Adnaanaltaher@aatheorie.nl')->send(new SubscriptionEmail($data));
                }
                $updateUserFlash->flash_message = trans('messages.Subscribed successfully');
                $updateUserFlash->save();
            } elseif ($payment->isCanceled()) {
                $updateUserFlash->flash_message = trans('messages.Payment canceled');
                $updateUserFlash->save();
            } elseif ($payment->isExpired()) {
                $updateUserFlash->flash_message = trans('messages.Payment expired');
                $updateUserFlash->save();
            } elseif ($payment->isFailed()) {
                $updateUserFlash->flash_message = trans('messages.Payment Failed');
                $updateUserFlash->save();
            }
        } else {
            // not User Guest Have record in subscrib
           $sub =  TheorySubscription::find($payment->metadata->subid);
            if($payment->isPaid())
            {

                $data['user'] = ['name'=>$sub->name];
                $data['packageName'] = $sub->package->{'name_' . $payment->metadata->lang};
                $data['subscribtion'] = $sub;
                $data['lang'] = $payment->metadata->lang;
                Mail::to($sub->email)->send(new SubscriptionEmail($data));
                $sub->massage  = trans('messages.Subscribed successfully');
                $sub->pay_type ='visa';
                $sub->is_paid =1;
                $sub->save();
            }elseif ($payment->isCanceled()) {
                $sub->massage = trans('messages.Payment canceled');
                $sub->save();
            } elseif ($payment->isExpired()) {
                $sub->massage  = trans('messages.Payment expired');
                $sub->save();
            } elseif ($payment->isFailed()) {
                $sub->massage  = trans('messages.Payment Failed');
                $sub->save();
            }
        }
    }

    public
    function purchaseDone($user_id)
    {
        $updateUserFlash = User::find($user_id);
        $flash_message = $updateUserFlash->flash_message;
        $updateUserFlash->flash_message = null;
        $updateUserFlash->save();
        return redirect()->route('home')->with("success", $flash_message);
    }

    public
    function purchaseTheoryDone($user_id, $package_id,$subid)
    {
        if($user_id == 0)
        {
            $sub =  TheorySubscription::find($subid);
            $flash_message = $sub->massage;
        }else{
            $updateUserFlash = User::find($user_id);
            $flash_message = $updateUserFlash->flash_message;
            $updateUserFlash->flash_message = null;
            $updateUserFlash->save();
        }
        return redirect()->route('viewTheoryPackage', $package_id)->with("success", $flash_message);

    }

    public
    function examSetting(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->enabel_sound = ($request->enabel_sound == 'on') ? true : false;
        $user->save();
        return redirect()->route('exams');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }

    public function paymentAfterlogin()
    {
        $package = Package::find(Auth::user()->package_id);
        if ($package->offer) {
            $type = 'offer';
            $id = $package->offer->id;
        } else {
            $type = 'package';
            $id = $package->id;
        }
        if ($type == 'package') {
            if ($package) {
                $payment = Mollie::api()->payments->create([
                    "amount" => [
                        "currency" => "EUR",
                        "value" => number_format($package->price, 2, '.', '')  // You must send the correct number of decimals, thus we enforce the use of strings
                    ],
                    "description" => "Purchase Package #" . $package->{'name_' . App::getLocale()},
                    "redirectUrl" => route('purchaseDone', Auth::user()->id),
                    "webhookUrl" => route('webhooks.mollie'),
                    "metadata" => [
                        "order_id" => $id . Auth::user()->id,
                        "price" => $package->price,
                        "expiration_duration_in_dayes" => $package->expiration_duration_in_dayes,
                        "package_id" => $package->id,
                        "offer_discount" => 0,
                        "offer_id" => null,
                        "user_id" => Auth::user()->id,
                        "user_name" => Auth::user()->name,
                        "lang" => App::getLocale(),
                    ],
                ]);
                return redirect($payment->getCheckoutUrl(), 303);
            }
        } else{
            $offer = Offer::find($id);
            if ($offer) {
                $payment = Mollie::api()->payments->create([
                    "amount" => [
                        "currency" => "EUR",
                        "value" => number_format(($offer->package->price - $offer->discount_amount), 2, '.', '')  // You must send the correct number of decimals, thus we enforce the use of strings
                    ],
                    "description" => "Purchase Package #" . $offer->package->{'name_' . App::getLocale()},
                    "redirectUrl" => route('purchaseDone', Auth::user()->id),
                    "webhookUrl" => route('webhooks.mollie'),
                    "metadata" => [
                        "order_id" => $id . Auth::user()->id,
                        "price" => $offer->package->price,
                        "expiration_duration_in_dayes" => $offer->package->expiration_duration_in_dayes,
                        "package_id" => $offer->package->id,
                        "offer_discount" => $offer->discount_amount,
                        "offer_id" => $offer->id,
                        "user_id" => Auth::user()->id,
                        "user_name" => Auth::user()->name,
                        "lang" => App::getLocale(),
                    ],
                ]);

                return redirect($payment->getCheckoutUrl(), 303);
            }
        }
    }
}
