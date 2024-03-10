@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Add Question') }}</h3>
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
            'route' => ['question.update', $question->id],
            'files' => true,
            'id' => 'edit-question-form',
        ]) !!}
        {!! Form::hidden('exam_id', $question->exam_id, []) !!}
        {!! Form::hidden('exam_category_id', $question->exam_category_id, []) !!}
        {!! Form::hidden('redirect_head', sizeof($redirectArr) > 0 ? $redirectArr[0]['key'] : null, []) !!}
        {!! Form::hidden('redirect_body', sizeof($redirectArr) > 0 ? $redirectArr[0]['value'] : null, []) !!}
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
                                            {!! Form::text('question_ar', $question->question_ar, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Question Ar'),
                                            ]) !!}
                                        </div>
                                        @error('question_ar')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="answer_explanation_ar">{{ trans('messages.Answer explanation') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('answer_explanation_ar', $question->answer_explanation_ar, [
                                                'class' => 'form-control',
                                                'rows' => 4,
                                                'placeholder' => trans('messages.Answer explanation'),
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="home8" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="question_en">{{ trans('messages.Question EN') }}
                                        </label>
                                        <div>
                                            {!! Form::text('question_en', $question->question_en, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Question EN'),
                                            ]) !!}
                                        </div>
                                        @error('question_en')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="answer_explanation_en">{{ trans('messages.Answer explanation') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('answer_explanation_en', $question->answer_explanation_en, [
                                                'class' => 'form-control',
                                                'rows' => 4,
                                                'placeholder' => trans('messages.Answer explanation'),
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile7" role="tabpanel">
                                <div class="p-15">
                                    <div class="form-group">
                                        <label for="question_nl">{{ trans('messages.Question Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::text('question_nl', $question->question_nl, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Question Nl'),
                                            ]) !!}
                                        </div>
                                        @error('question_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="answer_explanation_nl">{{ trans('messages.Answer explanation') }}
                                        </label>
                                        <div>
                                            {!! Form::textarea('answer_explanation_nl', $question->answer_explanation_nl, [
                                                'class' => 'form-control',
                                                'rows' => 4,
                                                'placeholder' => trans('messages.Answer explanation'),
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md">
                                <div class="form-group">
                                    <label for="name">{{ trans('messages.Question type') }}
                                    </label>
                                    <div>
                                        {!! Form::select(
                                            'question_type',
                                            ['mcq' => 'MCQ', 'mcq_image' => 'MCQ image', 'text_input' => 'Text', 'drag_drop' => 'Drag & Drop'],
                                            $question->question_type,
                                            [
                                                'class' => 'form-control select2',
                                                'data-placeholder' => trans('Question type'),
                                            ],
                                        ) !!}

                                    </div>
                                    @error('question_type')
                                        <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="arrangment">{{ trans('messages.Arrangment') }}
                            </label>
                            <div>
                                {!! Form::number('arrangment', $question->arrangment, [
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
                        <div class="form-group row">
                            <div class="col-lg-8 mx-auto">
                                <div class="custom-file-container">
                                    <div class="custom-file">
                                        <input type="file" name="question_image" class="custom-file-input"
                                            id="question_image">
                                        <label class="custom-file-label" for="question_image">{{ trans('Image') }}</label>
                                    </div>

                                    <div class="bg-lightest p-10 rounded5 dvPreview text-center"
                                        style="width: 100%;margin-top: 1em;height: 10em;">
                                        <img style="max-width: 100%;height: 100%"
                                            src="{{ $question->question_image ? url($question->question_image) : url('/images/noimg.png') }}"
                                            alt="">
                                    </div>
                                </div>
                                @error('question_image')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}</div>
                                @enderror
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
        </div>
        {!! Form::Close() !!}
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $('.select2').select2();
        $(document).ready(function() {

        });
    </script>
@endsection
