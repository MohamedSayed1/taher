@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Exams') }}</h3>
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
                                <form action="{{ route('exam.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="search" id="search" class="form-control" name="search"
                                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                            placeholder="{{ trans('messages.Name') }}" aria-label="Search"
                                            aria-describedby="button-addon2">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="text-align: end">
                        @can('exam_store')
                            <a href="{{ route('exam.create') }}"
                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                    class="mdi mdi-plus"><span class="path1"></span><span class="path2"></span></span></a>
                        @endcan

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
                                <th class="text-center">{{ trans('messages.Name') }}</th>
                                <th class="text-center">{{ trans('messages.Packages') }}</th>
                                <th class="text-center">{{ trans('messages.Questions') }}</th>
                                <th class="text-center">{{ trans('messages.Attempt No') }}</th>
                                <th class="text-center">{{ trans('messages.Duration') }}</th>
                                <th class="text-center">{{ trans('messages.Arrangment') }}</th>
                                <th class="text-center">{{ trans('messages.Enabled') }}</th>
                                @can('exam_update_auto_move')
                                    <th class="text-center">{{ trans('messages.Category auto move') }}</th>
                                @endcan
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $key => $exam)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($exams->currentPage() - 1) * $exams->perPage() }}
                                    </td>
                                    <td class="text-center">{{ $exam->{'name_' . App::getLocale()} }}</td>
                                    <td class="text-center">
                                        @forelse ($exam->packages as $package)
                                            <div class="badge badge-primary">{{ $package->{'name_' . App::getLocale()} }}
                                            </div>
                                        @empty
                                        @endforelse
                                    </td>
                                    <td class="text-center">{{ $exam->questions_num }}</td>
                                    <td class="text-center">{{ $exam->attempt_num }}</td>
                                    <td class="text-center">{{ $exam->duration_in_minutes }}
                                        {{ trans('messages.Minutes') }}</td>

                                    <td class="text-center">
                                        <div class="form-group">
                                            <input type="number" id="{{ $exam->id }}" class="form-control"
                                                style="width: 50%;margin: auto;" onchange="updateArrangment(this)"
                                                value="{{ $exam->arrangment }}" />
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <input type="checkbox" id="Checkbox_{{ $key }}"
                                                    <?php if ($exam->active == 1) {
                                                        echo 'checked';
                                                    } ?> onchange="update_enabel(this)"
                                                    value="{{ $exam->id }}" />
                                                <label for="Checkbox_{{ $key }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    @can('exam_update_auto_move')
                                        <td class="text-center">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="Checkbox_{{ $key }}"
                                                        <?php if ($exam->exam_category_auto_move == 1) {
                                                            echo 'checked';
                                                        } ?> onchange="update_auto_move(this)"
                                                        value="{{ $exam->id }}" />
                                                    <label for="Checkbox_{{ $key }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                    @endcan
                                    <td class="text-center">{{ $exam->created_at }}
                                    <td class="text-center">
                                        @can('exam_delete')
                                            <form action="{{ route('exam.destroy', $exam->id) }}" method="Post"
                                                id="destroy-form-{{ $exam->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                        @can('exam_view')
                                            <a href="{{ route('exam.show', $exam->id) }}"
                                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="fa fa-eye"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                        @can('exam_edit')
                                            <a href="{{ route('exam.edit', $exam->id) }}"
                                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Write"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                        @can('exam_delete')
                                            <a data-title="{{ trans('messages.Are you sure?') }}"
                                                data-no="{{ trans('messages.Cancel') }}"
                                                data-yes="{{ trans('messages.Yes, delete it!') }}"
                                                data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                                href="#" data-href="{{ $exam->id }}"
                                                class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Trash1"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $exams->withQueryString()->links('pagination::bootstrap-4') !!}

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
        function update_enabel(el) {
            if (el.checked) {
                var active = 1;
            } else {
                var active = 0;
            }
            $.post(`{{ route('exam.updateEnabel') }}`, {
                _token: '{{ csrf_token() }}',
                id: el.value,
                active: active
            }, function(data) {

            });
        }

        function update_auto_move(el) {
            if (el.checked) {
                var exam_category_auto_move = 1;
            } else {
                var exam_category_auto_move = 0;
            }
            $.post(`{{ route('exam.updateAutoMove') }}`, {
                _token: '{{ csrf_token() }}',
                id: el.value,
                exam_category_auto_move: exam_category_auto_move
            }, function(data) {

            });
        }

        function updateArrangment(el) {

            $.post(`{{ route('exam.updateArrangment') }}`, {
                _token: '{{ csrf_token() }}',
                arrangment: el.value,
                id: el.id
            }, function(data) {
                location.reload();
            });
        }
    </script>
@endsection
