<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\PackageExam;
use App\Http\Requests\StorePackageExamRequest;
use App\Http\Requests\UpdatePackageExamRequest;

class PackageExamController extends Controller
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
     * @param  \App\Http\Requests\StorePackageExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageExamRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageExam  $packageExam
     * @return \Illuminate\Http\Response
     */
    public function show(PackageExam $packageExam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageExam  $packageExam
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageExam $packageExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageExamRequest  $request
     * @param  \App\Models\PackageExam  $packageExam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageExamRequest $request, PackageExam $packageExam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageExam  $packageExam
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageExam $packageExam)
    {
        //
    }
}
