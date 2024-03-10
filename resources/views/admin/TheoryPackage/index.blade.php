@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Theory Package') }}</h3>
            </div>

        </div>
    </div>
    <style>
        .offer-active {
            background-color: #FFF !important;
            border-color: #1221db !important;
            color: #0ee31e !important;
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-4">
                        <div class="app-menu">
                            <div class="search-bx mx-5">
                                <form action="{{ route('theoryPackage.index') }}" method="GET">
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
                        <a href="{{ route('theoryPackage.create') }}"
                            class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                class="mdi mdi-plus"><span class="path1"></span><span class="path2"></span></span></a>

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
                                <th class="text-center">{{ trans('messages.photo_phone') }}</th>
                                <th class="text-center">{{ trans('messages.photo_desktop') }}</th>
                                <th class="text-center">{{ trans('messages.Price') }}</th>
                                <th class="text-center">{{ trans('messages.Expiration duration') }}</th>
                                <th class="text-center">{{ trans('messages.Show in home') }}</th>
                                <th class="text-center">{{ trans('messages.Enabled') }}</th>
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $key => $package)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($packages->currentPage() - 1) * $packages->perPage() }}
                                    </td>
                                    <td class="text-center">{{ $package->{'name_' . App::getLocale()} }}</td>
                                    <td>
                                        @if(!empty($package->photo_phone) && file_exists(public_path().'/'.$package->photo_phone))
                                            <div class="col-sm-6">
                                                <a class="image-popup-vertical-fit"
                                                   href="{{url('/'.$package->photo_phone)}}">
                                                    <img
                                                        src="{{url('/'.$package->photo_phone)}}"
                                                        class="img-fluid" alt=""/>
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($package->image) && file_exists(public_path().'/'.$package->image))
                                            <div class="col-sm-6">
                                                <a class="image-popup-vertical-fit"
                                                   href="{{url('/'.$package->image)}}">
                                                    <img
                                                        src="{{url('/'.$package->image)}}"
                                                        class="img-fluid" alt=""/>
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $package->price }}</td>
                                    <td class="text-center">
                                        {{ $package->expiration_duration_in_dayes }}
                                        {{ trans('messages.Day') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <input type="checkbox" id="Checkbox_{{ $key }}"
                                                    <?php if ($package->show_in_home == 1) {
                                                        echo 'checked';
                                                    } ?> onchange="update_home(this)"
                                                    value="{{ $package->id }}" />
                                                <label for="Checkbox_{{ $key }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <input type="checkbox" id="Checkboxen_{{ $key }}"
                                                    <?php if ($package->enable == 1) {
                                                        echo 'checked';
                                                    } ?> onchange="update_enabel(this)"
                                                    value="{{ $package->id }}" />
                                                <label for="Checkboxen_{{ $key }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $package->created_at }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('theoryPackage.destroy', $package->id) }}" method="Post"
                                            id="destroy-form-{{ $package->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{ route('theoryPackage.show', $package->id) }}"
                                            class="waves-effect waves-light btn btn-primary-light btn-circle mx-5"><span
                                                class="mdi mdi-magnify"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                        <a href="{{ route('theoryPackage.edit', $package->id) }}"
                                            class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="icon-Write"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                        <a data-title="{{ trans('messages.Are you sure?') }}"
                                            data-no="{{ trans('messages.Cancel') }}"
                                            data-yes="{{ trans('messages.Yes, delete it!') }}"
                                            data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                            href="#" data-href="{{ $package->id }}"
                                            class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="icon-Trash1"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $packages->withQueryString()->links('pagination::bootstrap-4') !!}

                </div>
            </div>
        </div>
    </section>
@endsection
@section('modal')
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        id="make-offer" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
            $.post(`{{ route('theoryPackage.updateEnabel') }}`, {
                _token: '{{ csrf_token() }}',
                id: el.value,
                enable: enable
            }, function(data) {

            });
        }

        function update_home(el) {
            if (el.checked) {
                var show_in_home = 1;
            } else {
                var show_in_home = 0;
            }
            $.post(`{{ route('theoryPackage.updateShowHome') }}`, {
                _token: '{{ csrf_token() }}',
                id: el.value,
                show_in_home: show_in_home
            }, function(data) {

            });
        }
    </script>
@endsection
