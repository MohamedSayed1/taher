@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Problems') }}</h3>
            </div>

        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-4">
                        <div class="app-menu">
                            <div class="search-bx mx-5">
                                <form action="{{ route('examOpinion.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="search" id="search" class="form-control" name="search"
                                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                            placeholder="{{ trans('messages.Problem') }}" aria-label="Search"
                                            aria-describedby="button-addon2">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="text-align: end">

                    </div>
                </div>

            </div>
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="">
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">{{ trans('messages.Client') }}</th>
                                <th class="text-center">{{ trans('messages.Exam') }}</th>
                                <th class="text-center">{{ trans('messages.Question') }}</th>
                                <th class="text-center">{{ trans('messages.Type') }}</th>
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($problems as $key => $problem)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($problems->currentPage() - 1) * $problems->perPage() }}
                                    </td>
                                    <td class="text-center">
                                        {{ $problem->user ? $problem->user->name : trans('messages.Guest') }}</td>
                                    <td class="text-center">{{ $problem->exam->{'name_' . App::getLocale()} }}</td>
                                    <td class="text-center">{{ $problem->question->{'question_' . App::getLocale()} }}</td>
                                    <td class="text-center">{{ trans('messages.' . $problem->problem_type) }}</td>
                                    <td class="text-center">{{ $problem->created_at }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('examOpinion.destroy', $problem->id) }}" method="Post"
                                            id="destroy-form-{{ $category->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="#" onclick="view_problem({{ $problem->id }})"
                                            class="waves-effect waves-light btn btn-primary-light btn-circle mx-5"><span
                                                class="mdi mdi-magnify"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                        <a data-title="{{ trans('messages.Are you sure?') }}"
                                            data-no="{{ trans('messages.Cancel') }}"
                                            data-yes="{{ trans('messages.Yes, delete it!') }}"
                                            data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                            href="#" data-href="{{ $problem->id }}"
                                            class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="icon-Trash1"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $problems->withQueryString()->links('pagination::bootstrap-4') !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@section('modal')
    <div class="modal modal-left fade" id="modal-left" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="view-problem">

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function view_problem(id) {
            $('#modal-left').modal();
            var url = `{{ route('examOpinion.show', 'id') }}`;
            url = url.replace('id', id);
            $.get(url, {}, function(data) {
                $('#view-problem').html(data);
            });
        }
    </script>
@endsection
