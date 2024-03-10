@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Add Youtub Video') }}</h3>
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
        {!! Form::open(['route' => 'youtubVideos.store', 'files' => true, 'id' => 'add-youtubVideos-form']) !!}
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="box">
                    <div class="box-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs customtab2" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home7"
                                    role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                        class="hidden-xs-down">{{ trans('messages.Arabic') }}</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7"
                                    role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span
                                        class="hidden-xs-down">{{ trans('messages.Netherland') }}</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home8" role="tab"><span
                                        class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                        class="hidden-xs-down">{{ trans('messages.English') }}</span></a> </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home7" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="title">{{ trans('messages.Title Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::text('title_ar', null, [
                                                'id' => 'title_ar',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Title Ar'),
                                            ]) !!}
                                        </div>
                                        @error('title_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description_ar">{{ trans('messages.Description Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('description_ar', null, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description Ar'),
                                            ]) !!}
                                        </div>
                                        @error('description_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="home8" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="title">{{ trans('messages.Title EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('title_en', null, [
                                                'id' => 'title_en',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Title EN'),
                                            ]) !!}
                                        </div>
                                        @error('title_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description_en">{{ trans('messages.Description EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('description_en', null, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description EN'),
                                            ]) !!}
                                        </div>
                                        @error('description_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile7" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="title_nl">{{ trans('messages.Title Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('title_nl', null, [
                                                'id' => 'title_nl',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Title Nl'),
                                            ]) !!}
                                        </div>
                                        @error('title_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description_nl">{{ trans('messages.Description Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('description_nl', null, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description Nl'),
                                            ]) !!}
                                        </div>
                                        @error('description_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ trans('messages.Video type') }}
                            </label>
                            <div>
                                {!! Form::select(
                                    'video_type',
                                    [
                                        'youtube' => trans('messages.Youtube'),
                                        'tiktok' => trans('messages.Tiktok'),
                                        'instagram' => trans('messages.Instagram'),
                                    ],
                                    null,
                                    [
                                        'class' => 'form-control',
                                        'data-placeholder' => trans('Video type'),
                                    ],
                                ) !!}

                            </div>
                            @error('video_type')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="video_link">{{ trans('messages.Video Link') }}
                            </label>
                            <div>
                                {!! Form::text('video_link', null, [
                                    'id' => 'video_link',
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Video Link'),
                                ]) !!}
                            </div>
                            @error('video_link')
                                <div class="badge badge-danger text-center" style="width: 100%">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 mx-auto">
                                <div class="custom-file-container">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label"
                                            for="image">{{ trans('messages.Image') }}</label>
                                    </div>
                                    <div class="bg-lightest p-10 rounded5 dvPreview text-center"
                                        style="width: 100%;margin-top: 1em;height: 10em;">
                                        <img style="max-width: 100%;height: 100%;" src="{{ url('/images/noimg.png') }}"
                                            alt="">
                                    </div>
                                </div>
                                @error('image')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                {!! Form::checkbox('enabel', null, 1, ['id' => 'Checkbox_1']) !!}
                                <label for="Checkbox_1">{{ trans('messages.Enable') }}</label>
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
    <script type="text/javascript"></script>
@endsection
