<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Subscription;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Offer;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request;
        $user_id = null;
        $package_id = null;
        $from = date('Y-m-d');
        $to = date('Y-m-d');
        $subscriptions = Subscription::orderBy('created_at', 'desc');
        if ($request->has('package_id') && $request->package_id != null) {
            $package_id = $request->package_id;
            $subscriptions = $subscriptions->where('package_id', $package_id);
        }
        if ($request->has('user_id') && $request->user_id != null) {
            $user_id  = $request->user_id;
            $subscriptions = $subscriptions->where('user_id', $user_id);
        }
        if ($request->has('from') && $request->has('to')) {
            $subscriptions->where('subscription_date', '<=', date('Y-m-d', strtotime($request->from)));
            $subscriptions->where('expiration_date', '>=', date('Y-m-d', strtotime($request->to)));
            $from = $request->from;
            $to = $request->to;
        }
        $subscriptions = $subscriptions->paginate(20);
        $packages = Package::get();
        $users = User::where('user_type', 'Client')->get();
        return view('admin.Subscription.index', compact('subscriptions', 'package_id', 'user_id', 'packages', 'users', 'from', 'to'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $packages = Package::pluck('name_' . App::getLocale(), 'id');
        $offers = Offer::pluck('title_' . App::getLocale(), 'id');
        $clients = User::orderBy('created_at', 'desc')->where('user_type', 'Client')->pluck('name', 'id');
        $user_id = $request->user_id;
        return view('admin.Subscription.create', compact('packages', 'offers', 'user_id', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubscriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionRequest $request)
    {
        $subscription = new Subscription;
        $subscription->user_id = $request->user_id;
        $subscription->package_id = $request->package_id;
        $subscription->offer_id  = $request->offer_id;
        $subscription->price  = $request->price;
        $subscription->offer_discount = $request->offer_discount;
        $subscription->subscription_date = $request->subscription_date;
        $subscription->expiration_date = $request->expiration_date;
        $subscription->save();
        return redirect()->route('client.show', $subscription->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        $packages = Package::pluck('name_' . App::getLocale(), 'id');
        $offers = Offer::where('package_id', $subscription->package_id)->pluck('title_' . App::getLocale(), 'id');
        return view('admin.Subscription.edit', compact('subscription', 'packages', 'offers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriptionRequest  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->package_id = $request->package_id;
        $subscription->offer_id  = $request->offer_id;
        $subscription->price  = $request->price;
        $subscription->offer_discount = $request->offer_discount;
        $subscription->subscription_date = $request->subscription_date;
        $subscription->expiration_date = $request->expiration_date;
        $subscription->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        session()->flash('notif', trans('messages.Moderator deleted successfully'));
        return redirect()->back();
    }
}
