@extends('site.layouts.main')
@section('meta_title')
    {{ trans('messages.Adnan Eltaher') . ' | ' . Session::get('exam_object')['name_' . App::getLocale()] }}
@stop
@section('content')
    <style>
        .right-answer {
            background-color: green !important;
            padding: 0.4em;
            border-radius: 0.6em;
            opacity: .7;
        }

        .wrong-answer {
            background-color: red !important;
            padding: 0.4em;
            border-radius: 0.6em;
            opacity: .7;
        }

        .question_explaination {
            border: 2px solid #1ba9ff;
            padding: 1em;
            border-radius: 1em;
        }

        .right-answer-check-box {
            border: 2px solid green !important;
        }

        .wrong-answer-check-box {
            border: 2px solid red !important;
        }


        @media (max-width: 576px) {
            .mobile-navbar {
                display: flex !important;
            }

            .pc-navbar {
                display: none !important;
            }
        }

        .exam-timer {
            display: block;
            font-size: 33px;
            font-weight: 900;
            color: #1ba9ff;
        }

        .box {
            width: 48%;
            padding: 1em;
            border-radius: 5px;
            /*background-color: gre;*/
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0;
        }

        .box p {
            font-weight: bold;
            font-size: 0.9rem;
        }

        .mobile-navbar .box .toggle-control {
            display: block;
            position: relative;
            padding-left: 100px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 1rem;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .mobile-navbar .toggle-control input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .mobile-navbar .toggle-control input:checked ~ .control {
            background-color: #1ba9ff;
        }

        .mobile-navbar .toggle-control input:checked ~ .control:after {
            left: 55px;
            font-family: FontAwesome;
            content: "";
            color: #1ba9ff;
        }

        .mobile-navbar .toggle-control .control {
            position: absolute;
            top: -10px;
            left: 0;
            height: 35px;
            width: 88px;
            border-radius: 25px;
            background-color: darkgray;
            transition: background-color 0.15s ease-in;
        }

        .mobile-navbar .toggle-control .control:after {
            font-family: FontAwesome;
            content: "";
            position: absolute;
            text-align: center;
            color: grey;
            left: 5px;
            top: 5px;
            width: 25px;
            height: 25px;
            border-radius: 25px;
            background: white;
            transition: left 0.15s ease-in;
        }


    </style>
    <div class="container nav-bar-container pt-2">
        <nav class="mobile-navbar d-none align-items-center justify-content-between">
            <a onclick="openLinkMobile()" href="{{ route('inExam.doReExam') }}"
               class="d-flex logo align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <img src="{{ url('front_them/assets/imgs/small-logo.png') }}" alt="">
            </a>
            <div class="box sound hide-after-exam" style="width:auto !important; padding: 1em 0.2em" onclick="testaaaa()">
                <label class="toggle-control">
                    <input id="sound-btn-mobile" type="checkbox" checked="checked">
                    <span class="control"></span>
                </label>
            </div>
            <span class="exam-timer" id="timeExam">
            {{Session::get('exam_object')->duration_in_minutes}}
        </span>
            <button class="btn icon-btn hide-after-exam" onclick="getCurrentResult()">
                <i class="fa-solid fa-grip" style="color:#1ba9ff; font-size:40px"></i>
            </button>
            <button id="mark-question-flag" class="btn icon-btn hide-after-exam"
                    onclick="markCurrentQuestionAsFlaged()">
                <i class="fa-solid fa-flag" style="color:#1ba9ff !important; font-size:40px"></i></button>
            @if ($user_id == 0)
                <button class="btn icon-btn show-after-exam" style="display: none"
                        onclick="getFinishedExamResultGuest({{ $exam_id }})">
                    <i class="fa-solid fa-grip" style="color:#1ba9ff; font-size:40px"></i>
                </button>
            @else
                <button class="btn icon-btn show-after-exam" style="display: none"
                        onclick="getFinishedExamResultUser({{ $exam_id }},{{ $user_id }})">
                    <i class="fa-solid fa-grip" style="color:#1ba9ff; font-size:40px"></i>
                </button>
            @endif
        </nav>
    </div>
    <section class="container-fluid test-page-wrapper">
        <div class="container">
            <div class="row top-row">
                <button class="btn test-btn">
                    {{ Session::get('exam_object')['name_' . App::getLocale()] }}
                </button>
                <div class="progress" style="height: 20px;" id="progress-of-all">
                    <div class="progress-bar" role="progressbar" aria-label="Example with label"
                         style="width: {{ $examProgressPersentage }}%;" aria-valuenow="{{ $examProgressPersentage }}"
                         aria-valuemin="0" aria-valuemax="100">{{ $examProgressPersentage }}%
                    </div>
                </div>
                <!-- <div class="btns" id="redo-exam-btn">
                    <a class="btn repeat" href="{{ route('inExam.doReExam') }}">
                        <i class="fa-solid fa-rotate"></i>
                        <span>{{ trans('messages.Re-examination') }}</span>
                    </a>
                </div> -->
            </div>
{{--            <div class="mobile-top-row">--}}
{{--                <a class="btn test-btn" href="{{route('inExam.doReExam')}}">--}}
{{--                    <i class="fa-solid fa-rotate"></i>--}}
{{--                    {{ Session::get('exam_object')['name_' . App::getLocale()] }}--}}
{{--                </a>--}}
{{--            </div>--}}
            <div class="row test-card-wrapper mt-2 mb-5">
                <div class="row progress_bar" id="time_progress_bar">
                    <div></div>
                </div>
                <div class="test-card">
                    <div class="row head mobile-head">
                        <div class="row">
                            {{-- <div class="font-btns">
                                <button class="btn increase-font">
                                    A+
                                </button>
                                <button class="btn decrease-font">
                                    A-
                                </button>
                            </div>
                             --}}
                            <div class="box sound hide-after-exam">
                                <label class="toggle-control">
                                    <input id="sound-btn" type="checkbox" checked="checked">
                                    <span class="control"></span>
                                </label>
                            </div>
                            {{--
                            <div class="box speak hide-after-exam">
                                <label class="toggle-control">
                                    <input id="speak-btn" type="checkbox" checked="checked">
                                    <span class="control"></span>
                                </label>
                            </div> --}}
                        </div>
                        <div class="row mobile-head-icons">
                            <button class="btn icon-btn hide-after-exam" onclick="getCurrentResult()">
                                <i class="fa-solid fa-grip"></i>
                            </button>
                            <button id="mark-question-flag" class="btn icon-btn hide-after-exam"
                                    onclick="markCurrentQuestionAsFlaged()">
                                <i class="fa-solid fa-flag"></i></button>
                            <button class="btn icon-btn hide-after-exam" onclick="showReportModel()">
                                <i class="fa-solid fa-triangle-exclamation"></i></button>

                            @if ($user_id == 0)
                                <button class="btn icon-btn show-after-exam" style="display: none"
                                        onclick="getFinishedExamResultGuest({{ $exam_id }})">
                                    <i class="fa-solid fa-grip"></i>
                                </button>
                            @else
                                <button class="btn icon-btn show-after-exam" style="display: none"
                                        onclick="getFinishedExamResultUser({{ $exam_id }},{{ $user_id }})">
                                    <i class="fa-solid fa-grip"></i>
                                </button>
                            @endif
                            <a href="{{ route('home') }}" class="btn icon-btn show-after-exam" style="display: none">
                                <i class="fa-sharp fa-solid fa-house"></i> </a>
                        </div>
                    </div>
                    <div class="row head desktop-head" id="current-exam-head">
                        <div class="settings-btns">
                            {{-- <div class="font-btns">
                                <button class="btn increase-font">
                                    A+
                                </button>
                                <button class="btn decrease-font">
                                    A-
                                </button>
                            </div>
                            --}}
                            <div class="box sound hide-after-exam">
                                <label class="toggle-control">
                                    <input id="sound-btn-desktop" type="checkbox" checked="checked">
                                    <span class="control"></span>
                                </label>
                            </div>
                            {{-- <div class="box speak hide-after-exam">
                                <label class="toggle-control">
                                    <input id="speak-btn" type="checkbox" checked="checked">
                                    <span class="control"></span>
                                </label>
                            </div> --}}
                        </div>
                        <div class="question-counter" style="width:fit-content">
                            <span class="counter" id="question_counter" style="font-size: 35px;color:white; font-weight:900">{{Session::get('exam_object')->num_q .'/'.Session::get('exam_object')->questions_num}}</span>
                        </div>
                        <div class="info-btns" id="current-exam-analysis-data">
                            <button class="btn hide-after-exam" onclick="getCurrentResult()">
                                <i class="fa-solid fa-grip"></i>
                            </button>
                            <button class="btn hide-after-exam" onclick="markCurrentQuestionAsFlaged()"
                                    id="mark-question-flag">
                                <i class="fa-solid fa-flag"></i></button>
                            <button class="btn hide-after-exam" onclick="showReportModel()">
                                <i class="fa-solid fa-triangle-exclamation"></i></button>

                            @if ($user_id == 0)
                                <button class="btn show-after-exam" style="display: none"
                                        onclick="getFinishedExamResultGuest({{ $exam_id }})">
                                    <i class="fa-solid fa-grip"></i>
                                </button>
                            @else
                                <button class="btn show-after-exam" style="display: none"
                                        onclick="getFinishedExamResultUser({{ $exam_id }},{{ $user_id }})">
                                    <i class="fa-solid fa-grip"></i>
                                </button>
                            @endif
                            <a href="{{ route('home') }}" class="btn show-after-exam" style="display: none">
                                <i class="fa-sharp fa-solid fa-house"></i> </a>
                        </div>
                    </div>
                    <div class="row data-wrapper question-container">
                        @if (Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_type'] ==
                                'drag_drop')
                            <div class="row drag-row">
                                <div class="col-lg-6 col-md-6 col-sm-12 text-wrapper">
                                    <div class="question-head">
                                        <p class="question-text">
                                            {{ Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['arrangment'] }}
                                            -
                                            <span
                                                class="question-text-text">{{ Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_' . App::getLocale()] }}</span>
                                        </p>
                                    </div>
                                    <div id="options" class="options opt-31 h-50">
                                        @foreach (Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['answers'] as $answer)
                                            <div class="drag-option"
                                                 data-type="{{ $answer['answer_' . App::getLocale()] }}"
                                                 data-num="{{ $answer['answer_' . App::getLocale()] }}"
                                                 data-question="{{ Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_uuid'] }}"
                                                 data-check="{{ $answer['answer_' . App::getLocale()] }}">
                                                <div class="inner">{{ $answer['answer_' . App::getLocale()] }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 img-wrapper">
                                    <div id="answer-containers" class="answer-containers cont-ans-31"
                                         style="position: relative">
                                        <div class="image">
                                            <img
                                                src="{{ url(Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_image']) }}"
                                                class="img-fluid">
                                        </div>
                                        @foreach (Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['answers'] as $answer)
                                            <div
                                                class="answer-container answer-container{{ Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_uuid'] }} ans-opt answer-cont-31 d-none"
                                                data-type="{{ $answer['answer_' . App::getLocale()] }}"
                                                data-question-id="{{ Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_uuid'] }}"
                                                data-top="{{ $answer['top_position'] }}"
                                                data-left="{{ $answer['left_position'] }}"
                                                data-check="{{ $answer['answer_' . App::getLocale()] }}"
                                                style="top: {{ $answer['top_position'] }}%; left: {{ $answer['left_position'] }}%;">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        @elseif(Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_type'] ==
                                'mcq')
                            <div class="row checkbox-question">
                                <div class="col-lg-6 col-md-6 col-sm-12 text">
                                    <div class="question-head">
                                        <p class="question-text">
                                            {{ Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['arrangment'] }}
                                            -
                                            <span
                                                class="question-text-text">{{ Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_' . App::getLocale()] }}</span>
                                        </p>
                                    </div>
                                    <div class="answer-wrapper">
                                        @foreach (Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['answers'] as $answer)
                                            <p>
                                                <input type="checkbox" id="test{{ $answer['id'] }}"
                                                       class="checkbox-group" name="checkbox-group"
                                                       value="{{ $answer['id'] }}"
                                                    {{ Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['answered'] == 'yes' && in_array($answer['id'], Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['selectedAnswers']) ? 'checked' : '' }}>

                                                <label for="test{{ $answer['id'] }}">
                                                    <span class="question-answer">
                                                        {{ $answer['answer_' . App::getLocale()] }}
                                                    </span>
                                                </label>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 img">
                                    <img
                                        src="{{ url(Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_image']) }}"
                                        alt="">
                                </div>
                            </div>
                        @elseif(Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_type'] ==
                                'mcq_image')
                            <div class="row images-select-question">
                                <div class="col-lg-12 col-md-12 col-sm-12 text">
                                    <div class="question-head">
                                        <p class="question-text-text">
                                            {{ Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_' . App::getLocale()] }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 images">
                                    <ul>
                                        @foreach (Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['answers'] as $answer)
                                            <li><input name="img" type="radio" id="cb{{ $answer->id }}"
                                                       onclick="answerMcqImageQuestion({{ $currnet_category }},{{ $currnet_question }},{{ $answer['id'] }})"/>
                                                <label for="cb{{ $answer->id }}"><img
                                                        src="{{ url($answer->answer_image) }}"/></label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @elseif(Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_type'] ==
                                'text_input')
                            <div class="row number-question">
                                <div class="col-lg-6 col-md-6 col-sm-12 text">
                                    <div class="question-head">
                                        <p class="question-text-text">
                                            {{ Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_' . App::getLocale()] }}
                                        </p>
                                    </div>
                                    <div class="answer-wrapper">
                                        <label for="answer-number"
                                               class="form-label">{{ trans('messages.Type your answer here') }}</label>
                                        <input type="number" name="answer-number" id="answer-number"
                                               onchange="putValueOnVar()">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 img">
                                    <img
                                        src="{{ url(Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_image']) }}"
                                        alt="">
                                </div>
                            </div>
                        @endif

                        <div class="row btns-row">
                            <button class=" btn prev">
                                @if (App::getLocale() == 'ar')
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                @else
                                    <i class="fa-solid fa-arrow-left-long"></i>
                                @endif

                                <span>{{ trans('messages.Prev') }}</span>
                            </button>
                            <span class="questions_number" style="font-size: 24px!important;">{{Session::get('exam_object')->num_q .'/'.Session::get('exam_object')->questions_num}}</span>
                            @if (Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['question_type'] !=
                                    'text_input' /*&&
                                    Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question][
                                        'question_type'
                                    ] != 'drag_drop'*/ &&
                                    Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['answered'] ==
                                        'no' &&
                                    Session::get('exam_object')['examCategory'][$currnet_category]['explaination_while_exam'] == 1)
                                <button class="btn next"
                                        onclick="getExplainQuestion({{ $currnet_category }},{{ $currnet_question }})">
                                    <span>{{ trans('messages.Explain') }}</span>
                                    @if (App::getLocale() == 'ar')
                                        <i class="fa-solid fa-arrow-left-long"></i>
                                    @else
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    @endif
                                </button>
                            @else
                                <button class="btn next"
                                        onclick="getnextQuestion({{ $currnet_category }},{{ $currnet_question }})">
                                    <span>{{ trans('messages.Next') }}</span>
                                    @if (App::getLocale() == 'ar')
                                        <i class="fa-solid fa-arrow-left-long"></i>
                                    @else
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    @endif
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-top-row" style="margin-bottom:80px;flex-wrap: wrap;">
                <a class="btn test-btn" href="{{route('inExam.doReExam')}}" style="width:255px; border-radius:10px; margin-bottom: 0.6rem">
                    <i class="fa-solid fa-rotate"></i>
                    {{ __('messages.reloadExam') }}
                </a>
                <a class="btn test-btn hide-after-exam" href="{{route('start_package')}}" style="width:255px; border-radius:10px; margin-bottom: 0.6rem">
                    <i class="fa-solid fa-rotate"></i>
                    {{ __('messages.backExam') }}
                </a>
        </div>
        </div>
    </section>
    <!-- Report Modal -->
    <div class="modal fade report-modal" id="report-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-btn">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            style="all: unset; font-size: 1.5em; color: #1ba9ff;cursor: pointer;padding: .5em">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="head">
                        <h2 class="title">{{ trans('messages.Report an error') }}</h2>
                    </div>
                    <div class="content" id="report-modal-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Overview Modal -->
    <div class="modal fade overview-modal" id="overview-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="head">
                        <h2 class="title">نظرة عامة</h2>
                        <p class="desc">
                            هنا يمكنك روئية الأسئلة التي قمت بوضع علامة عليها بهذه الطريقة يمكنك بسهولة العودة الي هذه
                            الاسئلة </p>

                    </div>
                    <div class="content">
                        <div class="questions-wrapper">
                            <div class="question">
                                <i class="fa-solid fa-star"></i>
                                <span>1</span>
                            </div>
                            <div class="question">
                                <span>2</span>
                            </div>
                            <div class="question">
                                <span>3</span>
                            </div>
                            <div class="question">
                                <span>4</span>
                            </div>
                            <div class="question">
                                <span>5</span>
                            </div>
                            <div class="question">
                                <span>6</span>
                            </div>
                            <div class="question">
                                <span>7</span>
                            </div>
                            <div class="question wrong">
                                <span>8</span>
                            </div>
                            <div class="question">
                                <span>9</span>
                            </div>
                            <div class="question success">
                                <span>10</span>
                            </div>
                            <div class="question">
                                <span>11</span>
                            </div>
                            <div class="question">
                                <span>12</span>
                            </div>
                            <div class="question">
                                <span>13</span>
                            </div>
                            <div class="question">
                                <span>14</span>
                            </div>
                            <div class="question">
                                <span>15</span>
                            </div>
                            <div class="question">
                                <span>16</span>
                            </div>
                        </div>
                        <hr>
                        <div class="info-wrapper">
                            <p class="info-title">
                                ماذا تعنى الألوان
                            </p>
                            <div class="info-questions-wrapper">
                                <div class="wrapper">
                                    <div class="question">
                                        <span>0</span>
                                    </div>
                                    <p>دون جواب</p>
                                </div>
                                <div class="wrapper">
                                    <div class="question">
                                        <i class="fa-solid fa-star"></i>
                                        <span>0</span>
                                    </div>
                                    <p>ملحوظ</p>
                                </div>
                                <div class="wrapper">
                                    <div class="question success">
                                        <span>0</span>
                                    </div>
                                    <p>صحيح</p>
                                </div>
                                <div class="wrapper">
                                    <div class="question wrong">
                                        <span>0</span>
                                    </div>
                                    <p>خطأ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Result Modal -->
    <div class="modal fade result-modal" id="result-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="close-btn">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                                style="all: unset; font-size: 1.5em; color: #1ba9ff;cursor: pointer;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="head">
                        <h2 class="title">{{ trans('messages.test result') }}</h2>
                        <p class="desc">
                            {{ trans('messages.You can see the results in real time') }}
                        </p>
                    </div>
                    <div class="content" id="result-modal-content">
                        <!-- Current Result  -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=WAozBwGV"></script>
    <script src='https://bevacqua.github.io/dragula/dist/dragula.js'></script>


    @if (App::getLocale() == 'nl')
        <script>
            let defaultVoice = "Dutch Male";
        </script>
    @elseif(App::getLocale() == 'ar')
        <script>
            let defaultVoice = "Arabic Male";
        </script>
    @elseif(App::getLocale() == 'en')
        <script>
            let defaultVoice = "US English Male";
        </script>
    @endif
    <script>


        var speak_switch = 1;
        $('#sound-btn-desktop').on('change', function () {
            if ($(this).is(':checked')) {
                speak_switch = 1;
                startSpeaking();
            } else {
                speak_switch = 0;
                responsiveVoice.pause();
            }
        });
       /* $('#sound-btn-mobile').on('change', function () {
            console.log($(this))
            if ($(this).is(':checked')) {
                speak_switch = 1;
                startSpeaking();
            } else {
                speak_switch = 0;
                responsiveVoice.pause();
            }
        });*/
        $('#sound-btn').on('change', function () {
            if ($(this).is(':checked')) {
                speak_switch = 1;
            } else {
                speak_switch = 0;
                responsiveVoice.pause();
            }
        });

        function testaaaa() {
            if ($('#sound-btn-mobile').is(':checked')) {
                $('#sound-btn-mobile').val(0);
                $('#sound-btn-mobile').change();
                $('#sound-btn-mobile').removeAttr('checked');
                $('#sound-btn-mobile').checked = false;
                speak_switch = 0;
                responsiveVoice.pause();
            } else {
                $('#sound-btn-mobile').val(1);
                $('#sound-btn-mobile').change();
                $('#sound-btn-mobile').attr('checked',true);
                $('#sound-btn-mobile').checked = true;
                speak_switch = 1;
                startSpeaking();
            }
        }
        if (speak_switch == 1) {
            startSpeaking()

            function startSpeaking() {
                var sentences = [];
                sentences.push(document.getElementsByClassName("question-text-text")[0].innerText);
                var answers_speak = document.getElementsByClassName("question-answer");
                for (let index = 0; index < answers_speak.length; index++) {
                    sentences.push(answers_speak[index].innerText);
                }
                console.log('Nader' + sentences.length);

                function speakSentences(sentences) {
                    if (sentences.length === 0) {
                        return;
                    }

                    var sentence = sentences.shift();
                    responsiveVoice.speak(sentence, defaultVoice, {
                        onend: function () {
                            speakSentences(sentences);
                        }
                    });
                }

                speakSentences(sentences);
            }
        }

        var drag_answers_length =
            {{ sizeof(Session::get('exam_object')['examCategory'][$currnet_category]['questions'][$currnet_question]['answers']) }};
        // Drag Question
        $(document).ready(function () {
            destroyDrake();
            spotsPositionSet();
            applyDragDrop();
            $('footer').addClass('none_footer')
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
            drake.on('dragend', function (el) {
                if (!drake.containers[0].children.length) {
                    checkResult();
                }

            });

        }
        startTimer({{Session::get('exam_object')->duration_in_minutes}})
        function startTimer(duration) {
            var timer = duration *60
                , minutes
                , seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                $('#timeExam').text(minutes + ":" + seconds);

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
        }

        function checkResult() {
            let answers = drake.containers.slice(1);
            let rightAnswers = [];
            let wrongAnswers = [];
            let ansObjectArr = [];
            answers.map(answer => {
                let positionCheck = answer.dataset.check;
                // console.log(answer);
                let answerCheck = answer.children[0].dataset.check;
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
            $.post(`{{ route('inExam.answerDragQuestion') }}`, {
                _token: '{{ csrf_token() }}',
                right_answers_length: rightAnswers.length,
                wrong_answers_length: wrongAnswers.length,
                right_answers: rightAnswers,
                wrong_answers: wrongAnswers,
                drag_answers_length: drag_answers_length,
                current_category: {{ $currnet_category }},
                //current_category: 0,
                current_question: {{ $currnet_question }},
                //current_question: 0,
                answers_object_arr: ansObjectArr,
            }, function (data) {
                if (data.nex_question_on_answer == 'yes') {
                    getnextQuestion({{ $currnet_category }}, {{ $currnet_question }})
                    //getnextQuestion(0,0)
                } else {
                    if (data.explaination_while_exam == 1) {
                        reloadCurrentQuestion();
                    }

                }

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
            $.each(answerContainers, function (index, ac) {
                var top = $(ac).attr("data-top"),
                    left = $(ac).attr("data-left"),
                    topReduction,
                    leftReduction;
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
            drake.on('drag', function (e, container, source) {
                var id = $(e).attr('data-question');
                $('.answer-container' + id).removeClass("d-none");
            });
            drake.on('cancel', function (e, container, source) {
                var id = $(e).attr('data-question');
                var drops = $('.answer-container' + id);
                for (let i = 0; i < drops.length; ++i) {
                    var drop = $(drops[i]);
                    if (drop.find('.drag-option').length === 0) {
                        drop.addClass('d-none');
                    }
                }
            });
            drake.on('drop', function (e, container, source) {
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
                    $('.ans-opt .drag-option').each(function () {
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
            $.each(answerContainers, function (index, ac) {
                drake.containers.push(ac);
            });
        }
    </script>
    <script type="text/javascript">
        var enable_click = false;
        // disable nav bar and footer while exam
        $('nav').click(function () {
            return enable_click;
        });
        $('footer').click(function () {
            return enable_click;
        });
        $('#logout-click-button').remove();
        $(function () {
            if (performance.navigation.type == 1) {
                saveExamResultAndDoAction();
            }
        });

        function saveExamResultAndDoAction() {
            $.post(`{{ route('inExam.saveExamResultAndDoAction') }}`, {
                _token: '{{ csrf_token() }}'
            }, function (data) {
                Swal.fire({
                    icon: 'error',
                    title: "{{ trans('messages.Opps!Reloading is one attempt for you!') }}",
                    text: data.message,
                    allowOutsideClick: false
                }).then(function () {
                    window.location.href = data.route;
                });

            });
        }

        var question_input = -1;

        function putValueOnVar() {
            question_input = $('#answer-number').val()
        }

        function getnextQuestion(category, question) {
            var selectedAnswers = $('input[name="checkbox-group"]:checked').map(function () {
                return $(this).val();
            }).get();
            console.log(selectedAnswers);
            $.post(`{{ route('examGetNextQuestion') }}`, {
                _token: '{{ csrf_token() }}',
                category: category,
                question: question,
                question_input: question_input,
                selectedAnswers: selectedAnswers,
                explain: 0,
            }, function (data) {
                $('.question-container').html(data)
            });

            question_input = -1;
        }

        function getExplainQuestion(category, question) {
            var selectedAnswers = $('input[name="checkbox-group"]:checked').map(function () {
                return $(this).val();
            }).get();
            console.log(selectedAnswers);
            $.post(`{{ route('examGetNextQuestion') }}`, {
                _token: '{{ csrf_token() }}',
                category: category,
                question: question,
                question_input: question_input,
                selectedAnswers: selectedAnswers,
                explain: 1,
            }, function (data) {
                $('.question-container').html(data)
            });

            question_input = -1;
        }

        function moveToNextCategory(category, question) {
            var selectedAnswers = $('input[name="checkbox-group"]:checked').map(function () {
                return $(this).val();
            }).get();
            $.post(`{{ route('examGetNextQuestion') }}`, {
                _token: '{{ csrf_token() }}',
                category: category,
                question: question,
                question_input: question_input,
                exam_category_auto_move: 1,
                selectedAnswers: selectedAnswers,
                explain: 0,
            }, function (data) {
                $('.question-container').html(data)
            });
            question_input = -1;
        }


        function examGetPrevQuestion(category, question) {
            $.post(`{{ route('examGetPrevQuestion') }}`, {
                _token: '{{ csrf_token() }}',
                category: category,
                question: question,
            }, function (data) {
                $('.question-container').html(data)
            });
        }

        function answerMcqQuestion(current_category, current_question, answer_id) {
            $.post(`{{ route('inExam.answerMcqQuestion') }}`, {
                _token: '{{ csrf_token() }}',
                current_category: current_category,
                current_question: current_question,
                answer_id: answer_id,
            }, function (data) {
                if (data.nex_question_on_answer == 'yes') {
                    getnextQuestion(current_category, current_question)
                } else {
                    if (data.explaination_while_exam == 1) {
                        reloadCurrentQuestion();
                    }

                }
            });
        }

        function reloadCurrentQuestion() {
            $.post(`{{ route('inExam.reloadCurrentQuestion') }}`, {
                _token: '{{ csrf_token() }}'
            }, function (data) {
                $('.question-container').html(data)
            });
        }

        function reloadCurrentDragQuestion() {
            $.post(`{{ route('inExam.reloadCurrentDragQuestion') }}`, {
                _token: '{{ csrf_token() }}'
            }, function (data) {
                $('.question-container').html(data)
            });
        }

        function answerMcqImageQuestion(current_category, current_question, answer_id) {
            $.post(`{{ route('inExam.answerMcqImageQuestion') }}`, {
                _token: '{{ csrf_token() }}',
                current_category: current_category,
                current_question: current_question,
                answer_id: answer_id,
            }, function (data) {
                if (data.nex_question_on_answer == 'yes') {
                    getnextQuestion(current_category, current_question)
                } else {
                    if (data.explaination_while_exam == 1) {
                        reloadCurrentQuestion();
                    }
                }
            });
        }


        function getCurrentResult() {
            $.post(`{{ route('inExam.getExamCurrentResult') }}`, {
                _token: '{{ csrf_token() }}'
            }, function (data) {
                $('#result-modal-content').html(data);
                $('#result-modal').modal('show');
            });

        }

        function markCurrentQuestionAsFlaged() {
            $.post(`{{ route('inExam.markCurrentQuestionAsFlaged') }}`, {
                _token: '{{ csrf_token() }}'
            }, function (data) {
                if (data == 1) {
                    $("#mark-question-flag i").css('color', 'red');
                } else {
                    $("#mark-question-flag i").css('color', '#1ba9ff');
                }

            });
        }

        function getFinishedExamResultUser(f_exam_id, f_user_id) {
            $.post(`{{ route('inExam.getFinishedExamResultUser') }}`, {
                _token: '{{ csrf_token() }}',
                f_exam_id: f_exam_id,
                f_user_id: f_user_id,
            }, function (data) {
                $('#result-modal-content').html(data);
                $('#result-modal').modal('show');

            });
        }

        function getFinishedExamResultGuest(exam_id) {
            $.post(`{{ route('inExam.getFinishedExamResultGuest') }}`, {
                _token: '{{ csrf_token() }}',
                exam_id: exam_id
            }, function (data) {
                $('#result-modal-content').html(data);
                $('#result-modal').modal('show');
            });
        }

        function getPreviewAnsweredQuestion(result_id, id, answered, selectedAnswers, right_answer, answer_input) {
            $.post(`{{ route('inExam.getPreviewAnsweredQuestion') }}`, {
                _token: '{{ csrf_token() }}',
                id: id,
                answered: answered,
                selectedAnswers: selectedAnswers,
                right_answer: right_answer,
                answer_input: answer_input,
                result_id: result_id,
            }, function (data) {
                $('.question-container').html(data);
                $('#result-modal').modal('hide');

            });
        }

        function getPreviewAnsweredQuestionGuest(exam_id, id, answered, selectedAnswers, right_answer, answer_input) {
            $.post(`{{ route('inExam.getPreviewAnsweredQuestionGuest') }}`, {
                _token: '{{ csrf_token() }}',
                id: id,
                answered: answered,
                selectedAnswers: selectedAnswers,
                right_answer: right_answer,
                answer_input: answer_input,
                exam_id: exam_id,
            }, function (data) {
                $('.question-container').html(data);
                $('#result-modal').modal('hide');

            });
        }

        function showReportModel() {
            $.post(`{{ route('inExam.showReportModel') }}`, {
                _token: '{{ csrf_token() }}'
            }, function (data) {
                $('#report-modal-content').html(data);
                $('#report-modal').modal('show');
            });
        }

        // handel opning new tap
        // if ({{ $user_id }} == 0) {
        //     var open_tap_or_click_outside = 100;

        // } else {
        //     var open_tap_or_click_outside = 0; //0

        // }
        // window.addEventListener('blur', function(event) {
        //     if (open_tap_or_click_outside != 100) {
        //         open_tap_or_click_outside += 1
        //         if (open_tap_or_click_outside >= 2) {
        //             open_tap_or_click_outside = 100;
        //             makeExamFinish()
        //             Swal.fire({
        //                 icon: "{{ trans('messages.error') }}",
        //                 title: "{{ trans('messages.Oops...') }}",
        //                 text: "{{ trans('messages.You lost attempet on this exam') }}",
        //                 allowOutsideClick: false
        //             }).then(function() {
        //                 getnextQuestion(0, 0);
        //             });
        //         } else {
        //             Swal.fire({
        //                 icon: "{{ trans('messages.error') }}",
        //                 title: "{{ trans('messages.Oops...') }}",
        //                 text: "{{ trans('messages.If you open new tap or go outside of exam again you will loss one attempet for join again') }}",
        //                 allowOutsideClick: false
        //             })
        //         }
        //     }
        // });

        function makeExamFinish() {
            $.post(`{{ route('inExam.makeExamFinish') }}`, {
                _token: '{{ csrf_token() }}'
            }, function (data) {

            });
        }

        function openLinkMobile() {
            // Check if the viewport width is less than a certain value (adjust as needed)
            if (window.innerWidth < 768) {
                // Open the link or perform any action you want for mobile view
                window.location.href ="{{ route('inExam.doReExam') }}";
            }
        }


        // handel progress bar
        var current_category_counter_type =
            "{{ Session::get('exam_object')['examCategory'][$currnet_category]['duration_type'] }}";
        var current_counter_duration = "{{ Session::get('exam_object')['examCategory'][$currnet_category]['duration'] }}";
        if (current_category_counter_type == 'for_question') {
            current_counter_duration = current_counter_duration * 1000;
        } else {
            current_counter_duration = current_counter_duration * 60000;
        }
        initCounter(current_category_counter_type, current_counter_duration, 0, 0);
        // Counter
        var clear_progress = 0;
        var timer_check_to_initiat_category_again = 0;

        function initCounter(for_categor_or_question, duration_in_secound, category, question) {
            $(".progress_bar div").css({
                "width": "100%",
                "-webkit-transition": duration_in_secound / 1000 + "s linear"
            });
            clear_progress = setTimeout(function () {
                if (for_categor_or_question == 'for_question') {
                    moveToNextCategory(category, question);
                    resetCounter()
                } else {
                    makeCategoryFinishAndMovetoNextStep();
                    resetCounter()
                }
                $(".progress_bar div").css({
                    "width": "0px",
                    "-webkit-transition": ""
                });
            }, duration_in_secound)
        }

        function resetCounter() {
            // console.log('reset counter')
            $(".progress_bar div").css({
                "width": "0px",
                "-webkit-transition": ""
            });
            clearTimeout(clear_progress);
        }

        function makeCategoryFinishAndMovetoNextStep() {
            $.post(`{{ route('inExam.makeCategoryFinishAndMovetoNextStep') }}`, {
                _token: '{{ csrf_token() }}'
            }, function (data) {
                moveToNextCategory(data.current_category, data.current_question);
            });
        }

        // Disable inspect element
        $(document).bind("contextmenu", function (e) {
            e.preventDefault();
        });
        $(document).keydown(function (e) {
            if (e.which === 123) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
        });
        // Focus
        window.addEventListener('focus', function (event) {
            // console.log('has focus');
        });

        function getprevExamFinish(question_id, exam_id) {
            $.post(`{{ route('getprevExamFinish') }}`, {
                _token: '{{ csrf_token() }}',
                exam_id: exam_id,
                question_id: question_id,
            }, function (data) {
                $('.question-container').html(data);
            });
        }

        function getnextExamFinish(question_id, exam_id) {
            $.post(`{{ route('getnextExamFinish') }}`, {
                _token: '{{ csrf_token() }}',
                exam_id: exam_id,
                question_id: question_id,
            }, function (data) {
                $('.question-container').html(data);
            });
        }

        function getprevExamFinishUser(question_id, result_id) {
            $.post(`{{ route('getprevExamFinishUser') }}`, {
                _token: '{{ csrf_token() }}',
                result_id: result_id,
                question_id: question_id,
            }, function (data) {
                $('.question-container').html(data);
            });
        }

        function getnextExamFinishUser(question_id, result_id) {
            $.post(`{{ route('getnextExamFinishUser') }}`, {
                _token: '{{ csrf_token() }}',
                result_id: result_id,
                question_id: question_id,
            }, function (data) {
                $('.question-container').html(data);
            });
        }

        function jumpToQuestion(category, question, current_category) {
            if (category == current_category) {
                $.post(`{{ route('inExam.jumpToQuestion') }}`, {
                    _token: '{{ csrf_token() }}',
                    category: category,
                    question: question,
                }, function (data) {
                    $('.question-container').html(data);
                    $('#result-modal').modal('hide');
                });
            } else {
                $('.you-cant-jump-alert').show();
                setTimeout(() => {
                    $('.you-cant-jump-alert').hide();
                }, 2000);
            }
        }
    </script>
@endsection
