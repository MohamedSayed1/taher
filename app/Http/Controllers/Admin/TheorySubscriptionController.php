<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\TheorySubscription;
use App\Http\Requests\StoreTheorySubscriptionRequest;
use App\Http\Requests\UpdateTheorySubscriptionRequest;
use App\Models\User;
use Illuminate\Http\Request;

class TheorySubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $theory_package_id = $request->tpid;
        $clients = User::orderBy('created_at', 'desc')->where('user_type', 'Client')->pluck('name', 'id');
        return view('admin.TheorySubscription.create', compact('theory_package_id', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTheorySubscriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTheorySubscriptionRequest $request)
    {
        $subscription = new TheorySubscription;
        $subscription->user_id = $request->user_id;
        $subscription->theory_package_id = $request->theory_package_id;
        $subscription->price  = $request->price;
        $subscription->subscription_date = $request->subscription_date;
        $subscription->expiration_date = $request->expiration_date;
        $subscription->whatsapp = $request->whatsapp;
        $subscription->save();
        return redirect()->route('theoryPackage.show', $subscription->theory_package_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TheorySubscription  $theorySubscription
     * @return \Illuminate\Http\Response
     */
    public function show(TheorySubscription $theorySubscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TheorySubscription  $theorySubscription
     * @return \Illuminate\Http\Response
     */
    public function edit(TheorySubscription $theorySubscription)
    {
        $clients = User::orderBy('created_at', 'desc')->where('user_type', 'Client')->pluck('name', 'id');
        return view('admin.TheorySubscription.edit', compact('theorySubscription','clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTheorySubscriptionRequest  $request
     * @param  \App\Models\TheorySubscription  $theorySubscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTheorySubscriptionRequest $request, TheorySubscription $theorySubscription)
    {
        $theorySubscription->user_id = $request->user_id;
        $theorySubscription->theory_package_id = $request->theory_package_id;
        $theorySubscription->price  = $request->price;
        $theorySubscription->subscription_date = $request->subscription_date;
        $theorySubscription->expiration_date = $request->expiration_date;
        $theorySubscription->whatsapp = $request->whatsapp;
        $theorySubscription->save();
        return redirect()->route('theoryPackage.show', $theorySubscription->theory_package_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TheorySubscription  $theorySubscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(TheorySubscription $theorySubscription)
    {
        $redirect_id  =  $theorySubscription->theory_package_id;
        $theorySubscription->delete();
        session()->flash('notif', trans('messages.Package deleted successfully'));
        return redirect()->route('theoryPackage.show', $redirect_id);
    }
}
