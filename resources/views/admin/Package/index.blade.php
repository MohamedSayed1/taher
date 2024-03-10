@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Packages') }}</h3>
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
                                <form action="{{ route('package.index') }}" method="GET">
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
                        @can('package_store')
                            <a href="{{ route('package.create') }}"
                               class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                    class="mdi mdi-plus"><span class="path1"></span><span
                                        class="path2"></span></span></a>
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
                            <th class="text-center">{{ trans('messages.photo_phone') }}</th>
                            <th class="text-center">{{ trans('messages.photo_desktop') }}</th>
                            <th class="text-center">{{ trans('messages.Price') }}</th>
                            <th class="text-center">{{ trans('messages.Exams') }}</th>
                            <th class="text-center">{{ trans('messages.Expiration duration') }}</th>
                            <th class="text-center">{{ trans('messages.Created') }}</th>
                            <th class="text-center">{{ trans('messages.Enabled') }}</th>
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
                                        <div class="col-sm-4">
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
                                    @if(!empty($package->photo_desktop) && file_exists(public_path().'/'.$package->photo_desktop))
                                        <div class="col-sm-4">
                                            <a class="image-popup-vertical-fit"
                                               href="{{url('/'.$package->photo_desktop)}}">
                                                <img
                                                    src="{{url('/'.$package->photo_desktop)}}"
                                                    class="img-fluid" alt=""/>
                                            </a>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">{{ $package->price }}</td>
                                <td class="text-center">{{ $package->exam_count }}</td>
                                <td class="text-center">{{ $package->expiration_duration_in_dayes }}
                                    {{ trans('messages.Day') }}</td>
                                <td class="text-center">{{ $package->created_at }}</td>


                                <td class="text-center">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input type="checkbox" id="Checkboxen_{{ $key }}"
                                                   <?php if ($package->active == 1) {
                                                       echo 'checked';
                                                   } ?> onchange="updatedActive(this)"
                                                   value="{{ $package->id }}"/>
                                            <label for="Checkboxen_{{ $key }}"></label>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    @can('package_delete')
                                        <form action="{{ route('package.destroy', $package->id) }}" method="Post"
                                              id="destroy-form-{{ $package->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endcan
                                    @can('package_cerate_edit_offer')
                                        <a href="#" onclick="cerateEditOffer({{ $package->id }})"
                                           title="{{ trans('messages.Make offer') }}"
                                           class="waves-effect waves-light btn btn-primary-light btn-circle {{ $package->offer ? 'offer-active' : '' }} ">
                                            <i class="ti-wand">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </a>
                                    @endcan
                                    @can('package_edit')
                                        <a href="{{ route('package.edit', $package->id) }}"
                                           class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="icon-Write"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    @endcan
                                    @can('package_delete')
                                        <a data-title="{{ trans('messages.Are you sure?') }}"
                                           data-no="{{ trans('messages.Cancel') }}"
                                           data-yes="{{ trans('messages.Yes, delete it!') }}"
                                           data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                           href="#" data-href="{{ $package->id }}"
                                           class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="icon-Trash1"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    @endcan
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
        function cerateEditOffer(id) {
            $.post(`{{ route('package.cerateEditOffer') }}`, {
                _token: '{{ csrf_token() }}',
                id: id
            }, function (data) {
                $('#make-offer .modal-dialog .modal-content').html(data);
                $('#make-offer').modal();

            });
        }

        function updatedActive(el) {
            if (el.checked) {
                var enable = 1;
            } else {
                var enable = 0;
            }
            $.post(`{{ route('package.changeActive') }}`, {
                _token: '{{ csrf_token() }}',
                id: el.value,
            }, function(data) {

            });
        }
    </script>
@endsection
