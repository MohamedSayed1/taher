@if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_type'] ==
        'drag_drop')
    <div class="row drag-row">
        @if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'yes')
            <div class="col-lg-6 col-md-6 col-sm-12 text-wrapper">
                <div class="question-head">
                    <p class="question-text">
                        {{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['arrangment'] }}
                        -
                        <span
                            class="question-text-text">{{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_' . App::getLocale()] }}</span>
                    </p>
                </div>
                @if( Session::get('exam_object')['examCategory'][$current_category]['explaination_while_exam'] != 1)
                <div class="btn btn-primary" style="background-color: #1ba9ff" onclick="reloadCurrentDragQuestion()">
                    <?= trans('messages.Re arrange answer') ?></div>
                @else
                    <p style="font-weight: bold;text-underline: #1ba9ff;">
                       {{ trans('messages.answer_corrected')}}
                    </p>
                    <div id="answer-containers" class="answer-containers cont-ans-31" style="position: relative">
                        <div class="image">
                            <img style="max-width: 100%;" src="{{ url(Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_image']) }}" alt="">
                        </div>
                            @foreach (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answers'] as $a)
                                    <div class="answer-container ans-opt answer-cont-31 ball-lin-heigth"
                                        style="color: #fff;font-size: 1.5em;text-align: center;width: 40px;height: 40px;background-color: rgb(0 128 0 / 53%);border-radius: 50%;border: 2px solid green;position: absolute;top: {{ $a['top_position'] }}%!important; left: {{ $a['left_position'] }}%!important;">
                                        {{ $a['answer_' . App::getLocale()]  }}
                                    </div>
                            @endforeach
                    </div>

                    <p class="question_explaination">
                        {{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answer_explanation_' . App::getLocale()] }}
                    </p>

                @endif

            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 img-wrapper">
                <p style="font-weight: bold;text-underline: #1ba9ff;">
                    {{ trans('messages.your answer')}}
                </p>
                <div id="answer-containers" class="answer-containers cont-ans-31" style="position: relative">
                    <div class="image">
                        <img src="{{ url(Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_image']) }}"
                            class="img-fluid">
                    </div>
                    @foreach (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answers_object_arr'] as $item)
                        <!--div class="answer-container ans-opt answer-cont-31 ball-lin-heigth"
                            data-type="{{ $item['answer_it'] }}"
                            data-question-id="{{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_uuid'] }}"
                            data-top="{{ $item['answer_top'] }}" data-left="{{ $item['answer_left'] }}"
                            data-check="{{ $item['answer_it'] }}"
                            style="top: {{ $item['answer_top'] }}%; left: {{ $item['answer_left'] }}%;text-align: center; font-size: x-large; color: #FFF;border: 4px solid #fff;">
                            {{ $item['answer_it'] }}
                        </div-->
                        @if (in_array($item['answer_it'], Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['wrong_answers']))
                            <div class="answer-container ans-opt answer-cont-31 ball-lin-heigth"
                                 style="color: #fff;font-size: 1.5em;text-align: center;width: 40px;height: 40px;background-color: rgb(255 0 0 / 43%);border-radius: 50%;border: 2px solid red;position: absolute;top: {{ $item['answer_top']  }}% !important; left: {{ $item['answer_left']  }}% !important;">
                                {{ $item['answer_it'] }}
                            </div>
                        @else
                            <div class="answer-container ans-opt answer-cont-31 ball-lin-heigth"
                                 style="color: #fff;font-size: 1.5em;text-align: center;width: 40px;height: 40px;background-color: rgb(0 128 0 / 53%);border-radius: 50%;border: 2px solid green;position: absolute;top: {{ $item['answer_top'] }}%!important; left: {{ $item['answer_left']  }}%!important;">
                                {{ $item['answer_it'] }}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        @else
            <div class="col-lg-6 col-md-6 col-sm-12 text-wrapper">
                <div class="question-head">
                    <p class="question-text">
                        {{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['arrangment'] }}
                        -
                        <span
                            class="question-text-text">{{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_' . App::getLocale()] }}</span>
                    </p>
                </div>
                <div id="options" class="options opt-31 h-50">
                    @foreach (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answers'] as $answer)
                        <div class="drag-option" data-type="{{ $answer['answer_' . App::getLocale()] }}"
                            data-num="{{ $answer['answer_' . App::getLocale()] }}"
                            data-question="{{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_uuid'] }}"
                            data-check="{{ $answer['answer_' . App::getLocale()] }}">
                            <div class="inner">{{ $answer['answer_' . App::getLocale()] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 img-wrapper">
                <div id="answer-containers" class="answer-containers cont-ans-31" style="position: relative">
                    <div class="image">
                        <img src="{{ url(Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_image']) }}"
                            class="img-fluid">
                    </div>
                    @foreach (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answers'] as $answer)
                        <div class="answer-container answer-container{{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_uuid'] }} ans-opt answer-cont-31 d-none"
                            data-type="{{ $answer['answer_' . App::getLocale()] }}"
                            data-question-id="{{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_uuid'] }}"
                            data-top="{{ $answer['top_position'] }}" data-left="{{ $answer['left_position'] }}"
                            data-check="{{ $answer['answer_' . App::getLocale()] }}"
                            style="top: {{ $answer['top_position'] }}%; left: {{ $answer['left_position'] }}%;">
                        </div>
                    @endforeach

                </div>
            </div>
        @endif

    </div>
@elseif(Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_type'] ==
        'mcq')
    <div class="row checkbox-question">
        <div class="col-lg-6 col-md-6 col-sm-12 text">
            <div class="question-head">
                <p class="question-text">
                    {{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['arrangment'] }}
                    -
                    <span
                        class="question-text-text">{{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_' . App::getLocale()] }}</span>
                </p>
            </div>
            <span style="color: red;display: none"
                class="answered-span">{{ trans('messages.You answered this question') }}</span>
            <span style="color: red;display: none"
                class="skiped-span">{{ trans('messages.You skiped this question') }}</span>
            <div class="answer-wrapper">
                @foreach (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answers'] as $answer)
                    @php
                        if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'yes' && in_array($answer['id'], Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['selectedAnswers'])) {
                            if ($answer['right_answer'] == 1) {
                                $class = 'right-answer';
                            } else {
                                $class = 'wrong-answer';
                            }
                        } else {
                            if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'skiped') {
                                if ($answer['right_answer'] == 1) {
                                    $class = 'right-answer';
                                } else {
                                    $class = 'no-answer';
                                }
                            } else {
                                if ($answer['right_answer'] == 1 && Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'yes') {
                                    $class = 'right-answer';
                                } else {
                                    $class = 'no-answer';
                                }
                            }
                        }
                        if (Session::get('exam_object')['examCategory'][$current_category]['explaination_while_exam'] != 1) {
                            $class = 'no-answer';
                        }
                    @endphp

                    <p class="{{ $class }}">
                        <input type="checkbox" id="test{{ $answer['id'] }}" class="radio-group" name="checkbox-group"
                            value="{{ $answer['id'] }}"
                            {{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'yes' && in_array($answer['id'], Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['selectedAnswers']) ? 'checked' : '' }}>
                        {{-- <input type="checkbox" id="test{{ $answer['id'] }}" name="radio-group"
                            {{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'yes' && $answer['id'] == Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered_id'] ? 'checked' : '' }}
                            onclick="answerMcqQuestion({{ $current_category }},{{ $current_question }},{{ $answer['id'] }})"> --}}
                        <label for="test{{ $answer['id'] }}">
                            <span class="question-answer">
                                {{ $answer['answer_' . App::getLocale()] }}
                            </span>
                        </label>
                    </p>
                @endforeach
                @if (
                    (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] ==
                        'skiped' ||
                        Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] ==
                            'yes') &&
                        Session::get('exam_object')['examCategory'][$current_category]['explaination_while_exam'] == 1)
                    <p class="question_explaination">
                        {{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answer_explanation_' . App::getLocale()] }}
                    </p>
                @endif

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 img">
            <img src="{{ url(Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_image']) }}"
                alt="">
        </div>
    </div>
@elseif(Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_type'] ==
        'mcq_image')
    <div class="row images-select-question">
        <div class="col-lg-12 col-md-12 col-sm-12 text">
            <div class="question-head">
                <p class="question-text-text">
                    {{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_' . App::getLocale()] }}
                </p>
            </div>
            <span style="color: red;display: none"
                class="answered-span">{{ trans('messages.You answered this question') }}</span>
            <span style="color: red;display: none"
                class="skiped-span">{{ trans('messages.You skiped this question') }}</span>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 images">
            <ul>
                @foreach (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answers'] as $answer)
                    @php
                        if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'yes' && in_array($answer['id'], Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['selectedAnswers'])) {
                            if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['right_answer'] == 1) {
                                $class = 'right-answer';
                            } else {
                                $class = 'wrong-answer';
                            }
                        } else {
                            if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'skiped') {
                                if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['right_answer'] == 1) {
                                    $class = 'right-answer';
                                } else {
                                    $class = 'no-answer';
                                }
                            } else {
                                if ($answer['right_answer'] == 1 && Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'yes') {
                                    $class = 'right-answer';
                                } else {
                                    $class = 'no-answer';
                                }
                            }
                        }
                        if (Session::get('exam_object')['examCategory'][$current_category]['explaination_while_exam'] != 1) {
                            $class = 'no-answer';
                        }
                    @endphp
                    <li class="{{ $class }}">
                        <input type="checkbox" class="radio-group" name="checkbox-group" value="{{ $answer['id'] }}"
                            {{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'yes' && in_array($answer['id'], Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['selectedAnswers']) ? 'checked' : '' }}
                            id="cb{{ $answer['id'] }}">
                        <label for="cb{{ $answer->id }}">
                            <img src="{{ url($answer->answer_image) }}" />
                        </label>
                    </li>
                @endforeach
            </ul>
            @if (
                (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] ==
                    'skiped' ||
                    Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] ==
                        'yes') &&
                    Session::get('exam_object')['examCategory'][$current_category]['explaination_while_exam'] == 1)
                <br>
                <p class="question_explaination">
                    {{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answer_explanation_' . App::getLocale()] }}
                </p>
            @endif
        </div>
    </div>
@elseif(Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_type'] ==
        'text_input')
    <div class="row number-question">
        <div class="col-lg-6 col-md-6 col-sm-12 text">
            <div class="question-head">
                <p class="question-text-text">
                    {{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_' . App::getLocale()] }}
                </p>
            </div>

            <div class="answer-wrapper">
                <label for="answer-number" class="form-label">{{ trans('messages.Type your answer here') }}</label>
                @if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'yes')
                    <input type="number" name="answer-number" id="answer-number"
                        value="{{ Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answer_input'] }}"
                        onchange="putValueOnVar()">
                @else
                    <input type="number" name="answer-number" id="answer-number" onchange="putValueOnVar()">
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 img">
            <img src="{{ url(Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_image']) }}"
                alt="">
        </div>
    </div>
@endif


<div class="row btns-row">
    @if ($current_question != 0)
        <button class=" btn prev" onclick="examGetPrevQuestion({{ $current_category }},{{ $current_question }})">
            @if (App::getLocale() == 'ar')
                <i class="fa-solid fa-arrow-right-long"></i>
            @else
                <i class="fa-solid fa-arrow-left-long"></i>
            @endif

            <span>{{ trans('messages.Prev') }}</span>
        </button>
    @else
        <button class=" btn prev">
            @if (App::getLocale() == 'ar')
                <i class="fa-solid fa-arrow-right-long"></i>
            @else
                <i class="fa-solid fa-arrow-left-long"></i>
            @endif

            <span>{{ trans('messages.Prev') }}</span>
        </button>
    @endif
        <span class="questions_number" style="font-size: 24px!important;" >{{  Session::get('exam_object')->num_q .'/'. Session::get('exam_object')->questions_num}}</span>

    @if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['question_type'] !=
            'text_input' /*&&
            Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question][
                'question_type'
            ] != 'drag_drop'*/ &&
            Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] ==
                'no' &&
            Session::get('exam_object')['examCategory'][$current_category]['explaination_while_exam'] == 1)
        <button class=" btn next" onclick="getExplainQuestion({{ $current_category }},{{ $current_question }})">
            <span>{{ trans('messages.Explain') }}</span>
            @if (App::getLocale() == 'ar')
                <i class="fa-solid fa-arrow-left-long"></i>
            @else
                <i class="fa-solid fa-arrow-right-long"></i>
            @endif
        </button>
    @else
        <button class="btn next" onclick="getnextQuestion({{ $current_category }},{{ $current_question }})">
            <span>{{ trans('messages.Next') }}</span>
            @if (App::getLocale() == 'ar')
                <i class="fa-solid fa-arrow-left-long"></i>
            @else
                <i class="fa-solid fa-arrow-right-long"></i>
            @endif
        </button>
    @endif

</div>
@if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['flaged'] == 1)
    <script>
        $("#mark-question-flag i").css('color', 'red');
    </script>
@else
    <script>
        $("#mark-question-flag i").css('color', '#1ba9ff');
    </script>
@endif
<script src='https://bevacqua.github.io/dragula/dist/dragula.js'></script>
@if (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answered'] == 'no')
    <script>
        if (speak_switch == 1) {
            startSpeaking()

            function startSpeaking() {
                var sentences = [];
                sentences.push(document.getElementsByClassName("question-text-text")[0].innerText);
                var answers_speak = document.getElementsByClassName("question-answer");
                for (let index = 0; index < answers_speak.length; index++) {
                    sentences.push(answers_speak[index].innerText);
                }

                function speakSentences(sentences) {
                    if (sentences.length === 0) {
                        return;
                    }

                    var sentence = sentences.shift();
                    responsiveVoice.speak(sentence, defaultVoice, {
                        onend: function() {
                            speakSentences(sentences);
                        }
                    });
                }
                speakSentences(sentences);
            }
        }
    </script>
@else
    <script>
        if (speak_switch == 1) {
            startSpeaking()

            function startSpeaking() {
                var sentences = [];
                sentences.push(document.getElementsByClassName("question_explaination")[0].innerText);

                function speakSentences(sentences) {
                    if (sentences.length === 0) {
                        return;
                    }

                    var sentence = sentences.shift();
                    responsiveVoice.speak(sentence, defaultVoice, {
                        onend: function() {
                            speakSentences(sentences);
                        }
                    });
                }
                speakSentences(sentences);
            }
        }
    </script>
@endif
<script>
    var drag_answers_length =
        {{ sizeof(Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answers']) }};
    // Drag Question
    $(document).ready(function() {
        destroyDrake();
        spotsPositionSet();
        applyDragDrop();

    })
    var drake = null,
        $holdAnswers = [];

    function initDrake() {
        drake = new dragula([document.querySelector('.opt-31')], {
            accepts: function accepts(el, target, source, sibling) {
                if ($(target).children().length > 0 && $(target).hasClass('answer-container')) {
                    return false;
                }
                return true;
            },
        });
        drake.on('dragend', function(el) {
            if (!drake.containers[0].children.length) {
                checkResult();
            }

        });

    }

    function checkResult() {
        let answers = drake.containers.slice(1);
        let rightAnswers = [];
        let wrongAnswers = [];
        let ansObjectArr = [];
        answers.map(answer => {
            let positionCheck = answer.dataset.check;
            let answerCheck = answer.children[0].dataset.check;
            // console.log(answer);
            let ansObject = {
                answer_it: answer.children[0].dataset.check,
                answer_top: answer.dataset.top,
                answer_left: answer.dataset.left,
            }
            ansObjectArr.push(ansObject)
            if (answerCheck != undefined) {
                if (positionCheck == answerCheck) {
                    rightAnswers.push(positionCheck);
                } else {
                    wrongAnswers.push(positionCheck)
                }
            }
        })
        // console.log("Nader");
        // console.log(ansObjectArr);
        $.post(`{{ route('inExam.answerDragQuestion') }}`, {
            _token: '{{ csrf_token() }}',
            right_answers_length: rightAnswers.length,
            wrong_answers_length: wrongAnswers.length,
            right_answers: rightAnswers,
            wrong_answers: wrongAnswers,
            drag_answers_length: drag_answers_length,
            current_category: {{ $current_category }},
           //current_category: 0,
            current_question: {{ $current_question }},
            //current_question: 0,
            answers_object_arr: ansObjectArr,
        }, function(data) {
            if (data.nex_question_on_answer == 'yes') {
                //getnextQuestion(0, 0);
                getnextQuestion({{ $current_category }}, {{ $current_question }})
            }
          else {

                if (data.explaination_while_exam == 1) {
                    reloadCurrentQuestion();
                }
            }
            // console.log(data)

        });
    }

    function destroyDrake() {
        if (drake !== null) {
            drake.destroy();
            drake = null;
        }
    }

    function spotsPositionSet() {
        initDrake();
        var image = $(".cont-ans-31 .image img"),
            imgWidth = image.width(),
            imHeight = image.height(),
            answerContainers = $(".cont-ans-31 .answer-container");
        // console.log(imgWidth + '-' + imHeight);
        $.each(answerContainers, function(index, ac) {
            var top = $(ac).attr("data-top"),
                left = $(ac).attr("data-left"),
                topReduction,
                leftReduction;
            // console.log(top + '-' + left);
            // (top = (((100 * top) / 500) * imHeight) / 100), (left = (((100 * left) / 750) * imgWidth) /
            //     100);
            var width = $(ac).attr("width"),
                height = $(ac).attr("height"),
                acWidthReduction,
                acHeightReduction;
            ("" !== width && "0" !== width) || (width = 75),
            ("" !== height && "0" !== height) || (height = 75),
            (width = (((100 * width) / 750) * imgWidth) / 100),
            (height = (((100 * height) / 500) * imHeight) / 100),
            $(ac).css({
                top: top + "%",
                left: left + "%",
                width: width + "px",
                height: height + "px"
            });
        });
    }

    function applyDragDrop(num) {
        drake.on('drag', function(e, container, source) {
            var id = $(e).attr('data-question');
            $('.answer-container' + id).removeClass("d-none");
        });
        drake.on('cancel', function(e, container, source) {
            var id = $(e).attr('data-question');
            var drops = $('.answer-container' + id);
            for (let i = 0; i < drops.length; ++i) {
                var drop = $(drops[i]);
                if (drop.find('.drag-option').length === 0) {
                    drop.addClass('d-none');
                }
            }
        });
        drake.on('drop', function(e, container, source) {
            var id = $(e).attr('data-question');
            var drops = $('.answer-container' + id);
            for (let i = 0; i < drops.length; ++i) {
                var drop = $(drops[i]);
                if (drop.find('.drag-option').length === 0) {
                    drop.addClass('d-none');
                }
            }
            if ($(e).closest('.priority-order').length) {
                var ans = [];
                var question = '';
                var check = '';
                var opt = '';
                var resp = '';
                $('.ans-opt .drag-option').each(function() {
                    question = $(this).attr('data-question');
                    check = $(this).attr('data-num');
                    opt = $(this).closest('.answer-container').attr('data-type');
                    resp = opt + '-' + check;
                    ans.push(resp);
                });
                $('.one-drop-answer-' + question).attr('value', ans.join());
            } else {
                var question = $(e).attr('data-question');
                // var ans= $(e).attr('data-type');
                var ans = $(e).closest('.answer-container').attr('data-type');
                $('.one-drop-answer-' + question).val(ans);
            }

        });
        var answerContainers = $('.answer-cont-31');
        $.each(answerContainers, function(index, ac) {
            drake.containers.push(ac);
        });
    }
</script>
<script>
    var current_category_counter_type =
        "{{ Session::get('exam_object')['examCategory'][$current_category]['duration_type'] }}";
    var current_counter_duration = "{{ Session::get('exam_object')['examCategory'][$current_category]['duration'] }}";
    if (current_category_counter_type == 'for_question') {
        current_counter_duration = current_counter_duration * 1000;
    } else {
        current_counter_duration = current_counter_duration * 60000;
    }
    if (timer_check_to_initiat_category_again == {{ $current_category }} && current_category_counter_type ==
        'for_category') {
        timer_check_to_initiat_category_again = {{ $current_category }};
    } else {
        resetCounter()
        timer_check_to_initiat_category_again = {{ $current_category }};
        initCounter(current_category_counter_type, current_counter_duration, {{ $current_category }},
            {{ $current_question }});

    }

    $('#progress-of-all').html(
        ` <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: {{ round($examProgressPersentage) }}%;"
                        aria-valuenow="{{ round($examProgressPersentage) }}" aria-valuemin="0" aria-valuemax="100">{{ round($examProgressPersentage) }}%</div>`
    )
</script>
