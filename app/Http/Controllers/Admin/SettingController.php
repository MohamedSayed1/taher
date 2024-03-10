<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Exam;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::find(1);
        $exams = Exam::pluck('name_' . App::getLocale(), 'id');
        return view('admin.Setting.index', compact('settings', 'exams'));
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
     * @param  \App\Http\Requests\StoreSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        if ($request->file('home_meta_image')) {
            $request->home_meta_image = saveFile($request->file('home_meta_image'), 'Setting');
            $setting->home_meta_image = $request->home_meta_image;
        }
        if ($setting->default_lang != $request->default_lang) {
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = trim($request->default_lang);
                if (is_numeric(strpos(file_get_contents($path), 'DEFAULT_LANGUAGE')) && strpos(file_get_contents($path), 'DEFAULT_LANGUAGE') >= 0) {
                    file_put_contents($path, str_replace(
                        'DEFAULT_LANGUAGE=' . env('DEFAULT_LANGUAGE'),
                        'DEFAULT_LANGUAGE=' . $val,
                        file_get_contents($path)
                    ));
                } else {
                    file_put_contents($path, file_get_contents($path) . "\r\n" . 'DEFAULT_LANGUAGE' . '=' . $val);
                }
            }
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
        }
        $setting->home_meta_tags_ar = $request->home_meta_tags_ar;
        $setting->home_meta_tags_en = $request->home_meta_tags_en;
        $setting->exam_header_description_ar = $request->exam_header_description_ar;
        $setting->exam_header_description_en = $request->exam_header_description_en;
        $setting->exam_header_description_nl = $request->exam_header_description_nl;
        $setting->home_meta_tags_nl = $request->home_meta_tags_nl;
        $setting->home_meta_title_ar = $request->home_meta_title_ar;
        $setting->home_meta_title_en = $request->home_meta_title_en;
        $setting->home_meta_title_nl = $request->home_meta_title_nl;
        $setting->sit_title_ar = $request->sit_title_ar;
        $setting->sit_title_en = $request->sit_title_en;
        $setting->sit_title_nl = $request->sit_title_nl;
        $setting->home_meta_description_ar = $request->home_meta_description_ar;
        $setting->home_meta_description_en = $request->home_meta_description_en;
        $setting->home_meta_description_nl = $request->home_meta_description_nl;
        $setting->facebook = $request->facebook;
        $setting->tweeter = $request->tweeter;
        $setting->whatsapp = $request->whatsapp;
        $setting->lat = $request->lat;
        $setting->lon = $request->lon;
        $setting->youyube = $request->youyube;
        $setting->home_title_ar = $request->home_title_ar;
        $setting->home_title_en = $request->home_title_en;
        $setting->home_title_nl = $request->home_title_nl;
        $setting->home_description_ar = $request->home_description_ar;
        $setting->home_description_en = $request->home_description_en;
        $setting->home_description_nl = $request->home_description_nl;
        $setting->test_exam_id = $request->test_exam_id;
        $setting->why_eltaher_desc_ar = $request->why_eltaher_desc_ar;
        $setting->why_eltaher_desc_en = $request->why_eltaher_desc_en;
        $setting->why_eltaher_desc_nl = $request->why_eltaher_desc_nl;
        $setting->why_eltaher_first_title_ar = $request->why_eltaher_first_title_ar;
        $setting->why_eltaher_first_title_en = $request->why_eltaher_first_title_en;
        $setting->why_eltaher_first_title_nl = $request->why_eltaher_first_title_nl;
        $setting->why_eltaher_first_desc_ar = $request->why_eltaher_first_desc_ar;
        $setting->why_eltaher_first_desc_en = $request->why_eltaher_first_desc_en;
        $setting->why_eltaher_first_desc_nl = $request->why_eltaher_first_desc_nl;
        $setting->why_eltaher_secound_title_ar = $request->why_eltaher_secound_title_ar;
        $setting->why_eltaher_secound_title_en = $request->why_eltaher_secound_title_en;
        $setting->why_eltaher_secound_title_nl = $request->why_eltaher_secound_title_nl;
        $setting->why_eltaher_secound_desc_ar = $request->why_eltaher_secound_desc_ar;
        $setting->why_eltaher_secound_desc_en = $request->why_eltaher_secound_desc_en;
        $setting->why_eltaher_secound_desc_nl = $request->why_eltaher_secound_desc_nl;
        // $setting->lang = $request->lang;
        $setting->default_lang = $request->default_lang;
        $setting->lang_ar = ($request->lang_ar == 'on') ? true : false;
        $setting->lang_en = ($request->lang_en == 'on') ? true : false;
        $setting->lang_nl = ($request->lang_nl == 'on') ? true : false;
        $setting->reserve_exam_desc_ar = $request->reserve_exam_desc_ar;
        $setting->reserve_exam_desc_en = $request->reserve_exam_desc_en;
        $setting->reserve_exam_desc_nl = $request->reserve_exam_desc_nl;
        $setting->footer_desc_ar = $request->footer_desc_ar;
        $setting->footer_desc_en = $request->footer_desc_en;
        $setting->footer_desc_nl = $request->footer_desc_nl;
        $setting->main_phone = $request->main_phone;
        $setting->secoundry_phone = $request->secoundry_phone;
        $setting->email = $request->email;
        $setting->address_ar = $request->address_ar;
        $setting->address_en = $request->address_en;
        $setting->address_nl = $request->address_nl;
        $setting->login_youtube = $request->login_youtube;
        $setting->save();

        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
