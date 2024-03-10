<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Offer;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use Illuminate\Http\Request;

class OfferController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOfferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferRequest $request)
    {
        $offer = new Offer;
        $offer->title_ar = $request->title_ar;
        $offer->title_en = $request->title_en;
        $offer->title_nl = $request->title_nl;
        $offer->package_id  = $request->package_id;
        $offer->start_date = $request->start_date;
        $offer->end_date = $request->end_date;
        $offer->discount_amount = $request->discount_amount;
        $offer->save();
        return redirect()->route('package.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfferRequest  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $offer->title_ar = $request->title_ar;
        $offer->title_en = $request->title_en;
        $offer->title_nl = $request->title_nl;
        $offer->package_id  = $request->package_id;
        $offer->start_date = $request->start_date;
        $offer->end_date = $request->end_date;
        $offer->discount_amount = $request->discount_amount;
        $offer->save();
        return redirect()->route('package.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        //
    }

    public function getOfferDiscount(Request $request)
    {
        return Offer::find($request->id)->discount_amount;
    }
}
