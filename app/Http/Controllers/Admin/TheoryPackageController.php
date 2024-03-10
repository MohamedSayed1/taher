<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TheorySubscriptionExport;
use App\Http\Controllers\Controller;

use App\Models\TheoryPackage;
use App\Http\Requests\StoreTheoryPackageRequest;
use App\Http\Requests\UpdateTheoryPackageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class TheoryPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $packages = TheoryPackage::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $packages = $packages->where('name_' . App::getLocale(), 'like', '%' . $sort_search . '%');
        }
        $packages = $packages->paginate(20);
        return view('admin.TheoryPackage.index', compact('packages', 'sort_search'));
    }

    public function exportPackageSubscribtions($id)
    {
        return FacadesExcel::download(new TheorySubscriptionExport($id), 'TheoryPackageSubscribtion.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.TheoryPackage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTheoryPackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTheoryPackageRequest $request)
    {
        $package = new TheoryPackage;
        if ($request->file('image')) {
            $image = saveFile($request->file('image'), 'theorypackage');
            $package->image = $image;
        }
        if ($request->file('photo_phone')) {
            $image = saveFile($request->file('photo_phone'), 'theorypackage');
            $package->photo_phone = $image;
        }
        $package->name_ar = $request->name_ar;
        $package->color_border = $request->color_border;
        $package->color_background = $request->color_background;
        $package->name_en = $request->name_en;
        $package->name_nl = $request->name_nl;
        $package->short_desc_ar = $request->short_desc_ar;
        $package->short_desc_en = $request->short_desc_en;
        $package->short_desc_nl = $request->short_desc_nl;
        $package->notes_ar = $request->notes_ar;
        $package->notes_en = $request->notes_en;
        $package->notes_nl = $request->notes_nl;
        $package->price = $request->price;
        $package->expiration_duration_in_dayes = $request->expiration_duration_in_dayes;
        $package->arrangement = $request->arrangement;
        $package->show_in_home = ($request->show_in_home == 'on') ? true : false;
        $package->enable = ($request->enable == 'on') ? true : false;
        $package->save();
        return redirect()->route('theoryPackage.index');
    }

    public function updateEnabel(Request $request)
    {
        $package = TheoryPackage::findOrFail($request->id);
        $package->enable = $request->enable;
        if ($package->save()) {
            return 1;
        }
        return 0;
    }

    public function updateShowHome(Request $request)
    {
        $package = TheoryPackage::findOrFail($request->id);
        $package->show_in_home = $request->show_in_home;
        if ($package->save()) {
            return 1;
        }
        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TheoryPackage  $theoryPackage
     * @return \Illuminate\Http\Response
     */
    public function show(TheoryPackage $theoryPackage)
    {
        return view('admin.TheoryPackage.show', compact('theoryPackage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TheoryPackage  $theoryPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(TheoryPackage $theoryPackage)
    {
        return view('admin.TheoryPackage.edit', compact('theoryPackage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTheoryPackageRequest  $request
     * @param  \App\Models\TheoryPackage  $theoryPackage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTheoryPackageRequest $request, TheoryPackage $theoryPackage)
    {
        if ($request->file('image')) {
            $image = saveFile($request->file('image'), 'theorypackage');
            $theoryPackage->image = $image;
        }
        if ($request->file('photo_phone')) {
            $image = saveFile($request->file('photo_phone'), 'theorypackage');
            $theoryPackage->photo_phone = $image;
        }
        $theoryPackage->name_ar = $request->name_ar;
        $theoryPackage->name_en = $request->name_en;
        $theoryPackage->name_nl = $request->name_nl;
        $theoryPackage->color_border = $request->color_border;
        $theoryPackage->color_background = $request->color_background;
        $theoryPackage->notes_ar = $request->notes_ar;
        $theoryPackage->notes_en = $request->notes_en;
        $theoryPackage->notes_nl = $request->notes_nl;
        $theoryPackage->short_desc_ar = $request->short_desc_ar;
        $theoryPackage->short_desc_en = $request->short_desc_en;
        $theoryPackage->short_desc_nl = $request->short_desc_nl;
        $theoryPackage->price = $request->price;
        $theoryPackage->expiration_duration_in_dayes = $request->expiration_duration_in_dayes;
        $theoryPackage->arrangement = $request->arrangement;
        $theoryPackage->show_in_home = ($request->show_in_home == 'on') ? true : false;
        $theoryPackage->enable = ($request->enable == 'on') ? true : false;
        $theoryPackage->save();
        return redirect()->route('theoryPackage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TheoryPackage  $theoryPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(TheoryPackage $theoryPackage)
    {
        $theoryPackage->delete();
        session()->flash('notif', trans('messages.Blog deleted successfully'));
        return redirect()->route('theoryPackage.index');
    }
}
