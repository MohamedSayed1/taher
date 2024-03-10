@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Questions') }}</h3>
            </div>

        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <form action="{{ route('question.index') }}" method="GET">
                    <div class="row">
                        <div class="col-2">
                            <div class="app-menu">
                                <div class="search-bx mx-5">

                                    <div class="input-group">
                                        <input type="search" id="search" class="form-control" name="search"
                                            style="height: 2.8em"
                                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                            placeholder="{{ trans('messages.Question') }}" aria-label="Search"
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
                        <div class="col-2">
                            @php
                                $question_types = ['mcq' => 'MCQ', 'mcq_image' => 'MCQ image', 'text_input' => 'Text', 'drag_drop' => 'Drag & Drop'];
                            @endphp
                            <select name="question_type" id="question_type-filter" class="select2 form-control">
                                <option value="0">{{ trans('messages.All') }}</option>
                                @foreach ($question_types as $key => $type)
                                    <option {{ $question_type == $key ? 'selected' : '' }} value="{{ $key }}">
                                        {{ trans('messages.' . $type) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col" style="position: relative">
                            <i class="fa fa-filter"
                                style="position: absolute;{{ App::getLocale() == 'ar' ? 'right' : 'left' }}:1em;font-size: 1.5em;line-height: 1.5em;color: #FFF"></i>
                            <input style="height: 2em;line-height: .4em;padding: 1.2em 3em" type="submit"
                                value="{{ trans('messages.Filter') }}" class="btn btn-primary">
                        </div>
                        @if ($exam_id && $category_id)
                            <div class="col" style="text-align: end">
                                @can('question_create')
                                    <a href="{{ route('question.create', ['exam_id' => $exam_id, 'category_id' => $category_id]) }}"
                                        class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                            class="mdi mdi-plus"><span class="path1"></span><span
                                                class="path2"></span></span></a>
                                @endcan

                            </div>
                        @else
                            <a href="#"
                                onclick="alert('{{ trans('messages.You can only add question on exam and category filter') }}')"
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
                                <th class="text-center">{{ trans('messages.Exam') }}</th>
                                <th class="text-center">{{ trans('messages.Category') }}</th>
                                <th class="text-center">{{ trans('messages.Question') }}</th>
                                <th class="text-center">{{ trans('messages.Question type') }}</th>
                                @can('question_update')
                                    <th class="text-center">{{ trans('messages.Arrangment') }}</th>
                                @endcan
                                <th class="text-center">{{ trans('messages.Image') }}</th>
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $key => $question)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($questions->currentPage() - 1) * $questions->perPage() }}
                                    </td>
                                    <td class="text-center">{{ $question->exam->{'name_' . App::getLocale()} }}</td>
                                    <td class="text-center">{{ $question->examCategory->{'name_' . App::getLocale()} }}
                                    </td>
                                    <td class="text-center">{{ $question->question_type }}</td>
                                    <td class="text-center">{{ $question->{'question_' . App::getLocale()} }}</td>
                                    @can('question_update')
                                        <td class="text-center">
                                            <div class="form-group">
                                                <input type="number" id="{{ $question->id }}" class="form-control"
                                                    style="width: 50%;margin: auto;" onchange="updateArrangment(this)"
                                                    value="{{ $question->arrangment }}" />
                                            </div>
                                        </td>
                                    @endcan
                                    <td class="text-center">
                                        @php
                                            if ($question->question_image) {
                                                $link = $question->question_image;
                                            } else {
                                                $link = '/images/noimg.png';
                                            }
                                        @endphp
                                        <a class="image-popup-vertical-fit" href="{{ url($link) }}">
                                            <img id="question_image" src="{{ url($link) }}" alt="your question_image"
                                                style="width: 50px; height: 49px;" />
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $question->created_at }}</td>
                                    <td class="text-center">
                                        @can('question_delete')
                                            <form action="{{ route('question.destroy', $question->id) }}" method="Post"
                                                id="destroy-form-{{ $question->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                        @can('answer_list')
                                            <a title="{{ trans('messages.Answers') }}"
                                                href="{{ route('answer.index', ['question_id' => $question->id]) }}"
                                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="fa fa-reply-all"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan

                                        @can('question_update')
                                            <a href="{{ route('question.edit', $question->id) }}"
                                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Write"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                        @can('question_delete')
                                            <a data-title="{{ trans('messages.Are you sure?') }}"
                                                data-no="{{ trans('messages.Cancel') }}"
                                                data-yes="{{ trans('messages.Yes, delete it!') }}"
                                                data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                                href="#" data-href="{{ $question->id }}"
                                                class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Trash1"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $questions->withQueryString()->links('pagination::bootstrap-4') !!}

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
        function updateArrangment(el) {
            $.post(`{{ route('question.updateArrangment') }}`, {
                _token: '{{ csrf_token() }}',
                arrangment: el.value,
                id: el.id
            }, function(data) {

            });
        }

        $(document).ready(function() {
            var exam_id = $('#exam-filter').val();
            $.post(`{{ route('examCategory.getCategories') }}`, {
                _token: '{{ csrf_token() }}',
                exam_id: exam_id,
                category_id: {{ $category_id ? $category_id : 0 }},
            }, function(data) {
                $('#categories-container').html(data)
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
