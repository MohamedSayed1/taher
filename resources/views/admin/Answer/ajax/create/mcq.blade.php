<style>
    .bootstrap-tagsinput {
        width: 100%;
        padding: 0.6em;
    }
</style>
<!-- Main content -->

<section class="content">
    {!! Form::open(['route' => 'answer.store', 'files' => true, 'id' => 'add-answer-form']) !!}
    {!! Form::hidden('question_id', $question->id, []) !!}
    {!! Form::hidden('redirect_head', 'ajax_create', []) !!}
    {!! Form::hidden('redirect_body', sizeof($redirectArr) > 0 ? $redirectArr[0]['value'] : null, []) !!}

    <!-- Nav tabs -->
    <ul class="nav nav-tabs customtab2" role="tablist">
        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><span
                    class="hidden-sm-up"><i class="ion-home"></i></span> <span
                    class="hidden-xs-down">{{ trans('messages.Arabic') }}</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><span
                    class="hidden-sm-up"><i class="ion-person"></i></span> <span
                    class="hidden-xs-down">{{ trans('messages.Netherland') }}</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home8" role="tab"><span
                    class="hidden-sm-up"><i class="ion-person"></i></span> <span
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
                        {!! Form::text('answer_ar', null, ['class' => 'form-control', 'placeholder' => trans('messages.Answer Ar')]) !!}
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
                    <label for="answer_en">{{ trans('messages.Answer En') }}
                    </label>
                    <div>
                        {!! Form::text('answer_en', null, ['class' => 'form-control', 'placeholder' => trans('messages.Answer En')]) !!}
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
                        {!! Form::text('answer_nl', null, ['class' => 'form-control', 'placeholder' => trans('messages.Answer Nl')]) !!}
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
    <div class="form-group">
        <label for="arrangment">{{ trans('messages.Arrangment') }}
        </label>
        <div>
            {!! Form::number('arrangment', null, [
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
            {!! Form::checkbox('right_answer', null, 1, ['id' => 'right_answer']) !!}
            <label for="right_answer">{{ trans('messages.Right answer') }}</label>
        </div>
    </div>
    <button type="submit" class="btn btn-rounded btn-primary btn-outline">
        <i class="ti-save-alt"></i> {{ trans('messages.Save') }}
    </button>

    {!! Form::Close() !!}


    <script type="text/javascript">
        $('#add-answer-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            url = $(this)[0].action;
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                success: function(msg) {
                    $("#exam-categories-section").html(msg);
                    $('#create-with-ajax').modal('hide');
                },
                error: function(xhr, status, error) {
                    var errors = $.parseJSON(xhr.responseText);
                    $.each(errors, function(key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function(key, value) {
                                console.log(key + " " + value);
                                $('#' + key + '-error').show().html(value);

                            });
                        } else {

                        }
                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>
