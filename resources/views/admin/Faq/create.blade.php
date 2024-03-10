@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Add Faq') }}</h3>
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
        {!! Form::open(['route' => 'faq.store', 'files' => true, 'id' => 'add-faq-form']) !!}
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
                                        <label for="question_ar">{{ trans('messages.Question Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::text('question_ar', null, ['class' => 'form-control', 'placeholder' => trans('messages.Question Ar')]) !!}
                                        </div>
                                        @error('question_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="answer_ar">{{ trans('messages.Answer Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('answer_ar', null, [
                                                'id' => 'editor1',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Answer Ar'),
                                            ]) !!}
                                        </div>
                                        @error('answer_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane active" id="home8" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="question_en">{{ trans('messages.Question EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('question_en', null, ['class' => 'form-control', 'placeholder' => trans('messages.Question EN')]) !!}
                                        </div>
                                        @error('question_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="answer_en">{{ trans('messages.Answer EN') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('answer_en', null, [
                                                'id' => 'editoren',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Answer EN'),
                                            ]) !!}
                                        </div>
                                        @error('answer_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile7" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="question_nl">{{ trans('messages.Question Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('question_nl', null, ['class' => 'form-control', 'placeholder' => trans('messages.Question Nl')]) !!}
                                        </div>
                                        @error('question_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="answer_nl">{{ trans('messages.Answer Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('answer_nl', null, [
                                                'id' => 'editor2',
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Answer Nl'),
                                            ]) !!}
                                        </div>
                                        @error('answer_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ trans('messages.Faq type') }}
                            </label>
                            <div>
                                {!! Form::select('faq_type', ['faq' => 'FAQ', 'sympol' => 'Sympol', 'theory_info' => 'Theory info'], null, [
                                    'class' => 'form-control select2',
                                    'data-placeholder' => trans('messages.Faq type'),
                                ]) !!}

                            </div>
                            @error('faq_type')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="arrangment">{{ trans('messages.Arrangment') }}
                            </label>
                            <div>
                                {!! Form::number('arrangment', null, ['class' => 'form-control', 'placeholder' => trans('messages.Arrangment')]) !!}
                            </div>
                            @error('arrangment')
                                <div class="badge badge-danger text-center" style="width: 100%">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                {!! Form::checkbox('enable', null, 1, ['id' => 'Checkbox_1']) !!}
                                <label for="Checkbox_1">{{ trans('messages.Enable Faq') }}</label>
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
