@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Opinions') }}</h3>
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
                                <form action="{{ route('opinion.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="search" id="search" class="form-control" name="search"
                                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                            placeholder="{{ trans('messages.Opinion') }}" aria-label="Search"
                                            aria-describedby="button-addon2">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="text-align: end">
                        @can('opinion_create')
                            <a href="{{ route('opinion.create') }}"
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
                                <th class="text-center">{{ trans('messages.Client') }}</th>
                                <th class="text-center">{{ trans('messages.Opinion') }}</th>
                                @can('opinion_update')
                                    <th class="text-center">{{ trans('messages.Enabled') }}</th>
                                @endcan
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($opinions as $key => $opinion)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($opinions->currentPage() - 1) * $opinions->perPage() }}
                                    </td>
                                    <td class="text-center">{{ $opinion->client->name }}</td>
                                    <td class="text-center">{{ $opinion->opinion }}</td>
                                    @can('opinion_update')
                                        <td class="text-center">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="Checkbox_{{ $key }}"
                                                        <?php if ($opinion->enable == 1) {
                                                            echo 'checked';
                                                        } ?> onchange="update_enabel(this)"
                                                        value="{{ $opinion->id }}" />
                                                    <label for="Checkbox_{{ $key }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                    @endcan
                                    <td class="text-center">{{ $opinion->created_at }}</td>
                                    <td class="text-center">
                                        @can('opinion_delete')
                                            <form action="{{ route('opinion.destroy', $opinion->id) }}" method="Post"
                                                id="destroy-form-{{ $opinion->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                        @can('opinion_update')
                                            <a href="{{ route('opinion.edit', $opinion->id) }}"
                                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Write"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                        @can('opinion_delete')
                                            <a data-title="{{ trans('messages.Are you sure?') }}"
                                                data-no="{{ trans('messages.Cancel') }}"
                                                data-yes="{{ trans('messages.Yes, delete it!') }}"
                                                data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                                href="#" data-href="{{ $opinion->id }}"
                                                class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Trash1"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $opinions->withQueryString()->links('pagination::bootstrap-4') !!}

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
                var enable = 1;
            } else {
                var enable = 0;
            }
            $.post(`{{ route('opinion.updateEnabel') }}`, {
                _token: '{{ csrf_token() }}',
                id: el.value,
                enable: enable
            }, function(data) {

            });
        }
    </script>
@endsection
