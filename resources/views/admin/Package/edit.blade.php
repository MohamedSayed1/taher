@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Edit Package') }}</h3>
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
            'route' => ['package.update', $package->id],
            'files' => true,
            'id' => 'edit-package-form',
        ]) !!}
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="box">
                    <div class="box-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs customtab2" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home7"
                                                    role="tab"><span class="hidden-sm-up"><i
                                            class="ion-home"></i></span> <span
                                        class="hidden-xs-down">{{ trans('messages.Arabic') }}</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile7"
                                                    role="tab"><span class="hidden-sm-up"><i
                                            class="ion-person"></i></span> <span
                                        class="hidden-xs-down">{{ trans('messages.Netherland') }}</span></a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#home8"
                                                    role="tab"><span class="hidden-sm-up"><i
                                            class="ion-home"></i></span> <span
                                        class="hidden-xs-down">{{ trans('messages.English') }}</span></a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home7" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="name_ar">{{ trans('messages.Name Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::text('name_ar', $package->name_ar, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Name Ar'),
                                            ]) !!}
                                        </div>
                                        @error('name_ar')
                                        <div class="badge badge-danger text-center" style="width: 100%">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="badge_ar">{{ trans('messages.Badge Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::text('badge_ar', $package->badge_ar, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Badge Ar'),
                                            ]) !!}
                                        </div>
                                        @error('badge_ar')
                                        <div class="badge badge-danger text-center" style="width: 100%">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="notes_ar">{{ trans('messages.Notes Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('notes_ar', $package->notes_ar, [
                                                'id' => 'editor1',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Notes Ar'),
                                            ]) !!}
                                        </div>
                                        @error('notes_ar')
                                        <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="home8" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="name_en">{{ trans('messages.Name EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('name_en', $package->name_en, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Name EN'),
                                            ]) !!}
                                        </div>
                                        @error('name_en')
                                        <div class="badge badge-danger text-center" style="width: 100%">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="badge_en">{{ trans('messages.Badge EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('badge_en', $package->badge_en, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Badge EN'),
                                            ]) !!}
                                        </div>
                                        @error('badge_en')
                                        <div class="badge badge-danger text-center" style="width: 100%">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="notes_en">{{ trans('messages.Notes EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('notes_en', $package->notes_en, [
                                                'id' => 'editoren',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Notes EN'),
                                            ]) !!}
                                        </div>
                                        @error('notes_en')
                                        <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile7" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="name_nl">{{ trans('messages.Name Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('name_nl', $package->name_nl, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Name Nl'),
                                            ]) !!}
                                        </div>
                                        @error('name_nl')
                                        <div class="badge badge-danger text-center" style="width: 100%">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="badge_nl">{{ trans('messages.Badge Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('badge_nl', $package->badge_nl, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Badge Nl'),
                                            ]) !!}
                                        </div>
                                        @error('badge_nl')
                                        <div class="badge badge-danger text-center" style="width: 100%">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="notes_nl">{{ trans('messages.Notes Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('notes_nl', $package->notes_nl, [
                                                'id' => 'editor2',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Notes Nl'),
                                            ]) !!}
                                        </div>
                                        @error('notes_nl')
                                        <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ trans('messages.Exams') }}
                            </label>
                            <div>
                                {!! Form::select('exams[]', $exams, $package->exams, [
                                    'multiple' => 'multiple',
                                    'class' => 'form-control select2',
                                    'data-placeholder' => trans('messages.Exams'),
                                ]) !!}

                            </div>

                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('messages.Price') }}
                            </label>
                            <div>
                                {!! Form::number('price', $package->price, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Price'),
                                ]) !!}
                            </div>
                            @error('price')
                            <div class="badge badge-danger text-center" style="width: 100%">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="expiration_duration_in_dayes">{{ trans('messages.Expiration duration') }}
                            </label>
                            <div>
                                {!! Form::number('expiration_duration_in_dayes', $package->expiration_duration_in_dayes, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Expiration duration'),
                                ]) !!}
                            </div>
                            @error('expiration_duration_in_dayes')
                            <div class="badge badge-danger text-center" style="width: 100%">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="arrangement">{{ trans('messages.Arrangement') }}
                            </label>
                            <div>
                                {!! Form::number('arrangement', $package->arrangement, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Expiration duration'),
                                ]) !!}
                            </div>
                            @error('arrangement')
                            <div class="badge badge-danger text-center" style="width: 100%">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-12 mx-auto">
                                    <div class="custom-file-container">
                                        <div class="custom-file">
                                            <input type="file" name="photo_phone" class="custom-file-input" id="image">
                                            <label class="custom-file-label"
                                                   for="image">{{ trans('messages.photo_phone') }}</label>
                                        </div>
                                        <div class="bg-lightest p-10 rounded5 dvPreview text-center"
                                             style="width: 100%;margin-top: 1em;height: 10em;">
                                            @if(!empty($package->photo_phone) && file_exists(public_path().'/'.$package->photo_phone))

                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/'.$package->photo_phone) }}"
                                                     alt="">
                                            @else
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/images/noimg.png') }}"
                                                     alt="">
                                            @endif
                                        </div>
                                    </div>
                                    @error('photo_phone')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 mx-auto">
                                    <div class="custom-file-container_2">
                                        <div class="custom-file_2">
                                            <input type="file" name="photo_desktop" class="custom-file-input_2"
                                                   id="image_2">
                                            <label class="custom-file-label"
                                                   for="image_2">{{ trans('messages.photo_desktop') }}</label>
                                        </div>
                                        <div
                                            class="bg-lightest p-10 rounded5 dvPreview text-center custem-css-templet_2"
                                            style="width: 100%;margin-top: 1em;height: 10em;">
                                            @if(!empty($package->photo_desktop) && file_exists(public_path().'/'.$package->photo_desktop))
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/'.$package->photo_desktop) }}"
                                                     alt="">
                                            @else
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/images/noimg.png') }}"
                                                     alt="">
                                            @endif
                                        </div>
                                    </div>
                                    @error('photo_desktop')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="arrangement">{{ trans('messages.color_background') }}
                                    </label>
                                    <div>
                                        {!! Form::color('color_background',$package->color_background ,[
                                             'class' => 'form-control',
                                         ]) !!}
                                    </div>
                                    @error('color_background')
                                    <div class="badge badge-danger text-center" style="width: 100%">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label for="arrangement">{{ trans('messages.color_border') }}
                                    </label>
                                    <div>
                                        {!! Form::color('color_border',$package->color_border, [
                                             'class' => 'form-control',
                                         ]) !!}
                                    </div>
                                    @error('color_border')
                                    <div class="badge badge-danger text-center" style="width: 100%">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                {!! Form::checkbox('show_in_home', null, $package->show_in_home, ['id' => 'show_in_home']) !!}
                                <label for="show_in_home">{{ trans('messages.Show in home') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                {!! Form::checkbox('active', null,$package->active, ['id' => 'active']) !!}
                                <label for="active">{{ trans('messages.Enabled') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label-default" for="type_view">{{__('messages.type_view')}}:</label>
                            <select class="form-control select2-container" name="type_view" id="type_view">
                                <option value="text"
                                @if(old('type_view')!=null)
                                    {{old('type_view') == 'text'?'selected':''}}
                                    @else
                                    {{$package->type_view == 'text'?'selected':''}}
                                    @endif
                                >{{__('messages.choseText')}}</option>
                                <option value="photo"
                                @if(old('type_view')!=null)
                                    {{old('type_view') == 'photo'?'selected':''}}
                                    @else
                                    {{$package->type_view == 'photo'?'selected':''}}
                                    @endif
                                >{{__('messages.chosephoto')}}</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-12 mx-auto">
                                    <div class="custom-file-container">
                                        <div class="cove_desktop_ar_file">
                                            <input type="file" name="cove_desktop_ar" class="cove_desktop_ar-input"
                                                   id="cove_desktop_ar">
                                            <label class="custom-file-label"
                                                   for="cove_desktop_ar">{{ trans('messages.cove_desktop_ar') }}</label>
                                        </div>
                                        <div class="bg-lightest p-10 rounded5 dvPreview text-center cove_desktop_ar"
                                             style="width: 100%;margin-top: 1em;height: 10em;">
                                            @if(!empty($package->cove_desktop_ar) && file_exists(public_path().'/'.$package->cove_desktop_ar))
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/'.$package->cove_desktop_ar) }}"
                                                     alt="">
                                            @else
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/images/noimg.png') }}"
                                                     alt="">
                                            @endif
                                        </div>
                                    </div>
                                    @error('cove_desktop_ar')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 mx-auto">
                                    <div class="custom-file-container_2">
                                        <div class="cove_phone_ar_2">
                                            <input type="file" name="cove_phone_ar" class="cove_phone_ar_2"
                                                   id="cove_phone_ar">
                                            <label class="custom-file-label"
                                                   for="cove_phone_ar">{{ trans('messages.cove_phone_ar') }}</label>
                                        </div>
                                        <div class="bg-lightest p-10 rounded5 dvPreview text-center cove_phone_ar_2"
                                             style="width: 100%;margin-top: 1em;height: 10em;">

                                            @if(!empty($package->cove_phone_ar) && file_exists(public_path().'/'.$package->cove_phone_ar))
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/'.$package->cove_phone_ar) }}"
                                                     alt="">
                                            @else
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/images/noimg.png') }}"
                                                     alt="">
                                            @endif
                                        </div>
                                    </div>
                                    @error('cove_phone_ar')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-12 mx-auto">
                                    <div class="custom-file-container_2">
                                        <div class="cove_desktop_en_2">
                                            <input type="file" name="cove_desktop_en" class="cove_desktop_en_2"
                                                   id="cove_desktop_en">
                                            <label class="custom-file-label"
                                                   for="cove_desktop_en">{{ trans('messages.cove_desktop_en') }}</label>
                                        </div>
                                        <div class="bg-lightest p-10 rounded5 dvPreview text-center cove_desktop_en_2"
                                             style="width: 100%;margin-top: 1em;height: 10em;">

                                            @if(!empty($package->cove_desktop_en) && file_exists(public_path().'/'.$package->cove_desktop_en))
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/'.$package->cove_desktop_en) }}"
                                                     alt="">
                                            @else
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/images/noimg.png') }}"
                                                     alt="">
                                            @endif
                                        </div>
                                    </div>
                                    @error('cove_desktop_en')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 mx-auto">
                                    <div class="custom-file-container_2">
                                        <div class="cove_phone_en_2">
                                            <input type="file" name="cove_phone_en" class="cove_phone_en_2"
                                                   id="cove_phone_en">
                                            <label class="custom-file-label"
                                                   for="cove_phone_en">{{ trans('messages.cove_phone_en') }}</label>
                                        </div>
                                        <div class="bg-lightest p-10 rounded5 dvPreview text-center cove_phone_en_2"
                                             style="width: 100%;margin-top: 1em;height: 10em;">

                                            @if(!empty($package->cove_phone_en) && file_exists(public_path().'/'.$package->cove_phone_en))
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/'.$package->cove_phone_en) }}"
                                                     alt="">
                                            @else
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/images/noimg.png') }}"
                                                     alt="">
                                            @endif
                                        </div>
                                    </div>
                                    @error('cove_phone_en')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-12 mx-auto">
                                    <div class="custom-file-container_2">
                                        <div class="cove_desktop_nl_2">
                                            <input type="file" name="cove_desktop_nl" class="cove_desktop_nl_2"
                                                   id="cove_desktop_nl">
                                            <label class="custom-file-label"
                                                   for="cove_desktop_nl">{{ trans('messages.cove_desktop_nl') }}</label>
                                        </div>
                                        <div class="bg-lightest p-10 rounded5 dvPreview text-center cove_desktop_nl_2"
                                             style="width: 100%;margin-top: 1em;height: 10em;">
                                            @if(!empty($package->cove_desktop_nl) && file_exists(public_path().'/'.$package->cove_desktop_nl))
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/'.$package->cove_desktop_nl) }}"
                                                     alt="">
                                            @else
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/images/noimg.png') }}"
                                                     alt="">
                                            @endif
                                        </div>
                                    </div>
                                    @error('cove_desktop_nl')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 mx-auto">
                                    <div class="custom-file-container_2">
                                        <div class="cove_phone_nl_2">
                                            <input type="file" name="cove_phone_nl" class="cove_phone_nl_2"
                                                   id="cove_phone_nl">
                                            <label class="custom-file-label"
                                                   for="cove_phone_nl">{{ trans('messages.cove_phone_nl') }}</label>
                                        </div>
                                        <div class="bg-lightest p-10 rounded5 dvPreview text-center cove_phone_nl_2"
                                             style="width: 100%;margin-top: 1em;height: 10em;">
                                            @if(!empty($package->cove_phone_nl) && file_exists(public_path().'/'.$package->cove_phone_nl))
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/'.$package->cove_phone_nl) }}"
                                                     alt="">
                                            @else
                                                <img style="max-width: 100%;height: 100%;"
                                                     src="{{ url('/images/noimg.png') }}"
                                                     alt="">
                                            @endif
                                        </div>
                                    </div>
                                    @error('cove_phone_en')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                    </div>
                                    @enderror
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
        $(document).ready(function () {
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
        $(".custom-file-input_2").change(function () {
            var img_src = jQuery(this).parents('.custom-file_2').parents('.custom-file-container_2').find("img");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {

                        img_src.attr("src", e.target.result);
                        $('.custem-css-templet_2 img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {
                alert("Please upload a valid image file.");
            }
        });

        $(".cove_phone_ar_2").change(function () {
            var img_src = jQuery(this).parents('.cove_phone_ar_2').parents('.custom-file-container_2').find("img");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {

                        img_src.attr("src", e.target.result);
                        $('.cove_phone_ar_2 img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {
                alert("Please upload a valid image file.");
            }
        });
        $(".cove_desktop_en_2").change(function () {
            var img_src = jQuery(this).parents('.cove_desktop_en_2').parents('.custom-file-container_2').find("img");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {

                        img_src.attr("src", e.target.result);
                        $('.cove_desktop_en img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {

            }
        });
        $(".cove_phone_en_2").change(function () {
            var img_src = jQuery(this).parents('.cove_phone_en_2').parents('.custom-file-container_2').find("img");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {

                        img_src.attr("src", e.target.result);
                        $('.cove_phone_en img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {

            }
        });
        $(".cove_phone_nl_2").change(function () {
            var img_src = jQuery(this).parents('.cove_phone_nl_2').parents('.custom-file-container_2').find("img");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {

                        img_src.attr("src", e.target.result);
                        $('.cove_phone_nl img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {

            }
        });
        $(".cove_desktop_nl_2").change(function () {
            var img_src = jQuery(this).parents('.cove_desktop_nl_2').parents('.custom-file-container_2').find("img");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {

                        img_src.attr("src", e.target.result);
                        $('.cove_desktop_nl img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            }
        });
        $(".cove_desktop_ar-input").change(function () {
            var img_src = jQuery(this).parents('.cove_desktop_ar_file').parents('.cove_desktop_ar').find("img");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {

                        img_src.attr("src", e.target.result);
                        $('.cove_desktop_ar img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {

            }
        });
    </script>
@endsection
