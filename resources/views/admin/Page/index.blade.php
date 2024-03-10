@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Static Pages') }}</h3>
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
                                <form action="{{ route('page.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="search" id="search" class="form-control" name="search"
                                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                            placeholder="{{ trans('messages.Title') }}" aria-label="Search"
                                            aria-describedby="button-addon2">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="text-align: end">
                        @can('page_store')
                            <a href="{{ route('page.create') }}"
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
                                <th class="text-center">{{ trans('messages.Title') }}</th>
                                @can('page_update_enable')
                                    <th class="text-center">{{ trans('messages.Enabled') }}</th>
                                @endcan
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $key => $page)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($pages->currentPage() - 1) * $pages->perPage() }}
                                    </td>
                                    <td class="text-center">{{ $page->{'title_' . App::getLocale()} }}</td>
                                    @can('page_update_enable')
                                        <td class="text-center">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="Checkbox_{{ $key }}"
                                                        <?php if ($page->enabel == 1) {
                                                            echo 'checked';
                                                        } ?> onchange="update_enabel(this)"
                                                        value="{{ $page->id }}" />
                                                    <label for="Checkbox_{{ $key }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                    @endcan
                                    <td class="text-center">{{ $page->created_at }}</td>
                                    <td class="text-center">
                                        @can('page_delete')
                                            <form action="{{ route('page.destroy', $page->id) }}" method="Post"
                                                id="destroy-form-{{ $page->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                        @can('page_edit')
                                            <a href="{{ route('page.edit', $page->id) }}"
                                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Write"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                        @can('page_delete')
                                            <a data-title="{{ trans('messages.Are you sure?') }}"
                                                data-no="{{ trans('messages.Cancel') }}"
                                                data-yes="{{ trans('messages.Yes, delete it!') }}"
                                                data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                                href="#" data-href="{{ $page->id }}"
                                                class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Trash1"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $pages->withQueryString()->links('pagination::bootstrap-4') !!}

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
                var enabel = 1;
            } else {
                var enabel = 0;
            }
            $.post(`{{ route('page.updateEnabel') }}`, {
                _token: '{{ csrf_token() }}',
                id: el.value,
                enabel: enabel
            }, function(data) {

            });
        }
    </script>
@endsection
