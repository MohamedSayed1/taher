@extends('admin.layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Roles') }}</h3>
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
                                <form action="{{ route('role.index') }}" method="GET">
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
                        @can('role_create')
                            <a href="{{ route('role.create') }}"
                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                    class="mdi mdi-plus"><span class="path1"></span><span class="path2"></span></span></a>
                        @endcan

                    </div>
                </div>

            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="">
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center"> {{ trans('messages.Name') }}</th>
                                <th class="text-center"> {{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                @if ($role->id != 1)
                                    <tr class="bg-table-gray changnametr">
                                        <td class="text-center">
                                            {{ $key + 1 + ($roles->currentPage() - 1) * $roles->perPage() }}
                                        </td>
                                        <td class="text-center">{{ $role->name }}</td>

                                        <td class="text-center">
                                            @can('role_delete')
                                                <form action="{{ route('role.destroy', $role->id) }}" method="Post"
                                                    id="destroy-form-{{ $role->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endcan
                                            @can('role_view')
                                                <a href="#" onclick="view_role({{ $role->id }})"
                                                    class="waves-effect waves-light btn btn-primary-light btn-circle mx-5"><span
                                                        class="mdi mdi-magnify"><span class="path1"></span><span
                                                            class="path2"></span></span></a>
                                            @endcan
                                            @can('role_update')
                                                <a href="{{ route('role.edit', $role->id) }}"
                                                    class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                        class="icon-Write"><span class="path1"></span><span
                                                            class="path2"></span></span></a>
                                            @endcan
                                            @can('role_delete')
                                                <a data-title="{{ trans('messages.Are you sure?') }}"
                                                    data-no="{{ trans('messages.Cancel') }}"
                                                    data-yes="{{ trans('messages.Yes, delete it!') }}"
                                                    data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                                    href="#" data-href="{{ $role->id }}"
                                                    class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                        class="icon-Trash1"><span class="path1"></span><span
                                                            class="path2"></span></span></a>
                                            @endcan
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                        {{ $roles->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('modal')
    <div class="modal modal-left fade" id="modal-left" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="view-role">

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function view_role(id) {
            $('#modal-left').modal();
            var url = `{{ route('role.show', 'role_id') }}`;
            url = url.replace('role_id', id);
            $.get(url, {}, function(data) {
                $('#view-role').html(data);
            });
        }
    </script>
@endsection
