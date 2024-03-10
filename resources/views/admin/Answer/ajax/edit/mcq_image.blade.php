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
    {!! Form::hidden('redirect_head', 'ajax_create', []) !!}
    {!! Form::hidden('redirect_body', sizeof($redirectArr) > 0 ? $redirectArr[0]['value'] : null, []) !!}
    <div class="form-group row">
        <div class="col-lg-8 mx-auto">
            <div class="custom-file-container">
                <div class="custom-file">
                    <input type="file" name="answer_image" class="custom-file-input" id="answer_image">
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
    <div class="form-group">
        <div class="checkbox">
            {!! Form::checkbox('right_answer', null, $answer->right_answer, ['id' => 'right_answer']) !!}
            <label for="right_answer">{{ trans('messages.Right answer') }}</label>
        </div>
    </div>


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

        $('#edit-answer-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_method', 'PUT');
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
