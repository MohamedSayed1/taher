<div class="result-summary">
    <div class="info">
        <p>
            {{ trans('messages.The number of answered questions') }} :
            <span>{{ $data['total_right_questions'] + $data['total_wrong_questions'] }}</span>
        </p>
        <p>
            {{ trans('messages.The number of skiped questions') }} :
            <span>{{ $data['total_skiped_questions'] }}</span>
        </p>
        <p>
            {{ trans('messages.The number of unanswered questions') }} :
            <span>{{ $data['total_not_answered_questions'] }}</span>
        </p>
        <p>
            {{ trans('messages.The number of flaged answers') }} :
            <i class="fa-solid fa-star" style="color: #f6d91c"></i>
            <span>{{ $data['total_flaged_questions'] }}</span>
        </p>
    </div>
</div>
<div class="you-cant-jump-alert alert alert-danger" style="display: none">{{ trans('messages.You Cant Jump to question in another category') }}
</div>
@foreach ($data['result_by_category_questions'] as $questions)
    {{ $questions['category']['name_' . App::getLocale()] }}
    <hr>
    <div class="questions-wrapper">

        @foreach ($questions['questions'] as $question)
            @if ($question['answered'] == 'yes')
                <div class="question success" style="background: #1ba9ff;cursor: pointer;"
                    onclick="jumpToQuestion({{ $questions['category']['index'] }},{{ $question['index'] }},{{ Session::get('exam_object')['current_category'] }})">
                    @if ($question['flaged'] == 1)
                        <i class="fa-solid fa-star"></i>
                    @endif
                    <span>{{ $question['arrangment'] }}</span>
                </div>
            @elseif($question['answered'] == 'skiped')
                <div class="question" style="cursor: pointer;"
                    onclick="jumpToQuestion({{ $questions['category']['index'] }},{{ $question['index'] }},{{ Session::get('exam_object')['current_category'] }})">
                    @if ($question['flaged'] == 1)
                        <i class="fa-solid fa-star"></i>
                    @endif
                    <span>{{ $question['arrangment'] }}</span>
                </div>
            @elseif($question['answered'] == 'no')
                <div class="question" style="cursor: pointer;"
                    onclick="jumpToQuestion({{ $questions['category']['index'] }},{{ $question['index'] }},{{ Session::get('exam_object')['current_category'] }})">
                    @if ($question['flaged'] == 1)
                        <i class="fa-solid fa-star"></i>
                    @endif
                    <span>*{{ $question['arrangment'] }}</span>
                </div>
            @endif
        @endforeach
    </div>
@endforeach

<hr>
<div class="info-wrapper">
    <p class="info-title">
        {{ trans('messages.What do the colors mean') }}
    </p>
    <div class="info-questions-wrapper">

        <div class="wrapper">
            <div class="question">
                <span>*{{ $data['total_not_answered_questions'] }}</span>
            </div>
            <p>{{ trans('messages.without answer') }}</p>
        </div>
        <div class="wrapper">
            <div class="question success" style="background: #1ba9ff">
                <span>{{ $data['total_right_questions'] + $data['total_wrong_questions'] }}</span>
            </div>
            <p>{{ trans('messages.answered') }}</p>
        </div>
        <div class="wrapper">
            <div class="question">
                <span>{{ $data['total_skiped_questions'] }}</span>
            </div>
            <p>{{ trans('messages.skiped answer') }}</p>
        </div>
    </div>
</div>

<script>
    var value = $('.result-progress').attr('data-value');
    var left = $('.result-progress').find('.progress-left .progress-bar');
    var right = $('.result-progress').find('.progress-right .progress-bar');

    if (value > 0) {
        if (value <= 50) {
            right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
        } else {
            right.css('transform', 'rotate(180deg)')
            left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
        }
    }

    function percentageToDegrees(percentage) {

        return percentage / 100 * 360

    }
</script>
