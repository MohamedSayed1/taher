@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Answers') }}</h3>
                <div class="d-inline-block align-items-center">
                    @if ($question)
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page"><a
                                        href="{{ route('exam.index', ['search' => $question->exam->{'name_' . App::getLocale()}]) }}">{{ $question->exam->{'name_' . App::getLocale()} }}</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page"><a
                                        href="{{ route('examCategory.index', ['search' => $question->examCategory->{'name_' . App::getLocale()}]) }}">{{ $question->examCategory->{'name_' . App::getLocale()} }}</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page"><a
                                        href="{{ route('question.index', ['search' => $question->{'question_' . App::getLocale()}]) }}">{{ $question->{'question_' . App::getLocale()} }}</a>
                                </li>
                            </ol>
                        </nav>
                    @elseif($category)
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page"><a
                                        href="{{ route('exam.index', ['search' => $category->exam->{'name_' . App::getLocale()}]) }}">{{ $category->exam->{'name_' . App::getLocale()} }}</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page"><a
                                        href="{{ route('examCategory.index', ['search' => $category->{'name_' . App::getLocale()}]) }}">{{ $category->{'name_' . App::getLocale()} }}</a>
                                </li>
                            </ol>
                        </nav>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <form action="{{ route('answer.index', ['question_id' => $question_id]) }}" method="GET">
                    <div class="row">
                        <div class="col-2">
                            <div class="app-menu">
                                <div class="search-bx mx-5">

                                    <div class="input-group">
                                        <input type="search" id="search" class="form-control" name="search"
                                            style="height: 2.8em"
                                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                            placeholder="{{ trans('messages.Answer') }}" aria-label="Search"
                                            aria-describedby="button-addon2">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <select name="exam_id" id="exam-filter" class="select2 form-control">
                                <option value="0">{{ trans('messages.All') }}</option>
                                @foreach ($exams as $exam)
                                    <option {{ $exam_id == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">
                                        {{ $exam->{'name_' . App::getLocale()} }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2" id="categories-container">

                        </div>
                        <div class="col-2" id="questions-container">

                        </div>
                        <div class="col" style="position: relative">
                            <i class="fa fa-filter"
                                style="position: absolute;{{ App::getLocale() == 'ar' ? 'right' : 'left' }}:1em;font-size: 1.5em;line-height: 1.5em;color: #FFF"></i>
                            <input style="height: 2em;line-height: .4em;padding: 1.2em 3em" type="submit"
                                value="{{ trans('messages.Filter') }}" class="btn btn-primary">
                        </div>
                        @if ($question_id)
                            <div class="col" style="text-align: end;">
                                @can('answer_create')
                                    <a href="{{ route('answer.create', ['question_id' => $question_id]) }}"
                                        class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                            class="mdi mdi-plus"><span class="path1"></span><span
                                                class="path2"></span></span></a>
                                @endcan

                            </div>
                        @else
                            <a href="#"
                                onclick="alert('{{ trans('messages.You can only add answer on question filter') }}')"
                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                    class="mdi mdi-plus"><span class="path1"></span><span class="path2"></span></span></a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="">
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">{{ trans('messages.Question') }}</th>
                                <th class="text-center">{{ trans('messages.Answer') }}</th>
                                @can('answer_update')
                                    <th class="text-center">{{ trans('messages.Right answer') }}</th>
                                    <th class="text-center">{{ trans('messages.Arrangment') }}</th>
                                @endcan
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($answers as $key => $answer)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($answers->currentPage() - 1) * $answers->perPage() }}
                                    </td>
                                    <td class="text-center">{{ $answer->question->{'question_' . App::getLocale()} }}</td>
                                    <td class="text-center">
                                        @if ($answer->question->question_type == 'mcq' ||
                                            $answer->question->question_type == 'text_input' ||
                                            $answer->question->question_type == 'drag_drop')
                                            {{ $answer->{'answer_' . App::getLocale()} }}
                                        @elseif($answer->question->question_type == 'mcq_image')
                                            @php
                                                if ($answer->answer_image) {
                                                    $link = $answer->answer_image;
                                                } else {
                                                    $link = '/images/noimg.png';
                                                }
                                            @endphp
                                            <a class="image-popup-vertical-fit" href="{{ url($link) }}">
                                                <img id="answer_image" src="{{ url($link) }}" alt="your answer_image"
                                                    style="width: 50px; height: 49px;" />
                                            </a>
                                        @endif
                                    </td>
                                    @can('answer_update')
                                        <td class="text-center">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="Checkbox_{{ $key }}"
                                                        <?php if ($answer->right_answer == 1) {
                                                            echo 'checked';
                                                        } ?> onchange="updateRightAnswer(this)"
                                                        value="{{ $answer->id }}" />
                                                    <label for="Checkbox_{{ $key }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                <input type="number" id="{{ $answer->id }}" class="form-control"
                                                    style="width: 50%;margin: auto;" onchange="updateArrangment(this)"
                                                    value="{{ $answer->arrangment }}" />
                                            </div>
                                        </td>
                                    @endcan
                                    <td class="text-center">{{ $answer->created_at }}</td>
                                    <td class="text-center">
                                        @can('answer_delete')
                                            <form action="{{ route('answer.destroy', $answer->id) }}" method="Post"
                                                id="destroy-form-{{ $answer->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                        @can('answer_update')
                                            <a href="{{ route('answer.edit', $answer->id) }}"
                                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Write"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                        @can('answer_delete')
                                            <a data-title="{{ trans('messages.Are you sure?') }}"
                                                data-no="{{ trans('messages.Cancel') }}"
                                                data-yes="{{ trans('messages.Yes, delete it!') }}"
                                                data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                                href="#" data-href="{{ $answer->id }}"
                                                class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Trash1"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $answers->withQueryString()->links('pagination::bootstrap-4') !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@section('modal')
    <div class="modal modal-left fade" id="modal-left" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="view-company">

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function updateRightAnswer(el) {
            if (el.checked) {
                var right_answer = 1;
            } else {
                var right_answer = 0;
            }
            $.post(`{{ route('answer.updateRightAnswer') }}`, {
                _token: '{{ csrf_token() }}',
                id: el.value,
                right_answer: right_answer
            }, function(data) {
                location.reload();
            });
        }

        function updateArrangment(el) {
            $.post(`{{ route('answer.updateArrangment') }}`, {
                _token: '{{ csrf_token() }}',
                arrangment: el.value,
                id: el.id
            }, function(data) {

            });
        }

        $(document).ready(function() {
            var exam_id = $('#exam-filter').val();
            var category_id = 0;
            $.post(`{{ route('examCategory.getCategories') }}`, {
                _token: '{{ csrf_token() }}',
                exam_id: exam_id,
                category_id: {{ $category_id ? $category_id : 0 }},
            }, function(data) {
                $('#categories-container').html(data)
                category_id = $('#category-filter').val();
                $.post(`{{ route('question.getQuestions') }}`, {
                    _token: '{{ csrf_token() }}',
                    category_id: category_id,
                    question_id: {{ $question_id ? $question_id : 0 }},
                }, function(data) {
                    $('#questions-container').html(data)
                });


            });


            $('#exam-filter').change(function() {
                var exam_id = $(this).val();
                $.post(`{{ route('examCategory.getCategories') }}`, {
                    _token: '{{ csrf_token() }}',
                    exam_id: exam_id,
                    category_id: {{ $category_id ? $category_id : 0 }},
                }, function(data) {
                    $('#categories-container').html(data)
                });
            })
        })
    </script>
@endsection
