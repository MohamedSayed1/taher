<style>
    .bootstrap-tagsinput {
        width: 100%;
        padding: 0.6em;
    }

    .question-image-container {
        position: relative;
    }

    .answer-position {
        position: absolute;
        top: {{ $answer->top_position }}%;
        left: {{ $answer->left_position }}%;
        width: 30px !important;
        height: 30px !important;
        border-radius: 30px;
        background-color: brown;
    }

    .arrow {
        border: solid black;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 3px;
    }

    .right {
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
    }

    .left {
        transform: rotate(135deg);
        -webkit-transform: rotate(135deg);
    }

    .up {
        transform: rotate(-135deg);
        -webkit-transform: rotate(-135deg);
    }

    .down {
        transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
    }
</style>
<!-- Main content -->

{!! Form::open([
    'method' => 'PUT',
    'route' => ['answer.update', $answer->id],
    'files' => true,
    'id' => 'edit-answer-form',
]) !!}
{!! Form::hidden('top_position', $answer->top_position, ['id' => 'top-position']) !!}
{!! Form::hidden('left_position', $answer->left_position, ['id' => 'left-position']) !!}

<div class="row">
    <div class="col-md">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs customtab2" role="tablist">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><span
                        class="hidden-sm-up"><i class="ion-home"></i></span> <span
                        class="hidden-xs-down">{{ trans('messages.Arabic') }}</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><span
                        class="hidden-sm-up"><i class="ion-person"></i></span>
                    <span class="hidden-xs-down">{{ trans('messages.Netherland') }}</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home8" role="tab"><span
                        class="hidden-sm-up"><i class="ion-home"></i></span> <span
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
                            {!! Form::text('answer_ar', $answer->answer_ar, [
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
                            {!! Form::text('answer_en', $answer->answer_en, [
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
                            {!! Form::text('answer_nl', $answer->answer_nl, [
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
        <div class="form-group">
            <label for="arrangment">{{ trans('messages.Arrangment') }}
            </label>
            <div>
                {!! Form::number('arrangment', $answer->arrangment, [
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
        <hr>
        <h4 class="text-center">{{ trans('messages.Move arrows to get answer right position.') }}
        </h4>
        <div style="width: 150px;height: 150px;margin: auto;text-align: center;font-size: 2em;font-weight: bolder;">
            <div class="row">
                <div class="col-md-4" style="height: 75px;cursor: pointer;"></div>
                <div class="col-md-4" style="height: 75px;cursor: pointer;"><i class="fa fa-arrow-up"></i></div>
                <div class="col-md-4" style="height: 75px;cursor: pointer;"></div>
                <div class="col-md-4" style="height: 75px;cursor: pointer;"><i class="fa fa-arrow-right"></i></div>
                <div class="col-md-4" style="height: 75px;cursor: pointer;"></div>
                <div class="col-md-4" style="height: 75px;cursor: pointer;"><i class="fa fa-arrow-left"></i></div>
                <div class="col-md-4" style="height: 75px;cursor: pointer;"></div>
                <div class="col-md-4" style="height: 75px;cursor: pointer;"><i class="fa fa-arrow-down"></i></div>
                <div class="col-md-4" style="height: 75px;cursor: pointer;"></div>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="question-image-container">
            <div class="answer-position"></div>
            <img id="question_image" src="{{ url($answer->question->question_image) }}" alt="your question_image" />
        </div>
    </div>
</div>
<button type="submit" class="btn btn-rounded btn-primary btn-outline">
    <i class="ti-save-alt"></i> {{ trans('messages.Save') }}
</button>

{!! Form::Close() !!}


<script type="text/javascript">
    var leftPosition = {{ $answer->left_position }};
    var topPosition = {{ $answer->top_position }};
    var posInterval;

    //up interval
    $('.fa-arrow-up').on('mousedown', function() {
        posInterval = setInterval(() => {
            if (topPosition >= 0) {
                topPosition -= 3;
                $('.answer-position').css('top', topPosition + '%');
                $('#top-position').val(topPosition);
            }
        }, 50);
    })
    $('.fa-arrow-up').on('mouseup', function() {
        clearInterval(posInterval);
    })

    //left interval
    $('.fa-arrow-left').on('mousedown', function() {
        posInterval = setInterval(() => {
            if (leftPosition >= 0) {
                leftPosition -= 3;
                $('.answer-position').css('left', leftPosition + '%');
                $('#left-position').val(leftPosition);
            }
        }, 50);

    })
    $('.fa-arrow-left').on('mouseup', function() {
        clearInterval(posInterval);
    })

    //down interval
    $('.fa-arrow-down').on('mousedown', function() {
        posInterval = setInterval(() => {
            if (topPosition <= 95) {
                topPosition += 3;
                $('.answer-position').css('top', topPosition + '%');
                $('#top-position').val(topPosition);
            }
        }, 50);
    })
    $('.fa-arrow-down').on('mouseup', function() {
        clearInterval(posInterval);
    })

    //right interval
    $('.fa-arrow-right').on('mousedown', function() {
        posInterval = setInterval(() => {
            if (leftPosition <= 95) {
                leftPosition += 3;
                $('.answer-position').css('left', leftPosition + '%');
                $('#left-position').val(leftPosition);
            }
        }, 50);

    })
    $('.fa-arrow-right').on('mouseup', function() {
        clearInterval(posInterval);
    })

    $('#edit-answer-form').on('submit', function(e) {
        e.preventDefault();
        url = $(this)[0].action;

        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                question_id: {{ $answer->question->id }},
                top_position: $('#top-position').val(),
                left_position: $('#left-position').val(),
                redirect_head: 'ajax_create',
                redirect_body: {{ $redirectArr[0]['value'] }},
                answer_ar: $("input[name='answer_ar']").val(),
                answer_en: $("input[name='answer_en']").val(),
                answer_nl: $("input[name='answer_nl']").val(),
                arrangment: $("input[name='arrangment']").val(),
            },
            success: function(data) {
                $("#exam-categories-section").html(data);
                $('#create-with-ajax').modal('hide');
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log("nader")
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
            }
        });
    });
</script>
