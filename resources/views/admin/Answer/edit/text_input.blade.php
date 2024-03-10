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
                                        <label for="answer_ar">{{ trans('messages.Answer Ar') }}
                                        </label>
                                        <div>
                                            {!! Form::number('answer_ar', $answer->answer_ar, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Answer Ar'),
                                            ]) !!}
                                        </div>
                                        @error('answer_ar')
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
                                        <label for="answer_en">{{ trans('messages.Answer EN') }}
                                        </label>
                                        <div>
                                            {!! Form::number('answer_en', $answer->answer_en, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Answer EN'),
                                            ]) !!}
                                        </div>
                                        @error('answer_en')
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
                                        <label for="answer_nl">{{ trans('messages.Answer Nl') }}
                                        </label>
                                        <div>
                                            {!! Form::number('answer_nl', $answer->answer_nl, [
                                                'class' => 'form-control',
                                                'placeholder' => trans('messages.Answer Nl'),
                                            ]) !!}
                                        </div>
                                        @error('answer_nl')
                                            <div class="badge badge-danger text-center" style="width: 100%">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
            </div>
        </div>
        {!! Form::Close() !!}
    </section>
@endsection


@section('script')
    <script type="text/javascript"></script>
@endsection
