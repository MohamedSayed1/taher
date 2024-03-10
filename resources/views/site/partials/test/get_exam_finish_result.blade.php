<div class="exam-pass-image">
    @if ($result['passed_exam'] == true)
        <img style="width: 20%;" src="{{ url('front_them/assets/imgs/success-' . App::getLocale() . '.png') }}"
            alt="">
    @else
        <img style="width: 20%;" src="{{ url('front_them/assets/imgs/fail-' . App::getLocale() . '.png') }}" alt="">
    @endif
</div>
<hr>
<div class="result-summary">
    <div class="info">
        <p>
            {{ trans('messages.The number of correct answers') }} :
            <span>{{ $result['total_right_questions'] }}</span>
        </p>
        <p>
            {{ trans('messages.The number of wrong answers') }} :
            <span>{{ $result['total_wrong_questions'] }}</span>
        </p>
        <p>
            {{ trans('messages.The number of skiped answers') }} :
            <span>{{ $result['total_skiped_questions'] }}</span>
        </p>
        <p>
            {{ trans('messages.The number of unanswered answers') }} :
            <span>{{ $result['total_not_answered_questions'] }}</span>
        </p>
        <p>
            {{ trans('messages.The number of flaged answers') }} :
            <i class="fa-solid fa-star" style="color: #f6d91c"></i>
            <span>{{ $result['total_flaged_questions'] }}</span>
        </p>
    </div>
    <div class="progress-part">
        <div class="progress result-progress mx-auto" data-value='{{ round($result['score'], 2) }}'>
            <span class="progress-left">
                <span class="progress-bar"></span>
            </span>
            <span class="progress-right">
                <span class="progress-bar"></span>
            </span>
            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                <div class="font-weight-bold">{{ round($result['score'], 2) }}%</div>
            </div>
        </div>
    </div>
</div>
@foreach (json_decode($result['json_score']) as $questions)
    {{ $questions->category->{'name_' . App::getLocale()} }}
    <hr>
    <div class="questions-wrapper">

        @foreach ($questions->questions as $question)
            @if ($question->answered == 'yes')
                @if ($question->right_answer == 1)
                    <div class="question success" style="cursor: pointer"
                        onclick="getPreviewAnsweredQuestion({{ $result['id'] }},{{ $question->id }} , '{{ $question->answered }}' , {{ json_encode($question->selectedAnswers) }}, {{ $question->right_answer == 1 ? 1 : 0 }}, {{ $question->answer_input }})">
                        @if ($question->flaged == 1)
                            <i class="fa-solid fa-star"></i>
                        @endif
                        <span>{{ $question->arrangment }}</span>
                    </div>
                @else
                    <div class="question wrong" style="cursor: pointer"
                        onclick="getPreviewAnsweredQuestion({{ $result['id'] }},{{ $question->id }} , '{{ $question->answered }}' , {{ json_encode($question->selectedAnswers) }}, {{ $question->right_answer == 1 ? 1 : 0 }}, {{ $question->answer_input }})">
                        @if ($question->flaged == 1)
                            <i class="fa-solid fa-star"></i>
                        @endif
                        <span>{{ $question->arrangment }}</span>
                    </div>
                @endif
            @elseif($question->answered == 'skiped')
                <div class="question" style="cursor: pointer"
                    onclick="getPreviewAnsweredQuestion({{ $result['id'] }},{{ $question->id }} , '{{ $question->answered }}' , {{ json_encode($question->selectedAnswers) }}, {{ $question->right_answer == 1 ? 1 : 0 }}, {{ $question->answer_input }})">
                    @if ($question->flaged == 1)
                        <i class="fa-solid fa-star"></i>
                    @endif
                    <span>{{ $question->arrangment }}</span>
                </div>
            @elseif($question->answered == 'no')
                <div class="question" style="cursor: pointer"
                    onclick="getPreviewAnsweredQuestion({{ $result['id'] }},{{ $question->id }} , '{{ $question->answered }}' , {{ json_encode($question->selectedAnswers) }}, {{ $question->right_answer == 1 ? 1 : 0 }}, {{ $question->answer_input }})">
                    @if ($question->flaged == 1)
                        <i class="fa-solid fa-star"></i>
                    @endif
                    <span>*{{ $question->arrangment }}</span>
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
                <span>*{{ $result['total_not_answered_questions'] }}</span>
            </div>
            <p>{{ trans('messages.without answer') }}</p>
        </div>
        <div class="wrapper">
            <div class="question success">
                <span>{{ $result['total_right_questions'] }}</span>
            </div>
            <p>{{ trans('messages.correct') }}</p>
        </div>
        <div class="wrapper">
            <div class="question wrong">
                <span>{{ $result['total_wrong_questions'] }}</span>
            </div>
            <p>{{ trans('messages.wrong') }}</p>
        </div>
        <div class="wrapper">
            <div class="question">
                <span>{{ $result['total_skiped_questions'] }}</span>
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
