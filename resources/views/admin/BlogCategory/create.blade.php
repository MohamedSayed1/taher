@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Add Category') }}</h3>
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
        {!! Form::open(['route' => 'blogCategory.store', 'files' => true, 'id' => 'add-category-form']) !!}
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
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home8"
                                    role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                        class="hidden-xs-down">{{ trans('messages.English') }}</span></a> </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home7" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="name_ar">{{ trans('messages.Name Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::text('name_ar', null, [
                                                'onkeyup' => 'makeSlugar(this.value)',
                                                'id' => 'name_ar',
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
                                        <label for="slug_ar">{{ trans('messages.Slug Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::text('slug_ar', null, [
                                                'id' => 'slug_ar',
                                                'required' => 'required',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Slug Ar'),
                                            ]) !!}
                                        </div>
                                        @error('slug_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
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
                                            {!! Form::text('name_en', null, [
                                                'onkeyup' => 'makeSlugen(this.value)',
                                                'id' => 'name_en',
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
                                        <label for="slug_en">{{ trans('messages.Slug EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('slug_en', null, [
                                                'id' => 'slug_en',
                                                'required' => 'required',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Slug EN'),
                                            ]) !!}
                                        </div>
                                        @error('slug_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
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
                                            {!! Form::text('name_nl', null, [
                                                'onkeyup' => 'makeSlugnl(this.value)',
                                                'id' => 'name_nl',
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
                                        <label for="slug_nl">{{ trans('messages.Slug Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('slug_nl', null, [
                                                'id' => 'slug_nl',
                                                'required' => 'required',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Slug Nl'),
                                            ]) !!}
                                        </div>
                                        @error('slug_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="arrangement">{{ trans('messages.Arrangement') }}
                            </label>
                            <div>
                                {!! Form::number('arrangement', 0, [
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
        $(document).ready(function() {

        });

        function makeSlugar(val) {
            let str = val;
            let output = str.replace(/\s+/g, '-').toLowerCase();
            $('#slug_ar').val(output);
        }

        function makeSlugen(val) {
            let str = val;
            let output = str.replace(/\s+/g, '-').toLowerCase();
            $('#slug_en').val(output);
        }

        function makeSlugnl(val) {
            let str = val;
            let output = str.replace(/\s+/g, '-').toLowerCase();
            $('#slug_nl').val(output);
        }
    </script>
@endsection
