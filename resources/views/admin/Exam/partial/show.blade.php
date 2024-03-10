<!-- Main content -->
<style>
    .question-container {
        padding: 2em;
        background-color: cornsilk;
        margin: 1em;
        border-radius: 2px;
    }

    .question-container .question-image-container {
        padding: 2em;
    }

    .question-image-container-drop {
        position: relative;
    }

    .answer-position1 {
        position: absolute;
        width: 60px !important;
        height: 60px !important;
        line-height: 60px;
        border-radius: 30px;
        background-color: brown;
        text-align: center;
        font-size: 1.2em;
        color: #FFF;
    }
</style>
<div class="inner-exam-categories-section">
    @if (sizeof($exam->examCategory) > 0)
        <h3 class="text-center">
            {{ trans('messages.You can add new exam category from here') }}
            <a href="#" onclick="createExamCategory()"
                class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="mdi mdi-plus"><span
                        class="path1"></span><span class="path2"></span></span></a>
        </h3>
    @endif
    @forelse ($exam->examCategory as $category)
        <h4 style="background-color: black;padding: 1em;text-align: center;color: #fff;border-radius: 5px">
            <input id="category_{{ $category->id }}" onchange="updateCategoryArrangmentExam({{ $category->id }})"
                type="number" value="{{ $category->arrangment }}" style="width: 50px" min="1"
                max="{{ sizeof($exam->examCategory) }}">
            {{ $category->{'name_' . App::getLocale()} }}
            @can('exam_category_edit')
                <a href="#"
                    onclick="updateExamCategory('{{ route('examCategory.edit', [$category->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')">
                    <i class="fa fa-edit"></i> </a>
                <a href="#" onclick="deleteExamCategory({{ $exam->id }},{{ $category->id }})"><span
                        class="fa fa-trash-o"></span></a>
            @endcan
        </h4>
        <hr>
        @if (sizeof($category->questions) > 0)
            <h3 class="text-center">
                {{ trans('messages.You can add new question from here') }}
                <a href="#"
                    onclick="createQuestion('{{ route('question.create', ['exam_id' => $exam->id, 'category_id' => $category->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => true]) }}')"
                    class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="mdi mdi-plus"><span
                            class="path1"></span><span class="path2"></span></span></a>
            </h3>
        @endif
        @forelse ($category->questions as $key => $question)
            @if ($question->question_type == 'mcq' || $question->question_type == 'text_input')
                <div class="question-container">
                    <div class="row">
                        <div class="col-md">
                            <h4>
                                <input id="question_{{ $question->id }}"
                                    onchange="updateQuestionArrangmentExam({{ $question->id }})" type="number"
                                    value="{{ $question->arrangment }}" style="width: 50px" min="1"
                                    max="{{ sizeof($category->questions) }}">
                                - {{ $question->{'question_' . App::getLocale()} }}
                                @can('question_update')
                                    <a href="#"
                                        onclick="updateQuestion('{{ route('question.edit', [$question->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')">
                                        <i class="fa fa-edit"></i> </a>
                                    <a href="#"
                                        onclick="deleteExamQuestion({{ $exam->id }},{{ $question->id }})"><span
                                            class="fa fa-trash-o"></span></a>
                                    <a href="#" title="copy"
                                       onclick="copyQuestion({{ $exam->id }},{{$question->id }})"><span
                                            class="fa fa-copy"></span></a>
                                @endcan
                            </h4>
                            <div class="answer-container">
                                @if (sizeof($question->answers) > 0)
                                    <h3 class="text-center">
                                        {{ trans('messages.You can add new answer from here') }}
                                        <a href="#"
                                            onclick="createAnswer('{{ route('answer.create', ['question_id' => $question->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')"
                                            class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="mdi mdi-plus"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    </h3>
                                @endif
                                @forelse ($question->answers as $key2 => $answer)
                                    <h5
                                        style="margin-inline-start: 20px; {{ $answer->right_answer == true ? 'background-color:green;color:#fff' : '' }}">
                                        <input id="answer_{{ $answer->id }}"
                                            onchange="updateAnswerArrangment({{ $answer->id }})" type="number"
                                            value="{{ $answer->arrangment }}" style="width: 40px" min="1"
                                            max="{{ sizeof($question->answers) }}"> -
                                        {{ $answer->{'answer_' . App::getLocale()} }}
                                        <a href="#"
                                            onclick="updateAnswer('{{ route('answer.edit', [$answer->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')">
                                            <i class="fa fa-edit"></i> </a>
                                        <a href="#"
                                            onclick="deleteExamAnswer({{ $exam->id }},{{ $answer->id }})"><span
                                                class="fa fa-trash-o"></span></a>
                                    </h5>
                                @empty
                                    <h3 class="text-center">
                                        {{ trans('messages.There is no answers in this question you can add one from here') }}
                                        <a href="#"
                                            onclick="createAnswer('{{ route('answer.create', ['question_id' => $question->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')"
                                            class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="mdi mdi-plus"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    </h3>
                                @endforelse
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="question-image-container">
                                @php
                                    if ($question->question_image) {
                                        $link = $question->question_image;
                                    } else {
                                        $link = '/images/noimg.png';
                                    }

                                @endphp
                                <img id="question_image" src="{{ url($link) }}" alt="your question_image" />
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($question->question_type == 'drag_drop')
                <div class="question-container">
                    <div class="row">
                        <div class="col-md">
                            <h4>
                                <input id="question_{{ $question->id }}"
                                    onchange="updateQuestionArrangmentExam({{ $question->id }})" type="number"
                                    value="{{ $question->arrangment }}" style="width: 50px" min="1"
                                    max="{{ sizeof($category->questions) }}">
                                - {{ $question->{'question_' . App::getLocale()} }}
                                @can('question_update')
                                    <a href="#"
                                        onclick="updateQuestion('{{ route('question.edit', [$question->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')">
                                        <i class="fa fa-edit"></i> </a>
                                    <a href="#"
                                        onclick="deleteExamQuestion({{ $exam->id }},{{ $question->id }})"><span
                                            class="fa fa-trash-o"></span></a>
                                    <a href="#" title="copy"
                                       onclick="copyQuestion({{ $exam->id }},{{$question->id }})"><span
                                            class="fa fa-copy"></span></a>
                                @endcan
                            </h4>
                            <div class="answer-container">
                                @if (sizeof($question->answers) > 0)
                                    <h3 class="text-center">
                                        {{ trans('messages.You can add new answer from here') }}
                                        <a href="#"
                                            onclick="createAnswer('{{ route('answer.create', ['question_id' => $question->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')"
                                            class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="mdi mdi-plus"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    </h3>
                                @endif
                                @forelse ($question->answers as $key2 => $answer)
                                    <h5
                                        style="margin-inline-start: 20px; {{ $answer->right_answer == true ? 'background-color:green;color:#fff' : '' }}">
                                        <input id="answer_{{ $answer->id }}"
                                            onchange="updateAnswerArrangment({{ $answer->id }})" type="number"
                                            value="{{ $answer->arrangment }}" style="width: 40px" min="1"
                                            max="{{ sizeof($question->answers) }}"> -
                                        {{ $answer->{'answer_' . App::getLocale()} }}
                                        <a href="#"
                                            onclick="updateAnswer('{{ route('answer.edit', [$answer->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')">
                                            <i class="fa fa-edit"></i> </a>
                                        <a href="#"
                                            onclick="deleteExamAnswer({{ $exam->id }},{{ $answer->id }})"><span
                                                class="fa fa-trash-o"></span></a>
                                    </h5>
                                @empty
                                    <h3 class="text-center">
                                        {{ trans('messages.There is no answers in this question you can add one from here') }}
                                        <a href="#"
                                            onclick="createAnswer('{{ route('answer.create', ['question_id' => $question->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')"
                                            class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="mdi mdi-plus"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    </h3>
                                @endforelse
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="question-image-container-drop">
                                @forelse ($question->answers as $key2 => $answer)
                                    <div class="answer-position1"
                                        style="top: {{ $answer->top_position }}%;left: {{ $answer->left_position }}%;">
                                        {{ $answer->{'answer_' . App::getLocale()} }}
                                    </div>
                                @empty
                                @endforelse
                                @php
                                    if ($question->question_image) {
                                        $link = $question->question_image;
                                    } else {
                                        $link = '/images/noimg.png';
                                    }

                                @endphp
                                <img id="question_image" src="{{ url($link) }}" alt="your question_image" />
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($question->question_type == 'mcq_image')
                <div class="question-container">
                    <div class="question-answer-images">
                        <h4>
                            <input id="question_{{ $question->id }}"
                                onchange="updateQuestionArrangmentExam({{ $question->id }})" type="number"
                                value="{{ $question->arrangment }}" style="width: 50px" min="1"
                                max="{{ sizeof($category->questions) }}">
                            - {{ $question->{'question_' . App::getLocale()} }}
                            @can('question_update')
                                <a href="#"
                                    onclick="updateQuestion('{{ route('question.edit', [$question->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')">
                                    <i class="fa fa-edit"></i> </a>
                                <a href="#"
                                    onclick="deleteExamQuestion({{ $exam->id }},{{ $question->id }})"><span
                                        class="fa fa-trash-o"></span></a>
                                <a href="#" title="copy"
                                   onclick="copyQuestion({{ $exam->id }},{{$question->id }})"><span
                                        class="fa fa-copy"></span></a>
                            @endcan
                        </h4>
                        <div class="answer-container">
                            @if (sizeof($question->answers) > 0)
                                <h3 class="text-center">
                                    {{ trans('messages.You can add new answer from here') }}
                                    <a href="#"
                                        onclick="createAnswer('{{ route('answer.create', ['question_id' => $question->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')"
                                        class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                            class="mdi mdi-plus"><span class="path1"></span><span
                                                class="path2"></span></span></a>
                                </h3>
                            @endif
                            <div class="row">
                                @forelse ($question->answers as $key2 => $answer)
                                    <div class="col-md">
                                        <div class="thumbnail-img"
                                            style="width: 200px;height: 150px;padding: 2px;{{ $answer->right_answer == true ? 'border:5px solid green;' : 'border:5px solid #fff;;' }}position:relative;">
                                            <img src="{{ url($answer->answer_image) }}" alt="">
                                            <input style="position: absolute;top: 0px;right: 0px;"
                                                id="answer_{{ $answer->id }}"
                                                onchange="updateAnswerArrangment({{ $answer->id }})" type="number"
                                                value="{{ $answer->arrangment }}" style="width: 40px" min="1"
                                                max="{{ sizeof($question->answers) }}">
                                            <a style="position: absolute;top: 0px;left: 0px;font-size: 1.2em;background-color: #FFF;padding: 0em 1em;"
                                                href="#"
                                                onclick="updateAnswer('{{ route('answer.edit', [$answer->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')">
                                                <i class="fa fa-edit"></i> </a>
                                            <a href="#"
                                                onclick="deleteExamAnswer({{ $exam->id }},{{ $answer->id }})"><span
                                                    class="fa fa-trash-o"></span></a>
                                        </div>
                                    </div>

                                @empty
                                    <h3 class="text-center">
                                        {{ trans('messages.There is no answers in this question you can add one from here') }}
                                        <a href="#"
                                            onclick="createAnswer('{{ route('answer.create', ['question_id' => $question->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')"
                                            class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="mdi mdi-plus"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    </h3>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        @empty
            <h3 class="text-center">
                {{ trans('messages.There is no questions in this category you can add one from here') }}
                <a href="#"
                    onclick="createQuestion('{{ route('question.create', ['exam_id' => $exam->id, 'category_id' => $category->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => true]) }}')"
                    class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="mdi mdi-plus"><span
                            class="path1"></span><span class="path2"></span></span></a>
            </h3>
        @endforelse
        <h3 class="text-center">
            {{ trans('messages.You can add new question from here') }}
            <a href="#"
                onclick="createQuestion('{{ route('question.create', ['exam_id' => $exam->id, 'category_id' => $category->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => true]) }}')"
                class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="mdi mdi-plus"><span
                        class="path1"></span><span class="path2"></span></span></a>
        </h3>
    @empty
        <h3 class="text-center">
            {{ trans('messages.There is no categories in this exam you can add one from here') }}
            <a href="#" onclick="createExamCategory()"
                class="waves-effect waves-light btn btn-primary-light btn-circle"><span class="mdi mdi-plus"><span
                        class="path1"></span><span class="path2"></span></span></a>
        </h3>
    @endforelse
</div>
