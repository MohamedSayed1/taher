@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Faqs') }}</h3>
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
                                <form action="{{ route('faq.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="search" id="search" class="form-control" name="search"
                                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                            placeholder="{{ trans('messages.Question') }}" aria-label="Search"
                                            aria-describedby="button-addon2">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="text-align: end">
                        @can('faq_store')
                            <a href="{{ route('faq.create') }}"
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
                                <th class="text-center">{{ trans('messages.Question') }}</th>
                                @can('faq_update_enable')
                                    <th class="text-center">{{ trans('messages.Enabled') }}</th>
                                @endcan
                                @can('faq_update_Arrangment')
                                    <th class="text-center">{{ trans('messages.Arrangment') }}</th>
                                @endcan
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $key => $faq)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($faqs->currentPage() - 1) * $faqs->perPage() }}
                                    </td>
                                    <td class="text-center">{{ $faq->{'question_' . App::getLocale()} }}</td>
                                    @can('faq_update_enable')
                                        <td class="text-center">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="Checkbox_{{ $key }}"
                                                        <?php if ($faq->enable == 1) {
                                                            echo 'checked';
                                                        } ?> onchange="update_enabel(this)"
                                                        value="{{ $faq->id }}" />
                                                    <label for="Checkbox_{{ $key }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                    @endcan
                                    @can('faq_update_Arrangment')
                                        <td class="text-center">
                                            <div class="form-group">
                                                <input type="number" id="{{ $faq->id }}" class="form-control"
                                                    style="width: 50%;margin: auto;" onchange="updateArrangment(this)"
                                                    value="{{ $faq->arrangment }}" />
                                            </div>
                                        </td>
                                    @endcan
                                    <td class="text-center">{{ $faq->created_at }}</td>
                                    <td class="text-center">
                                        @can('faq_delete')
                                            <form action="{{ route('faq.destroy', $faq->id) }}" method="Post"
                                                id="destroy-form-{{ $faq->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                        @can('faq_edit')
                                            <a href="{{ route('faq.edit', $faq->id) }}"
                                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Write"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                        @can('faq_delete')
                                            <a data-title="{{ trans('messages.Are you sure?') }}"
                                                data-no="{{ trans('messages.Cancel') }}"
                                                data-yes="{{ trans('messages.Yes, delete it!') }}"
                                                data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                                href="#" data-href="{{ $faq->id }}"
                                                class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Trash1"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $faqs->withQueryString()->links('pagination::bootstrap-4') !!}

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
            $.post(`{{ route('faq.updateEnabel') }}`, {
                _token: '{{ csrf_token() }}',
                id: el.value,
                enable: enable
            }, function(data) {

            });
        }

        function updateArrangment(el) {

            $.post(`{{ route('faq.updateArrangment') }}`, {
                _token: '{{ csrf_token() }}',
                arrangment: el.value,
                id: el.id
            }, function(data) {

            });
        }


    </script>
@endsection
