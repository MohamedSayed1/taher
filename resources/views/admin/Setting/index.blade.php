@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Edit Faq') }}</h3>
            </div>

        </div>
    </div>

    <style>
        .bootstrap-tagsinput {
            width: 100%;
            padding: 0.6em;
        }
    </style>
    <!-- Main content -->

    <section class="content">
        {!! Form::open([
            'method' => 'PUT',
            'route' => ['setting.update', $settings->id],
            'files' => true,
            'id' => 'edit-settings-form',
        ]) !!}

        <div class="box">
            <div class="box-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab2" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><span
                                class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                class="hidden-xs-down">{{ trans('messages.Header Info') }}</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><span
                                class="hidden-sm-up"><i class="ion-person"></i></span> <span
                                class="hidden-xs-down">{{ trans('messages.Footer Info') }}</span></a> </li>

                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile8" role="tab"><span
                                class="hidden-sm-up"><i class="ion-person"></i></span> <span
                                class="hidden-xs-down">{{ trans('messages.Why Info') }}</span></a> </li>

                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile9" role="tab"><span
                                class="hidden-sm-up"><i class="ion-person"></i></span> <span
                                class="hidden-xs-down">{{ trans('messages.Reserve Info') }}</span></a> </li>

                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile10" role="tab"><span
                                class="hidden-sm-up"><i class="ion-person"></i></span> <span
                                class="hidden-xs-down">{{ trans('messages.Other Info') }}</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile12" role="tab"><span
                                class="hidden-sm-up"><i class="ion-person"></i></span> <span
                                class="hidden-xs-down">{{ trans('messages.Exam Header Info') }}</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile11" role="tab"><span
                                class="hidden-sm-up"><i class="ion-person"></i></span> <span
                                class="hidden-xs-down">{{ trans('messages.Meta Info') }}</span></a> </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home7" role="tabpanel">
                        <div class="p-15">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_title_ar">{{ trans('messages.Title Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::text('home_title_ar', $settings->home_title_ar, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Title Ar'),
                                            ]) !!}
                                        </div>
                                        @error('home_title_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_title_en">{{ trans('messages.Title EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('home_title_en', $settings->home_title_en, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Title EN'),
                                            ]) !!}
                                        </div>
                                        @error('home_title_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_title_nl">{{ trans('messages.Title Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('home_title_nl', $settings->home_title_nl, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Title Nl'),
                                            ]) !!}
                                        </div>
                                        @error('home_title_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_description_ar">{{ trans('messages.Description Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('home_description_ar', $settings->home_description_ar, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description Ar'),
                                            ]) !!}
                                        </div>
                                        @error('home_description_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_description_en">{{ trans('messages.Description EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('home_description_en', $settings->home_description_en, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description EN'),
                                            ]) !!}
                                        </div>
                                        @error('home_description_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_description_nl">{{ trans('messages.Description Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('home_description_nl', $settings->home_description_nl, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description Nl'),
                                            ]) !!}
                                        </div>
                                        @error('home_description_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="login_youtube">{{ trans('messages.login_youtube') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('login_youtube', $settings->login_youtube, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.login_youtube'),
                                            ]) !!}
                                        </div>
                                        @error('login_youtube')
                                        <div class="badge badge-danger text-center" style="width: 100%">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="profile7" role="tabpanel">
                        <div class="p-15">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="footer_desc_ar">{{ trans('messages.Description Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('footer_desc_ar', $settings->footer_desc_ar, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description Ar'),
                                            ]) !!}
                                        </div>
                                        @error('footer_desc_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="footer_desc_en">{{ trans('messages.Description EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('footer_desc_en', $settings->footer_desc_en, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description EN'),
                                            ]) !!}
                                        </div>
                                        @error('footer_desc_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="footer_desc_nl">{{ trans('messages.Description Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('footer_desc_nl', $settings->footer_desc_nl, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description Nl'),
                                            ]) !!}
                                        </div>
                                        @error('footer_desc_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="main_phone">{{ trans('messages.Main phone') }}
                                        </label>
                                        <div>
                                            {!! Form::text('main_phone', $settings->main_phone, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Main phone'),
                                            ]) !!}
                                        </div>
                                        @error('main_phone')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="secoundry_phone">{{ trans('messages.Secoundry phone') }}
                                        </label>
                                        <div>
                                            {!! Form::text('secoundry_phone', $settings->secoundry_phone, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Secoundry phone'),
                                            ]) !!}
                                        </div>
                                        @error('secoundry_phone')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="email">{{ trans('messages.E-mail') }}
                                        </label>
                                        <div>
                                            {!! Form::text('email', $settings->email, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.E-mail'),
                                            ]) !!}
                                        </div>
                                        @error('email')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="address_ar">{{ trans('messages.Address Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::text('address_ar', $settings->address_ar, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Address Ar'),
                                            ]) !!}
                                        </div>
                                        @error('address_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="address_en">{{ trans('messages.Address EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('address_en', $settings->address_en, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Address EN'),
                                            ]) !!}
                                        </div>
                                        @error('address_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="address_nl">{{ trans('messages.Address Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('address_nl', $settings->address_nl, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Address Nl'),
                                            ]) !!}
                                        </div>
                                        @error('address_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="lat">{{ trans('messages.Latitude') }}
                                        </label>
                                        <div>
                                            {!! Form::number('lat', $settings->lat, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Latitude'),
                                            ]) !!}
                                        </div>
                                        @error('lat')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="lon">{{ trans('messages.Longitude') }}
                                        </label>
                                        <div>
                                            {!! Form::number('lon', $settings->lon, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Longitude'),
                                            ]) !!}
                                        </div>
                                        @error('lon')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="facebook">{{ trans('messages.Facebook') }}
                                        </label>
                                        <div>
                                            {!! Form::text('facebook', $settings->facebook, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Facebook'),
                                            ]) !!}
                                        </div>
                                        @error('facebook')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="tweeter">{{ trans('messages.Tweeter') }}
                                        </label>
                                        <div>
                                            {!! Form::text('tweeter', $settings->tweeter, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Tweeter'),
                                            ]) !!}
                                        </div>
                                        @error('tweeter')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="whatsapp">{{ trans('messages.Whatsapp') }}
                                        </label>
                                        <div>
                                            {!! Form::text('whatsapp', $settings->whatsapp, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Whatsapp'),
                                            ]) !!}
                                        </div>
                                        @error('whatsapp')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="youyube">{{ trans('messages.Youyube') }}
                                        </label>
                                        <div>
                                            {!! Form::text('youyube', $settings->youyube, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Youyube'),
                                            ]) !!}
                                        </div>
                                        @error('youyube')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile8" role="tabpanel">
                        <div class="p-15">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="why_eltaher_desc_ar">{{ trans('messages.Description Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('why_eltaher_desc_ar', $settings->why_eltaher_desc_ar, [
                                                'class' => 'form-control',
                                                'rows' => 3,
                                                'placeholder' => trans('messages.Description Ar'),
                                            ]) !!}
                                        </div>
                                        @error('why_eltaher_desc_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="why_eltaher_desc_en">{{ trans('messages.Description EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('why_eltaher_desc_en', $settings->why_eltaher_desc_en, [
                                                'class' => 'form-control',
                                                'rows' => 3,
                                                'placeholder' => trans('messages.Description EN'),
                                            ]) !!}
                                        </div>
                                        @error('why_eltaher_desc_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="why_eltaher_desc_nl">{{ trans('messages.Description Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('why_eltaher_desc_nl', $settings->why_eltaher_desc_nl, [
                                                'class' => 'form-control',
                                                'rows' => 3,
                                                'placeholder' => trans('messages.Description Nl'),
                                            ]) !!}
                                        </div>
                                        @error('why_eltaher_desc_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <h3>{{ trans('messages.First card') }}</h3>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="why_eltaher_first_title_ar">{{ trans('messages.Title Ar') }}
                                                </label>
                                                <div>
                                                    {!! Form::text('why_eltaher_first_title_ar', $settings->why_eltaher_first_title_ar, [
                                                        'class' => 'form-control',
                                                        'placeholder' => trans('messages.Title Ar'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_first_title_ar')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="why_eltaher_first_title_en">{{ trans('messages.Title EN') }}
                                                </label>
                                                <div>
                                                    {!! Form::text('why_eltaher_first_title_en', $settings->why_eltaher_first_title_en, [
                                                        'class' => 'form-control',
                                                        'placeholder' => trans('messages.Title EN'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_first_title_en')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="why_eltaher_first_title_nl">{{ trans('messages.Title Nl') }}
                                                </label>
                                                <div>
                                                    {!! Form::text('why_eltaher_first_title_nl', $settings->why_eltaher_first_title_nl, [
                                                        'class' => 'form-control',
                                                        'placeholder' => trans('messages.Title Nl'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_first_title_nl')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label
                                                    for="why_eltaher_first_desc_ar">{{ trans('messages.Description Ar') }}
                                                </label>
                                                <div>
                                                    {!! Form::textarea('why_eltaher_first_desc_ar', $settings->why_eltaher_first_desc_ar, [
                                                        'class' => 'form-control',
                                                        'rows' => 3,
                                                        'placeholder' => trans('messages.Description Ar'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_first_desc_ar')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label
                                                    for="why_eltaher_first_desc_en">{{ trans('messages.Description EN') }}
                                                </label>
                                                <div>
                                                    {!! Form::textarea('why_eltaher_first_desc_en', $settings->why_eltaher_first_desc_en, [
                                                        'class' => 'form-control',
                                                        'rows' => 3,
                                                        'placeholder' => trans('messages.Description EN'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_first_desc_en')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label
                                                    for="why_eltaher_first_desc_nl">{{ trans('messages.Description Nl') }}
                                                </label>
                                                <div>
                                                    {!! Form::textarea('why_eltaher_first_desc_nl', $settings->why_eltaher_first_desc_nl, [
                                                        'class' => 'form-control',
                                                        'rows' => 3,
                                                        'placeholder' => trans('messages.Description Nl'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_first_desc_nl')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <h3>{{ trans('messages.Secound card') }}</h3>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="why_eltaher_secound_title_ar">{{ trans('messages.Title Ar') }}
                                                </label>
                                                <div>
                                                    {!! Form::text('why_eltaher_secound_title_ar', $settings->why_eltaher_secound_title_ar, [
                                                        'class' => 'form-control',
                                                        'placeholder' => trans('messages.Title Ar'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_secound_title_ar')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="why_eltaher_secound_title_en">{{ trans('messages.Title EN') }}
                                                </label>
                                                <div>
                                                    {!! Form::text('why_eltaher_secound_title_en', $settings->why_eltaher_secound_title_en, [
                                                        'class' => 'form-control',
                                                        'placeholder' => trans('messages.Title EN'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_secound_title_en')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="why_eltaher_secound_title_nl">{{ trans('messages.Title Nl') }}
                                                </label>
                                                <div>
                                                    {!! Form::text('why_eltaher_secound_title_nl', $settings->why_eltaher_secound_title_nl, [
                                                        'class' => 'form-control',
                                                        'placeholder' => trans('messages.Title Nl'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_secound_title_nl')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label
                                                    for="why_eltaher_secound_desc_ar">{{ trans('messages.Description Ar') }}
                                                </label>
                                                <div>
                                                    {!! Form::textarea('why_eltaher_secound_desc_ar', $settings->why_eltaher_secound_desc_ar, [
                                                        'class' => 'form-control',
                                                        'rows' => 3,
                                                        'placeholder' => trans('messages.Description Ar'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_secound_desc_ar')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label
                                                    for="why_eltaher_secound_desc_en">{{ trans('messages.Description EN') }}
                                                </label>
                                                <div>
                                                    {!! Form::textarea('why_eltaher_secound_desc_en', $settings->why_eltaher_secound_desc_en, [
                                                        'class' => 'form-control',
                                                        'rows' => 3,
                                                        'placeholder' => trans('messages.Description EN'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_secound_desc_en')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label
                                                    for="why_eltaher_secound_desc_nl">{{ trans('messages.Description Nl') }}
                                                </label>
                                                <div>
                                                    {!! Form::textarea('why_eltaher_secound_desc_nl', $settings->why_eltaher_secound_desc_nl, [
                                                        'class' => 'form-control',
                                                        'rows' => 3,
                                                        'placeholder' => trans('messages.Description Nl'),
                                                    ]) !!}
                                                </div>
                                                @error('why_eltaher_secound_desc_nl')
                                                    <div class="badge badge-danger text-center" style="width: 100%">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile9" role="tabpanel">
                        <div class="p-15">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="reserve_exam_desc_ar">{{ trans('messages.Description Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('reserve_exam_desc_ar', $settings->reserve_exam_desc_ar, [
                                                'class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('messages.Description Ar'),
                                            ]) !!}
                                        </div>
                                        @error('reserve_exam_desc_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="reserve_exam_desc_en">{{ trans('messages.Description EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('reserve_exam_desc_en', $settings->reserve_exam_desc_en, [
                                                'class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('messages.Description EN'),
                                            ]) !!}
                                        </div>
                                        @error('reserve_exam_desc_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="reserve_exam_desc_nl">{{ trans('messages.Description Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('reserve_exam_desc_nl', $settings->reserve_exam_desc_nl, [
                                                'class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('messages.Description Nl'),
                                            ]) !!}
                                        </div>
                                        @error('reserve_exam_desc_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile10" role="tabpanel">
                        <div class="p-15">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="sit_title_ar">{{ trans('messages.Site title Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::text('sit_title_ar', $settings->sit_title_ar, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Site title Ar'),
                                            ]) !!}
                                        </div>
                                        @error('sit_title_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="sit_title_en">{{ trans('messages.Site title EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('sit_title_en', $settings->sit_title_en, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Site title EN'),
                                            ]) !!}
                                        </div>
                                        @error('sit_title_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="sit_title_nl">{{ trans('messages.Site title Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('sit_title_nl', $settings->sit_title_nl, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Site title Nl'),
                                            ]) !!}
                                        </div>
                                        @error('sit_title_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="name">{{ trans('messages.Choose test Exam') }}
                                        </label>
                                        <div>
                                            {!! Form::select('test_exam_id', $exams, $settings->test_exam_id, [
                                                'class' => 'form-control select2',
                                                'style' => 'width:100%',
                                                'data-placeholder' => trans('messages.Exam'),
                                            ]) !!}

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="name">{{ trans('messages.Site Languages') }}
                                    </label>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    {!! Form::checkbox('lang_ar', null, $settings->lang_ar, ['id' => 'Checkbox_2']) !!}
                                                    <label for="Checkbox_2">AR</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    {!! Form::checkbox('lang_en', null, $settings->lang_en, ['id' => 'Checkbox_1']) !!}
                                                    <label for="Checkbox_1">EN</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    {!! Form::checkbox('lang_nl', null, $settings->lang_nl, ['id' => 'Checkbox_3']) !!}
                                                    <label for="Checkbox_3">NL</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    {{-- <div class="form-group">

                                        <div>
                                            {!! Form::select(
                                                'lang',
                                                [
                                                    'all' => trans('messages.All'),
                                                    'ar_nl' => trans('messages.Arabic & Netherland'),
                                                    'ar' => trans('messages.Arabic'),
                                                ],
                                                $settings->lang,
                                                [
                                                    'class' => 'form-control select2',
                                                    'style' => 'width:100%',
                                                    'data-placeholder' => trans('messages.Exam'),
                                                ],
                                            ) !!}

                                        </div>

                                    </div> --}}
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Default Lang</label>
                                    <div class="form-group">
                                        <div>
                                            {!! Form::select(
                                                'default_lang',
                                                [
                                                    'ar' => 'AR',
                                                    'en' => 'EN',
                                                    'nl' => 'NL',
                                                ],
                                                $settings->default_lang,
                                                [
                                                    'class' => 'form-control select2',
                                                    'style' => 'width:100%',
                                                ],
                                            ) !!}

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile11" role="tabpanel">
                        <div class="p-15">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_meta_title_ar">{{ trans('messages.Title Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::text('home_meta_title_ar', $settings->home_meta_title_ar, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Title Ar'),
                                            ]) !!}
                                        </div>
                                        @error('home_meta_title_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_meta_title_en">{{ trans('messages.Title EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('home_meta_title_en', $settings->home_meta_title_en, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Title EN'),
                                            ]) !!}
                                        </div>
                                        @error('home_meta_title_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_meta_title_nl">{{ trans('messages.Title Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('home_meta_title_nl', $settings->home_meta_title_nl, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Title Nl'),
                                            ]) !!}
                                        </div>
                                        @error('home_meta_title_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_meta_description_ar">{{ trans('messages.Description Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('home_meta_description_ar', $settings->home_meta_description_ar, [
                                                'class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('messages.Description Ar'),
                                            ]) !!}
                                        </div>
                                        @error('home_meta_description_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_meta_description_en">{{ trans('messages.Description EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('home_meta_description_en', $settings->home_meta_description_en, [
                                                'class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('messages.Description EN'),
                                            ]) !!}
                                        </div>
                                        @error('home_meta_description_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_meta_description_nl">{{ trans('messages.Description Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('home_meta_description_nl', $settings->home_meta_description_nl, [
                                                'class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('messages.Description Nl'),
                                            ]) !!}
                                        </div>
                                        @error('home_meta_description_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_meta_tags_ar">{{ trans('messages.Tags Ar') }}
                                        </label>
                                        <div class="tags-default">
                                            {!! Form::text('home_meta_tags_ar', $settings->home_meta_tags_ar, [
                                                'class' => 'form-control',
                                                'data-role' => 'tagsinput',
                                                'placeholder' => trans('messages.Tags Ar'),
                                            ]) !!}
                                        </div>
                                        @error('home_meta_tags_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_meta_tags_en">{{ trans('messages.Tags EN') }}
                                        </label>
                                        <div class="tags-default">
                                            {!! Form::text('home_meta_tags_en', $settings->home_meta_tags_en, [
                                                'class' => 'form-control',
                                                'data-role' => 'tagsinput',
                                                'placeholder' => trans('messages.Tags EN'),
                                            ]) !!}
                                        </div>
                                        @error('home_meta_tags_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="home_meta_tags_nl">{{ trans('messages.Tags Nl') }}
                                        </label>
                                        <div class="tags-default">
                                            {!! Form::text('home_meta_tags_nl', $settings->home_meta_tags_nl, [
                                                'class' => 'form-control',
                                                'data-role' => 'tagsinput',
                                                'placeholder' => trans('messages.Tags Nl'),
                                            ]) !!}
                                        </div>
                                        @error('home_meta_tags_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 mx-auto">
                                    <div class="custom-file-container">
                                        <div class="custom-file">
                                            <input type="file" name="home_meta_image" class="custom-file-input"
                                                id="home_meta_image">
                                            <label class="custom-file-label"
                                                for="home_meta_image">{{ trans('Image') }}</label>
                                        </div>

                                        <div class="bg-lightest p-10 rounded5 dvPreview text-center"
                                            style="width: 100%;margin-top: 1em;height: 10em;">
                                            <img style="max-width: 100%;height: 100%"
                                                src="{{ $settings->home_meta_image ? url($settings->home_meta_image) : url('/images/noimg.png') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    @error('home_meta_image')
                                        <div class="badge badge-danger text-center" style="width: 100%">
                                            {{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile12" role="tabpanel">
                        <div class="p-15">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="exam_header_description_ar">{{ trans('messages.Description Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('exam_header_description_ar', $settings->exam_header_description_ar, [
                                                'class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('messages.Description Ar'),
                                            ]) !!}
                                        </div>
                                        @error('exam_header_description_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="exam_header_description_en">{{ trans('messages.Description EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('exam_header_description_en', $settings->exam_header_description_en, [
                                                'class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('messages.Description EN'),
                                            ]) !!}
                                        </div>
                                        @error('exam_header_description_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="exam_header_description_nl">{{ trans('messages.Description Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('exam_header_description_nl', $settings->exam_header_description_nl, [
                                                'class' => 'form-control',
                                                'rows' => 5,
                                                'placeholder' => trans('messages.Description Nl'),
                                            ]) !!}
                                        </div>
                                        @error('exam_header_description_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                    <i class="ti-save-alt"></i> {{ trans('messages.Save') }}
                </button>
            </div>
        </div>

        {!! Form::Close() !!}
    </section>
@endsection


@section('script')
    <script type="text/javascript">
        $('.select2').select2();
        CKEDITOR.replace('editor1')
        CKEDITOR.replace('editoren')
        CKEDITOR.replace('editor2')
        $(document).ready(function() {
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection
