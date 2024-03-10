@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Edit Answer') }}</h3>
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
            'route' => ['answer.update', $answer->id],
            'files' => true,
            'id' => 'edit-answer-form',
        ]) !!}
        {!! Form::hidden('question_id', $answer->question->id, []) !!}
        {!! Form::hidden('redirect_head', sizeof($redirectArr) > 0 ? $redirectArr[0]['key'] : null, []) !!}
        {!! Form::hidden('redirect_body', sizeof($redirectArr) > 0 ? $redirectArr[0]['value'] : null, []) !!}
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="box">
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-lg-8 mx-auto">
                                <div class="custom-file-container">
                                    <div class="custom-file">
                                        <input type="file" name="answer_image" class="custom-file-input"
                                            id="answer_image">
                                        <label class="custom-file-label" for="answer_image">{{ trans('Image') }}</label>
                                    </div>

                                    <div class="bg-lightest p-10 rounded5 dvPreview text-center"
                                        style="width: 100%;margin-top: 1em;height: 10em;">
                                        <img style="max-width: 100%;height: 100%"
                                            src="{{ $answer->answer_image ? url($answer->answer_image) : url('/images/noimg.png') }}"
                                            alt="">
                                    </div>
                                </div>
                                @error('answer_image')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                {!! Form::checkbox('right_answer', null, $answer->right_answer, ['id' => 'right_answer']) !!}
                                <label for="right_answer">{{ trans('messages.Right answer') }}</label>
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
