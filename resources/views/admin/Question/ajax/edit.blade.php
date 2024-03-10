    <style>
        .bootstrap-tagsinput {
            width: 100%;
            padding: 0.6em;
        }
    </style>
    <!-- Main content -->

    {!! Form::open([
        'method' => 'PUT',
        'route' => ['question.update', $question->id],
        'files' => true,
        'id' => 'edit-question-form',
    ]) !!}
    {!! Form::hidden('exam_category_id', $question->exam_category_id, ['id' => 'exam_category_id']) !!}
    {!! Form::hidden('exam_id', $question->exam_id, ['id' => 'exam_id']) !!}
    {!! Form::hidden('redirect_head', 'ajax_create', ['id' => 'redirect_head']) !!}
    <!-- Nav tabs -->
    <ul class="nav nav-tabs customtab2" role="tablist">
        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><span
                    class="hidden-sm-up"><i class="ion-home"></i></span> <span
                    class="hidden-xs-down">{{ trans('messages.Arabic') }}</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><span
                    class="hidden-sm-up"><i class="ion-person"></i></span> <span
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
                    <label for="question_ar">{{ trans('messages.Question Ar') }}
                    </label>
                    <div>
                        {!! Form::text('question_ar', $question->question_ar, [
                            'class' => 'form-control',
                            'placeholder' => trans('messages.Question Ar'),
                        ]) !!}
                    </div>
                    <div class="badge badge-danger text-center" style="width: 100%;display:none" id="question_ar-error">
                    </div>
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
        <div class="tab-pane active" id="home8" role="tabpanel">
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
                    <div class="badge badge-danger text-center" style="width: 100%;display:none" id="question_en-error">
                    </div>
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
                    <div class="badge badge-danger text-center" style="width: 100%;display:none" id="question_nl-error">
                    </div>
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
                            'id' => 'question_type',
                            'class' => 'form-control select2',
                            'data-placeholder' => trans('Question type'),
                        ],
                    ) !!}

                </div>
                <div class="badge badge-danger text-center" style="width: 100%;display:none" id="question_type-error">
                </div>
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
        <div class="badge badge-danger text-center" style="width: 100%;display:none" id="arrangment-error">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-8 mx-auto">
            <div class="custom-file-container">
                <div class="custom-file">
                    <input type="file" name="question_image" class="custom-file-input" id="question_image">
                    <label class="custom-file-label" for="question_image">{{ trans('Image') }}</label>
                </div>

                <div class="bg-lightest p-10 rounded5 dvPreview text-center"
                    style="width: 100%;margin-top: 1em;height: 10em;">
                    <img style="max-width: 100%;height: 100%"
                        src="{{ $question->question_image ? url($question->question_image) : url('/images/noimg.png') }}"
                        alt="">
                </div>
            </div>
            <div class="badge badge-danger text-center" style="width: 100%;display:none" id="question_image-error">
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <button type="submit" class="btn btn-rounded btn-primary btn-outline">
        <i class="ti-save-alt"></i> {{ trans('messages.Save') }}
    </button>

    {!! Form::Close() !!}
    <script type="text/javascript">
        $(".custom-file-input").change(function() {
            var img_src = jQuery(this).parents('.custom-file').parents('.custom-file-container').find("img");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {
                if (typeof(FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function(e) {

                        img_src.attr("src", e.target.result);
                        $('.custem-css-templet img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }
            } else {
                alert("Please upload a valid image file.");
            }
        });
        $('.select2').select2();
        $('#edit-question-form').on('submit', function(e) {
            e.preventDefault();
            url = $(this)[0].action;
            var formData = new FormData(this);
            formData.append('_method', 'PUT');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(data) {
                    // console.log(data);
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
                },
                contentType: false,
                processData: false
            });

        });
    </script>
