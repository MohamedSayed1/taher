@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Edit Blog') }}</h3>
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
            'route' => ['blog.update', $blog->id],
            'files' => true,
            'id' => 'edit-pade-form',
        ]) !!}
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
                                            {!! Form::text('title_ar', $blog->title_ar, [
                                                'onkeyup' => 'makeSlugar(this.value)',
                                                'id' => 'title_ar',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Tilte Ar'),
                                            ]) !!}
                                        </div>
                                        @error('title_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug_ar">{{ trans('messages.Slug Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::text('slug_ar', $blog->slug_ar, [
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

                                    <div class="form-group">
                                        <label for="tags_ar">{{ trans('messages.Tags Ar') }}
                                        </label>
                                        <div class="tags-default">
                                            {!! Form::text('tags_ar', $blog->tags_ar, [
                                                'class' => 'form-control',
                                                'data-role' => 'tagsinput',
                                                'placeholder' => trans('messages.Tags Ar'),
                                            ]) !!}
                                        </div>
                                        @error('tags_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description_ar">{{ trans('messages.Description Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('description_ar', $blog->description_ar, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description Ar'),
                                            ]) !!}
                                        </div>
                                        @error('description_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="body_ar">{{ trans('messages.Body Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('body_ar', $blog->body_ar, [
                                                'id' => 'editor1',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Body Ar'),
                                            ]) !!}
                                        </div>
                                        @error('body_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane active" id="home8" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="title">{{ trans('messages.Title EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('title_en', $blog->title_en, [
                                                'onkeyup' => 'makeSlugen(this.value)',
                                                'id' => 'title_en',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Tilte EN'),
                                            ]) !!}
                                        </div>
                                        @error('title_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug_en">{{ trans('messages.Slug EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('slug_en', $blog->slug_en, [
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

                                    <div class="form-group">
                                        <label for="tags_en">{{ trans('messages.Tags EN') }}
                                        </label>
                                        <div class="tags-default">
                                            {!! Form::text('tags_en', $blog->tags_en, [
                                                'class' => 'form-control',
                                                'data-role' => 'tagsinput',
                                                'placeholder' => trans('messages.Tags EN'),
                                            ]) !!}
                                        </div>
                                        @error('tags_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description_en">{{ trans('messages.Description EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('description_en', $blog->description_en, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description EN'),
                                            ]) !!}
                                        </div>
                                        @error('description_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="body_en">{{ trans('messages.Body EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('body_en', $blog->body_en, [
                                                'id' => 'editoren',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Body EN'),
                                            ]) !!}
                                        </div>
                                        @error('body_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile7" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="title">{{ trans('messages.Title Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('title_nl', $blog->title_nl, [
                                                'onkeyup' => 'makeSlugnl(this.value)',
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
                                        <label for="slug_nl">{{ trans('messages.Slug Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('slug_nl', $blog->slug_nl, [
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
                                    <div class="form-group">
                                        <label for="tags_nl">{{ trans('messages.Tags Nl') }}
                                        </label>
                                        <div class="tags-default">
                                            {!! Form::text('tags_nl', $blog->tags_nl, [
                                                'class' => 'form-control',
                                                'data-role' => 'tagsinput',
                                                'placeholder' => trans('messages.Tags Nl'),
                                            ]) !!}
                                        </div>
                                        @error('tags_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description_nl">{{ trans('messages.Description Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('description_nl', $blog->description_nl, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Description Nl'),
                                            ]) !!}
                                        </div>
                                        @error('description_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="body_nl">{{ trans('messages.Body Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('body_nl', $blog->body_nl, [
                                                'id' => 'editor2',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Body Nl'),
                                            ]) !!}
                                        </div>
                                        @error('body_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ trans('messages.Category') }}
                            </label>
                            <div>
                                {!! Form::select('blog_category_id', $categories, $blog->blog_category_id, [
                                    'class' => 'form-control select2',
                                    'data-placeholder' => trans('Category'),
                                ]) !!}

                            </div>
                            @error('blog_category_id')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 mx-auto">
                                <div class="custom-file-container">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">{{ trans('Image') }}</label>
                                    </div>

                                    <div class="bg-lightest p-10 rounded5 dvPreview text-center"
                                        style="width: 100%;margin-top: 1em;height: 10em;">
                                        <img style="max-width: 100%;height: 100%"
                                            src="{{ $blog->image ? url($blog->image) : url('/images/noimg.png') }}"
                                            alt="">
                                    </div>
                                </div>
                                @error('image')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}</div>
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
