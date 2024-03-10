@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Categories') }}</h3>
            </div>

        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <form action="{{ route('examCategory.index') }}" method="GET">

                    <div class="row">
                        <div class="col-3">
                            <div class="app-menu">
                                <div class="search-bx mx-5">

                                    <div class="input-group">
                                        <input type="search" id="search" class="form-control" name="search"
                                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                            placeholder="{{ trans('messages.Name') }}" aria-label="Search"
                                            aria-describedby="button-addon2">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <select name="exam_id" id="exam-filter" class="select2 form-control">
                                <option value="0">{{ trans('messages.All') }}</option>
                                @foreach ($exams as $exam)
                                    <option {{ $exam_id == $exam->id ? 'selected' : '' }} value="{{ $exam->id }}">
                                        {{ $exam->{'name_' . App::getLocale()} }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3" style="position: relative">
                            <i class="fa fa-filter"
                                style="position: absolute;{{ App::getLocale() == 'ar' ? 'right' : 'left' }}:1em;font-size: 1.5em;line-height: 1.5em;color: #FFF"></i>
                            <input style="height: 2em;line-height: 1em;padding: 0em 2em" type="submit"
                                value="{{ trans('messages.Filter') }}" class="btn btn-primary">
                        </div>
                        <div class="col" style="text-align: end">
                            @can('exam_category_store')
                                <a href="{{ route('examCategory.create') }}"
                                    class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                        class="mdi mdi-plus"><span class="path1"></span><span class="path2"></span></span></a>
                            @endcan
                        </div>
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
                                <th class="text-center">{{ trans('messages.Name') }}</th>
                                <th class="text-center">{{ trans('messages.Exam') }}</th>
                                <th class="text-center">{{ trans('messages.Questions') }}</th>
                                @can('exam_category_update_Arrangment')
                                    <th class="text-center">{{ trans('messages.Arrangment') }}</th>
                                @endcan
                                <th class="text-center">{{ trans('messages.Wrong to fail') }}</th>
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($categories->currentPage() - 1) * $categories->perPage() }}
                                    </td>
                                    <td class="text-center">{{ $category->{'name_' . App::getLocale()} }}</td>
                                    <td class="text-center">{{ $category->exam->{'name_' . App::getLocale()} }}</td>
                                    <td class="text-center">{{ $category->questions_num }}
                                        {{ trans('messages.Question') }}</td>
                                    @can('exam_category_update_Arrangment')
                                        <td class="text-center">
                                            <div class="form-group">
                                                <input type="number" id="{{ $category->id }}" class="form-control"
                                                    style="width: 50%;margin: auto;" onchange="updateArrangment(this)"
                                                    value="{{ $category->arrangment }}" />
                                            </div>
                                        </td>
                                    @endcan
                                    <td class="text-center">{{ $category->wrong_question_to_fail }}
                                        {{ trans('messages.Question') }}</td>
                                    <td class="text-center">{{ $category->created_at }}
                                    <td class="text-center">
                                        @can('exam_category_delete')
                                            <form action="{{ route('examCategory.destroy', $category->id) }}" method="Post"
                                                id="destroy-form-{{ $category->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                        @can('question_list')
                                            <a title="{{ trans('messages.Category questions') }}"
                                                href="{{ route('question.index', ['exam_id' => $category->exam->id, 'category_id' => $category->id]) }}"
                                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="fa fa-question-circle-o"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                        @can('exam_category_edit')
                                            <a href="{{ route('examCategory.edit', $category->id) }}"
                                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Write"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                        @can('exam_category_delete')
                                            <a data-title="{{ trans('messages.Are you sure?') }}"
                                                data-no="{{ trans('messages.Cancel') }}"
                                                data-yes="{{ trans('messages.Yes, delete it!') }}"
                                                data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                                href="#" data-href="{{ $category->id }}"
                                                class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Trash1"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $categories->withQueryString()->links('pagination::bootstrap-4') !!}

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
        $(document).ready(function() {
            $('.select2').select2();
        })

        function updateArrangment(el) {

            $.post(`{{ route('examCategory.updateArrangment') }}`, {
                _token: '{{ csrf_token() }}',
                arrangment: el.value,
                id: el.id
            }, function(data) {

            });
        }
    </script>
@endsection
