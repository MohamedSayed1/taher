@extends('admin.layouts.main')
@section('content')
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
            width: 60px;
            height: 60px;
            line-height: 60px;
            border-radius: 30px;
            background-color: brown;
            text-align: center;
            font-size: 1.2em;
            color: #FFF;
        }
    </style>
    <section class="content">
        <div class="box">
            <div class="box-body p-10">
                <div class="exam-data-section">
                    <h4 class="text-center">{{ trans('messages.Exam') }} ( {{ $exam->{'name_' . App::getLocale()} }} ) <i
                            style="cursor: pointer" data-toggle="modal" data-target="#view-exam-description"
                            class="fa fa-info-circle"></i>
                        @can('exam_edit')
                            <a href="{{ route('exam.edit', $exam->id) }}"> <i class="fa fa-edit"></i> </a>
                        @endcan
                    </h4>
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="">
                                            <th class="text-center">{{ trans('messages.Packages') }}</th>
                                            <th class="text-center">{{ trans('messages.Questions') }}</th>
                                            <th class="text-center">{{ trans('messages.Attempt No') }}</th>
                                            <th class="text-center">{{ trans('messages.Duration') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td class="text-center">
                                                @forelse ($exam->packages as $package)
                                                    <div class="badge badge-primary">
                                                        {{ $package->{'name_' . App::getLocale()} }}
                                                    </div>
                                                @empty
                                                @endforelse
                                            </td>
                                            <td class="text-center">{{ $exam->questions_num }}</td>
                                            <td class="text-center">{{ $exam->attempt_num }}</td>
                                            <td class="text-center">{{ $exam->duration_in_minutes }}
                                                {{ trans('messages.Minutes') }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <br>
                <br>
                <div class="exam-categories-section" id="exam-categories-section">
                    <div class="inner-exam-categories-section">
                        @if (sizeof($exam->examCategory) > 0)
                            <h3 class="text-center">
                                {{ trans('messages.You can add new exam category from here') }}
                                <a href="#" onclick="createExamCategory()"
                                    class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                        class="mdi mdi-plus"><span class="path1"></span><span
                                            class="path2"></span></span></a>
                            </h3>
                        @endif
                        @forelse ($exam->examCategory as $category)
                            <h4
                                style="background-color: black;padding: 1em;text-align: center;color: #fff;border-radius: 5px">
                                <input id="category_{{ $category->id }}"
                                    onchange="updateCategoryArrangmentExam({{ $category->id }})" type="number"
                                    value="{{ $category->arrangment }}" style="width: 50px" min="1"
                                    max="{{ sizeof($exam->examCategory) }}">
                                {{ $category->{'name_' . App::getLocale()} }}
                                @can('exam_category_edit')
                                    <a href="#"
                                        onclick="updateExamCategory('{{ route('examCategory.edit', [$category->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => 1]) }}')">
                                        <i class="fa fa-edit"></i> </a>
                                    <a href="#"
                                        onclick="deleteExamCategory({{ $exam->id }},{{ $category->id }})"><span
                                            class="fa fa-trash-o"></span></a>
                                @endcan
                            </h4>
                            <hr>
                            @if (sizeof($category->questions) > 0)
                                <h3 class="text-center">
                                    {{ trans('messages.You can add new question from here') }}
                                    <a href="#"
                                        onclick="createQuestion('{{ route('question.create', ['exam_id' => $exam->id, 'category_id' => $category->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => true]) }}')"
                                        class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                            class="mdi mdi-plus"><span class="path1"></span><span
                                                class="path2"></span></span></a>
                                </h3>
                            @endif
                            @forelse ($category->questions as $key => $question)
                                @if ($question->question_type == 'mcq' || $question->question_type == 'text_input')
                                    <div class="question-container">
                                        <div class="row">
                                            <div class="col-md">
                                                <h4>
                                                    <input id="question_{{ $question->id }}"
                                                        onchange="updateQuestionArrangmentExam({{ $question->id }})"
                                                        type="number" value="{{ $question->arrangment }}"
                                                        style="width: 50px" min="1"
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
                                                                onchange="updateAnswerArrangment({{ $answer->id }})"
                                                                type="number" value="{{ $answer->arrangment }}"
                                                                style="width: 40px" min="1"
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
                                                    <img id="question_image" src="{{ url($link) }}"
                                                        alt="your question_image" />
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
                                                        onchange="updateQuestionArrangmentExam({{ $question->id }})"
                                                        type="number" value="{{ $question->arrangment }}"
                                                        style="width: 50px" min="1"
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
                                                                onchange="updateAnswerArrangment({{ $answer->id }})"
                                                                type="number" value="{{ $answer->arrangment }}"
                                                                style="width: 40px" min="1"
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
                                                    <img id="question_image" src="{{ url($link) }}"
                                                        alt="your question_image" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($question->question_type == 'mcq_image')
                                    <div class="question-container">
                                        <div class="question-answer-images">
                                            <h4>
                                                <input id="question_{{ $question->id }}"
                                                    onchange="updateQuestionArrangmentExam({{ $question->id }})"
                                                    type="number" value="{{ $question->arrangment }}"
                                                    style="width: 50px" min="1"
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
                                                                <img src="{{ url($answer->answer_image) }}"
                                                                    alt="">
                                                                <input style="position: absolute;top: 0px;right: 0px;"
                                                                    id="answer_{{ $answer->id }}"
                                                                    onchange="updateAnswerArrangment({{ $answer->id }})"
                                                                    type="number" value="{{ $answer->arrangment }}"
                                                                    style="width: 40px" min="1"
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
                                        class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                            class="mdi mdi-plus"><span class="path1"></span><span
                                                class="path2"></span></span></a>
                                </h3>
                            @endforelse
                            <h3 class="text-center">
                                {{ trans('messages.You can add new question from here') }}
                                <a href="#"
                                    onclick="createQuestion('{{ route('question.create', ['exam_id' => $exam->id, 'category_id' => $category->id, 'show_exam_redirect' => $exam->id, 'ajax_create' => true]) }}')"
                                    class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                        class="mdi mdi-plus"><span class="path1"></span><span
                                            class="path2"></span></span></a>
                            </h3>
                        @empty
                            <h3 class="text-center">
                                {{ trans('messages.There is no categories in this exam you can add one from here') }}
                                <a href="#" onclick="createExamCategory()"
                                    class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                        class="mdi mdi-plus"><span class="path1"></span><span
                                            class="path2"></span></span></a>
                            </h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('modal')
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        id="view-exam-description" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    {!! $exam->{'description_' . App::getLocale()} !!}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        id="create-with-ajax" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         id="copy_question" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="copyQuestion">
                        <div class="p-15">
                            <p class="text-center">{{ trans('messages.copy Question') }}</p>
                            <div class="form-group">
                                <label for="question_ar">{{ trans('messages.Exams') }}
                                </label>
                                <div>
                                    <select name="exams_id" id="here_exams" onchange="getExamCategory(this.value)" class="form-control" aria-hidden="true" required>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="answer_explanation_ar">{{ trans('messages.Exam Categories') }}
                                </label>
                                <div>
                                    <select name="exams_category" id="here_examCategory"  class="form-control" aria-hidden="true" required>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="answer_explanation_ar">{{ trans('messages.Arrangment') }}
                                </label>
                                <div>
                                    <input class="form-control" id="get_arrangment" type="number" name="arrangment" value="" required>
                                </div>
                            </div>
                            <input type="hidden" id="here_qu_id" name="qu_id" value="">
                        </div>
                        <div class="box-footer">
                            <button type="button" onclick="SaveCopy()" class="btn btn-rounded btn-primary btn-outline">
                                <i class="ti-save-alt"></i> {{ trans('messages.Save') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function createExamCategory() {
            $.get(`{{ route('examCategory.create') }}`, {
                    show_exam_redirect: {{ $exam->id }},
                    ajax_create: 1,
                    exam_id: {{ $exam->id }}
                },
                function(data) {
                    $('#create-with-ajax .modal-body').html(data);
                    $('#create-with-ajax').modal();
                });
        }

        function updateExamCategory(url) {
            $.get(url, {},
                function(data) {
                    $('#create-with-ajax .modal-body').html(data);
                    $('#create-with-ajax').modal();
                });
        }

        function deleteExamCategory(exam_id, category_id) {
            $.post(`{{ route('examCategory.deleteExamCategory') }}`, {
                _token: '{{ csrf_token() }}',
                exam_id: exam_id,
                category_id: category_id
            }, function(data) {
                $("#exam-categories-section").html(data);
            });
        }

        function updateQuestion(url) {
            $.get(url, {},
                function(data) {
                    $('#create-with-ajax .modal-body').html(data);
                    $('#create-with-ajax').modal();
                });
        }

        function deleteExamQuestion(exam_id, question_id) {
            $.post(`{{ route('question.deleteExamQuestion') }}`, {
                _token: '{{ csrf_token() }}',
                exam_id: exam_id,
                question_id: question_id
            }, function(data) {
                $("#exam-categories-section").html(data);
            });
        }

        function createQuestion(url) {
            $.get(url, {},
                function(data) {
                    $('#create-with-ajax .modal-body').html(data);
                    $('#create-with-ajax').modal();
                });
        }

        function createAnswer(url) {
            $.get(url, {},
                function(data) {
                    $('#create-with-ajax .modal-body').html(data);
                    $('#create-with-ajax').modal();
                });
        }

        function updateAnswer(url) {
            $.get(url, {},
                function(data) {
                    $('#create-with-ajax .modal-body').html(data);
                    $('#create-with-ajax').modal();
                });
        }

        function deleteExamAnswer(exam_id, answer_id) {
            $.post(`{{ route('answer.deleteExamAnswer') }}`, {
                _token: '{{ csrf_token() }}',
                exam_id: exam_id,
                answer_id: answer_id
            }, function(data) {
                $("#exam-categories-section").html(data);
            });
        }

        function updateAnswerArrangment(id) {
            var newVal = $('#answer_' + id).val();
            $.post(`{{ route('answer.updateArrangmentExam') }}`, {
                _token: '{{ csrf_token() }}',
                id: id,
                newVal: newVal
            }, function(data) {

            });
        }

        function updateQuestionArrangmentExam(id) {
            var newVal = $('#question_' + id).val();
            $.post(`{{ route('question.updateQuestionArrangmentExam') }}`, {
                _token: '{{ csrf_token() }}',
                id: id,
                newVal: newVal
            }, function(data) {

            });
        }

        function updateCategoryArrangmentExam(id) {
            var newVal = $('#category_' + id).val();
            $.post(`{{ route('examCategory.updateCategoryArrangmentExam') }}`, {
                _token: '{{ csrf_token() }}',
                id: id,
                newVal: newVal
            }, function(data) {

            });
        }

        function copyQuestion(ex,id)
        {

            $.get(`{{route("exam.getExams",'')}}`+'/'+ex, {},
                function(data) {
                    if(data.status == 200)
                    {
                        data.data.map(function(value) {
                            $('#here_exams').append(
                                `<option value="`+value.id+`">`+value.name+`</option>`
                            );
                        });
                       let getId = $('#here_exams').val();
                       getExamCategory(getId);
                    }
                });
            $('#here_qu_id').val(id);
            $('.select2').select2();
            $('#copy_question').modal();
        }
        function getExamCategory(id)
        {
            $.get(`{{route("examCategory.getByExam",'')}}`+'/'+id, {},
                function(data) {
                    if(data.status == 200)
                    {
                        data.data.map(function(value) {
                            $('#here_examCategory').empty();
                            $('#here_examCategory').append(
                                `<option value="`+value.id+`">`+value.name+`</option>`
                            );
                            $('#get_arrangment').val(Number(value.questions_count) +1);
                        });
                    }
                });
        }
        function SaveCopy()
        {
          let get_arrangment = $('#get_arrangment').val();
          let exam = $('#here_exams').val();
          let cate = $('#here_examCategory').val();
          let id = $('#here_qu_id').val();
            $.post(`{{ route('question.copy') }}`, {
                _token: '{{ csrf_token() }}',
                arrangment: get_arrangment,
                exams_id: exam,
                exams_category: cate,
                qu_id:id
            }, function(data) {
                if(data.status == 200)
                {
                    $.toast({
                        heading: `{{ trans('messages.Notification') }}`,
                        text: data.massage,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3000,
                        stack: 6,
                        type: "success"
                    });
                    location.reload();
                }else {
                    $.toast({
                        heading: `{{ trans('messages.Notification') }}`,
                        text:  data.massage,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'info',
                        hideAfter: 3000,
                        stack: 6,
                        type: "warning"
                    });
                }
            });
            $('#copy_question').modal('toggle');

        }
    </script>
@endsection
