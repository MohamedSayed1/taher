@if ($question->question_type == 'drag_drop')
    <div class="row drag-and-drop-question">
        <div class="col-lg-6 col-md-6 col-sm-12 text">
            <div class="question-head">
                <p>
                    {{ $question->{'question_' . App::getLocale()} }}
                </p>
            </div>
            <div class="answer-wrapper">
                @foreach ($question->answers as $answer)
                    <span class="drag-num">{{ $answer->{'answer_' . App::getLocale()} }}</span>
                @endforeach
                <p class="question_explaination">
                    {{ $question->{'answer_explanation_' . App::getLocale()} }}
                </p>
            </div>
        </div>
        <div class="col-lg col-md col-sm-12 img">
            <div id="answer-containers" class="answer-containers cont-ans-31" style="position: relative">
                <div class="image">
                    <img src="{{ url($question->question_image) }}" alt="">
                </div>
                @if ($question->json_score->answers_object_arr)
                    @foreach ($question->json_score->answers_object_arr as $answer)
                        @if (in_array($answer->answer_it, $question->json_score->wrong_answers))
                            <div
                                style="color: #fff;font-size: 1.5em;text-align: center;width: 40px;height: 40px;background-color: rgb(255 0 0 / 43%);border-radius: 50%;border: 2px solid red;position: absolute;top: {{ $answer->answer_top }}% !important; left: {{ $answer->answer_left }}% !important;">
                                {{ $answer->answer_it }}
                            </div>
                        @else
                            <div
                                style="color: #fff;font-size: 1.5em;text-align: center;width: 40px;height: 40px;background-color: rgb(0 128 0 / 53%);border-radius: 50%;border: 2px solid green;position: absolute;top: {{ $answer->answer_top }}%; left: {{ $answer->answer_left }}%;">
                                {{ $answer->answer_it }}
                            </div>
                        @endif
                    @endforeach
                @else
                    @foreach ($question->answers as $answer)
                        @if (in_array($answer->{'answer_' . App::getLocale()}, $question->json_score->right_answers))
                            <div style="color: #fff;font-size: 1.5em;text-align: center;width: 40px;height: 40px;background-color: rgb(0 128 0 / 53%);border-radius: 50%;border: 2px solid green;position: absolute;top: {{ $answer->top_position }}%; left: {{ $answer->left_position }}%;">
                                {{ $answer->{'answer_' . App::getLocale()} }}
                            </div>
                        @else
                            <div style="color: #fff;font-size: 1.5em;text-align: center;width: 40px;height: 40px;background-color: rgb(255 0 0 / 43%);border-radius: 50%;border: 2px solid red;position: absolute;top: {{ $answer->top_position }}% !important; left: {{ $answer->left_position }}% !important;">
                                {{ $answer->{'answer_' . App::getLocale()} }}
                            </div>
                        @endif
                    @endforeach
                @endif

            </div>
        </div>
        @if (sizeof($question->json_score->wrong_answers) > 0)
            <div class="col-lg-3 col-md-3 col-sm-12 img">
                <div id="answer-containers-right" class="answer-containers cont-ans-31" style="position: relative">
                    <div class="image">
                        <img src="{{ url($question->question_image) }}" alt="">
                    </div>
                    @foreach ($question->answers as $answer)
                        <div
                            style="color: #fff;font-size: 1.5em;text-align: center;width: 40px;height: 40px;background-color: rgb(0 128 0 / 53%);border-radius: 50%;border: 2px solid green;position: absolute;top: {{ $answer->top_position }}%; left: {{ $answer->left_position }}%;">
                            {{ $answer->{'answer_' . App::getLocale()} }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@elseif($question->question_type == 'mcq')
    <div class="row checkbox-question">
        <div class="col-lg-6 col-md-6 col-sm-12 text">
            <div class="question-head">
                <p class="question-text">
                    {{ $question->arrangment }}
                    -
                    {{ $question->{'question_' . App::getLocale()} }}
                </p>
            </div>
            <span style="color: red;display: none"
                class="answered-span">{{ trans('messages.You answered this question') }}</span>
            <span style="color: red;display: none"
                class="skiped-span">{{ trans('messages.You skiped this question') }}</span>
            <div class="answer-wrapper">
                @foreach ($question->answers as $answer)
                    @php
                        if (($answered == 'yes' || $answered == 'skiped' || $answered == 'no') && $answer->right_answer == 1) {
                            $class = 'right-answer';
                        } elseif ($answered == 'yes' && in_array($answer->id, $selectedAnswers) && $answer->right_answer == 0) {
                            $class = 'wrong-answer';
                        } else {
                            $class = 'no-answer';
                        }
                    @endphp
                    <p class="{{ $class }}">
                        <input type="checkbox" id="test{{ $answer->id }}" name="checkbox-group"
                            {{ $answered == 'yes' && in_array($answer->id, $selectedAnswers) ? 'checked' : '' }} disabled>
                        <label for="test{{ $answer->id }}">
                            <span class="question-answer">
                                {{ $answer->{'answer_' . App::getLocale()} }}
                            </span>
                        </label>
                    </p>
                @endforeach
                <p class="question_explaination">
                    {{ $question->{'answer_explanation_' . App::getLocale()} }}
                </p>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 img">
            <img src="{{ url($question->question_image) }}" alt="">
        </div>
    </div>
@elseif($question->question_type == 'mcq_image')
    <div class="row images-select-question">
        <div class="col-lg-12 col-md-12 col-sm-12 text">
            <div class="question-head">
                <p>
                    {{ $question->{'question_' . App::getLocale()} }}
                </p>
            </div>
            <span style="color: red;display: none"
                class="answered-span">{{ trans('messages.You answered this question') }}</span>
            <span style="color: red;display: none"
                class="skiped-span">{{ trans('messages.You skiped this question') }}</span>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 images">
            <ul>
                @foreach ($question->answers as $answer)
                    @php
                        if (($answered == 'yes' || $answered == 'skiped') && $answer->right_answer == 1) {
                            $class = 'right-answer';
                        } elseif ($answered == 'yes' && in_array($answer->id, $selectedAnswers) && $answer->right_answer == 0) {
                            $class = 'wrong-answer';
                        } else {
                            $class = 'no-answer';
                        }
                    @endphp
                    <li class="{{ $class }}">
                        <input name="img" type="checkbox" class="checkbox-group" id="cb{{ $answer->id }}"
                            {{ $answered == 'yes' && in_array($answer->id, $selectedAnswers) ? 'checked' : '' }} disabled />
                        <label for="cb{{ $answer->id }}"><img src="{{ url($answer->answer_image) }}" /></label>

                    </li>
                @endforeach
            </ul>
            <br>
            <p class="question_explaination">
                {{ $question->{'answer_explanation_' . App::getLocale()} }}
            </p>
        </div>
    </div>
@elseif($question->question_type == 'text_input')
    <div class="row number-question">
        <div class="col-lg-6 col-md-6 col-sm-12 text">
            <div class="question-head">
                <p>
                    {{ $question->{'question_' . App::getLocale()} }}
                </p>
            </div>
            @if ($answered == 'skiped')
                <span style="color: red;" class="skiped-span">{{ trans('messages.You skiped this question') }}</span>
            @endif
            <div class="answer-wrapper">
                <label for="answer-number" class="form-label">{{ trans('messages.Type your answer here') }}</label>
                @php
                    if ($answered == 'yes' && $question->answers[0]->{'answer_' . App::getLocale()} == $answer_input && $question->{'answer_explanation_' . App::getLocale()}) {
                        $class = 'right-answer-check-box';
                    } else {
                        $class = 'wrong-answer-check-box';
                    }
                @endphp

                <input class="{{ $class }}" type="number" name="answer-number" id="answer-number"
                    value="{{ $answer_input }}" disabled>
            </div>
            <br>
            <p class="question_explaination" style="padding: 4px">
                {{ $question->{'answer_explanation_' . App::getLocale()} }}</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 img">
            <img src="{{ url($question->question_image) }}" alt="">
        </div>
    </div>
@endif
<div class="row btns-row">
    <button class=" btn prev" onclick="getprevExamFinishUser({{ $question->id }},{{ $result->id }})">
        @if (App::getLocale() == 'ar')
            <i class="fa-solid fa-arrow-right-long"></i>
        @else
            <i class="fa-solid fa-arrow-left-long"></i>
        @endif
        <span>{{ trans('messages.Prev') }}</span>
    </button>
    <button class="btn show_result" style="background-color: green"
        onclick="getFinishedExamResultUser({{ $result->exam_id }},{{ $result->user_id }})">
        <span>{{ trans('messages.Show result') }}</span>
    </button>
    <button class=" btn next" onclick="getnextExamFinishUser({{ $question->id }},{{ $result->id }})">
        <span>{{ trans('messages.Next') }}</span>
        @if (App::getLocale() == 'ar')
            <i class="fa-solid fa-arrow-left-long"></i>
        @else
            <i class="fa-solid fa-arrow-right-long"></i>
        @endif
    </button>
</div>
