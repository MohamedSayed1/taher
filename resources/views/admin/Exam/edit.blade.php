@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Edit Exam') }}</h3>
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
            'route' => ['exam.update', $exam->id],
            'files' => true,
            'id' => 'edit-exam-form',
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
                                            {!! Form::text('name_ar', $exam->name_ar, [
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
                                        <label for="description_ar">{{ trans('messages.Description Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('description_ar', $exam->description_ar, [
                                                'id' => 'editor1',
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
                                        <label for="name_en">{{ trans('messages.Name EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('name_en', $exam->name_en, [
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
                                        <label for="description_en">{{ trans('messages.Description EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('description_en', $exam->description_en, [
                                                'id' => 'editoren',
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
                                        <label for="name_nl">{{ trans('messages.Name Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('name_nl', $exam->name_nl, [
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
                                        <label for="description_nl">{{ trans('messages.Description Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('description_nl', $exam->description_nl, [
                                                'id' => 'editor2',
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
                            <label for="name">{{ trans('messages.Packages') }}
                            </label>
                            <div>
                                {!! Form::select('packages[]', $packages, $exam->packages, [
                                    'multiple' => 'multiple',
                                    'class' => 'form-control select2',
                                    'data-placeholder' => trans('messages.Packages'),
                                ]) !!}

                            </div>

                        </div>
                        <div class="form-group">
                            <label for="attempt_num">{{ trans('messages.Attempt No') }}
                            </label>
                            <div>
                                {!! Form::number('attempt_num', $exam->attempt_num, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Attempt No'),
                                ]) !!}
                            </div>
                            @error('attempt_num')
                                <div class="badge badge-danger text-center" style="width: 100%">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="duration_in_minutes">{{ trans('messages.Duration in minutes') }}
                            </label>
                            <div>
                                {!! Form::number('duration_in_minutes', $exam->duration_in_minutes, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Duration in minutes'),
                                ]) !!}
                            </div>
                            @error('duration_in_minutes')
                                <div class="badge badge-danger text-center" style="width: 100%">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="arrangment">{{ trans('messages.Arrangment') }}
                            </label>
                            <div>
                                {!! Form::number('arrangment', $exam->arrangment, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Arrangment'),
                                ]) !!}
                            </div>
                            @error('arrangment')
                                <div class="badge badge-danger text-center" style="width: 100%">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <div class="checkbox">
                                {!! Form::checkbox('exam_category_auto_move', null, $exam->exam_category_auto_move, [
                                    'id' => 'exam_category_auto_move',
                                ]) !!}
                                <label
                                    for="exam_category_auto_move">{{ trans('messages.Auto move category while Exam') }}</label>
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

    </script>
@endsection
