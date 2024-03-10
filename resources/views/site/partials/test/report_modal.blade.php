{!! Form::open([
    'route' => 'examOpinion.siteStoreExamProblem',
    'files' => true,
    'id' => 'add-exam-problem-form',
]) !!}
{!! Form::hidden('exam_id', $exam_id, []) !!}
{!! Form::hidden('question_id', $question_id, []) !!}
{!! Form::hidden('user_id', $user_id, []) !!}
<div id="send-problem-alert" class="alert alert-success text-center">{{ trans('messages.Send successfully') }}</div>
<p>
    {{ Form::radio('problem_type', 'image_upload', true, ['id' => 'image_upload']) }}
    <label for="image_upload">{{ trans('messages.The image is not loaded') }}</label>
</p>
<p>
    {{ Form::radio('problem_type', 'lang_error', false, ['id' => 'lang_error']) }}
    <label for="lang_error">{{ trans('messages.language error') }}</label>
</p>
<p>
    {{ Form::radio('problem_type', 'another_problem', false, ['id' => 'another_problem']) }}
    <label for="another_problem">{{ trans('messages.another thing') }}</label>
</p>
<div class="text-area-wrapper">
    <label for="desc" class="form-label">{{ trans('messages.Description') }}</label>
    {!! Form::textarea('problem_descreption', null, [
        'id' => 'problem_descreption',
        'class' => 'form-control',
        'placeholder' => trans('messages.Description'),
    ]) !!}
</div>

<div class="btn-row mt-5">
    <button class="btn" type="submit">
        <span>{{ trans('messages.Send') }}</span>
    </button>
</div>
{!! Form::Close() !!}

<script type="text/javascript">
    $('#send-problem-alert').hide();
    $('#add-exam-problem-form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{ route('examOpinion.siteStoreExamProblem') }}",
            type: "POST",
            data: formData,
            success: function(msg) {
                $('#send-problem-alert').show();
                setTimeout(() => {
                    $('#send-problem-alert').hide();
                    // $('#report-modal').modal('hide');
                }, 2000);
                console.log(msg)
            },
            error: function(xhr, status, error) {
                console.log(error)
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>
