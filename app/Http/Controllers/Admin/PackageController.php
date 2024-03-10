<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Package;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Exam;
use App\Models\Offer;
use App\Models\PackageExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $packages = Package::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $packages = $packages->where('name_' . App::getLocale(), 'like', '%' . $sort_search . '%');
        }
        $packages = $packages->paginate(20);
        return view('admin.Package.index', compact('packages', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exams = Exam::pluck('name_' . App::getLocale(), 'id');
        return view('admin.Package.create', compact('exams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageRequest $request)
    {

        $package = new Package;
        if($request->file('photo_desktop'))
        {
            $nameDesk =   saveFile($request->file('photo_desktop'), 'package');
            $package->photo_desktop = $nameDesk;
        }
        if($request->file('photo_phone'))
        {
            $namePhone = saveFile($request->file('photo_phone'), 'package');
            $package->photo_phone = $namePhone;
        }
        if($request->file('cove_phone_en'))
        {
            $namePhone = saveFile($request->file('cove_phone_en'), 'package');
            $package->cove_phone_en = $namePhone;
        }
        if($request->file('cove_phone_nl'))
        {
            $namePhone = saveFile($request->file('cove_phone_nl'), 'package');
            $package->cove_phone_nl = $namePhone;
        }
        if($request->file('cove_phone_ar'))
        {
            $namePhone = saveFile($request->file('cove_phone_ar'), 'package');
            $package->cove_phone_ar = $namePhone;
        }
        if($request->file('cove_desktop_nl'))
        {
            $namePhone = saveFile($request->file('cove_desktop_nl'), 'package');
            $package->cove_desktop_nl = $namePhone;
        }
        if($request->file('cove_desktop_en'))
        {
            $namePhone = saveFile($request->file('cove_desktop_en'), 'package');
            $package->cove_desktop_en = $namePhone;
        }
        if($request->file('cove_desktop_ar'))
        {
            $namePhone = saveFile($request->file('cove_desktop_ar'), 'package');
            $package->cove_desktop_ar = $namePhone;
        }
        $package->type_view = $request->type_view;
        $package->name_ar = $request->name_ar;
        $package->name_en = $request->name_en;
        $package->name_nl = $request->name_nl;
        $package->notes_ar = $request->notes_ar;
        $package->notes_en = $request->notes_en;
        $package->notes_nl = $request->notes_nl;
        $package->price = $request->price;
        $package->expiration_duration_in_dayes = $request->expiration_duration_in_dayes;
        $package->badge_ar = $request->badge_ar;
        $package->badge_en = $request->badge_en;
        $package->badge_nl = $request->badge_nl;
        $package->arrangement = $request->arrangement;
        $package->color_background = $request->color_background;
        $package->color_border = $request->color_border;
        $package->active = ($request->active == 'on') ? true : false;
        $package->show_in_home = ($request->show_in_home == 'on') ? true : false;
        $package->save();
        $package->exams()->sync($request->exams);
        $package->exam_count = sizeof($request->exams);
        $package->save();
        return redirect()->route('package.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        ///return$package;
        $exams = Exam::pluck('name_' . App::getLocale(), 'id');
        return view('admin.Package.edit', compact('package', 'exams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageRequest  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        if($request->file('photo_desktop'))
        {
            $nameDesk =   saveFile($request->file('photo_desktop'), 'package');
            $package->photo_desktop = $nameDesk;
        }
        if($request->file('photo_phone'))
        {
            $namePhone = saveFile($request->file('photo_phone'), 'package');
            $package->photo_phone = $namePhone;
        }
        if($request->file('cove_phone_en'))
        {
            $namePhone = saveFile($request->file('cove_phone_en'), 'package');
            $package->cove_phone_en = $namePhone;
        }
        if($request->file('cove_phone_nl'))
        {
            $namePhone = saveFile($request->file('cove_phone_nl'), 'package');
            $package->cove_phone_nl = $namePhone;
        }
        if($request->file('cove_phone_ar'))
        {
            $namePhone = saveFile($request->file('cove_phone_ar'), 'package');
            $package->cove_phone_ar = $namePhone;
        }
        if($request->file('cove_desktop_nl'))
        {
            $namePhone = saveFile($request->file('cove_desktop_nl'), 'package');
            $package->cove_desktop_nl = $namePhone;
        }
        if($request->file('cove_desktop_en'))
        {
            $namePhone = saveFile($request->file('cove_desktop_en'), 'package');
            $package->cove_desktop_en = $namePhone;
        }
        if($request->file('cove_desktop_ar'))
        {
            $namePhone = saveFile($request->file('cove_desktop_ar'), 'package');
            $package->cove_desktop_ar = $namePhone;
        }

        $package->type_view = $request->type_view;
        $package->name_ar = $request->name_ar;
        $package->name_en = $request->name_en;
        $package->name_nl = $request->name_nl;
        $package->notes_ar = $request->notes_ar;
        $package->notes_en = $request->notes_en;
        $package->notes_nl = $request->notes_nl;
        $package->price = $request->price;
        $package->expiration_duration_in_dayes = $request->expiration_duration_in_dayes;
        $package->badge_ar = $request->badge_ar;
        $package->badge_en = $request->badge_en;
        $package->badge_nl = $request->badge_nl;
        $package->arrangement = $request->arrangement;
        $package->show_in_home = ($request->show_in_home == 'on') ? true : false;
        $package->active = ($request->active == 'on') ? true : false;
        $package->exam_count = PackageExam::where('package_id', $package->id)->count();
        $package->color_background = $request->color_background;
        $package->color_border = $request->color_border;
        $package->save();
        $package->exams()->sync($request->exams);
        $package->exam_count = sizeof($request->exams);
        $package->save();
        return redirect()->route('package.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();
        session()->flash('notif', trans('messages.Package deleted successfully'));
        return redirect()->route('package.index');
    }

    public function cerateEditOffer(Request $request)
    {
        $package = Package::find($request->id);
        if ($package->offer) {
            return view('admin.Offer.edit', compact('package'));
        } else {
            return view('admin.Offer.create', compact('package'));
        }
    }

    public function getPackageOffers(Request $request)
    {
        $offers = Offer::where('package_id', $request->id)->pluck('title_' . App::getLocale(), 'id');
        return view('admin.package.partials.offers', compact('offers'));
    }

    public function getPackagePrice(Request $request)
    {
        return Package::find($request->id)->price;
    }

    public function changeActive(Request $request)
    {
        $package = Package::find($request->id);
        if(!empty($package))
        {
            $package->active =  $package->active == 1 ?0:1;
            return $package->save();
        }
        return false;
    }

}
