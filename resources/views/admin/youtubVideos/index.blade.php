@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Youtube Videos') }}</h3>
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
                                <form action="{{ route('youtubVideos.index') }}" method="GET">
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
                        <a href="{{ route('youtubVideos.create') }}"
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
                                <th class="text-center">{{ trans('messages.Title') }}</th>
                                <th class="text-center">{{ trans('messages.Video type') }}</th>
                                <th class="text-center">{{ trans('messages.Link') }}</th>
                                <th class="text-center">{{ trans('messages.Enabled') }}</th>
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $key => $video)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($videos->currentPage() - 1) * $videos->perPage() }}
                                    </td>
                                    <td class="text-center">{{ $video->{'title_' . App::getLocale()} }}</td>
                                    <td class="text-center">{{ $video->video_type }}</td>
                                    <td class="text-center"><a href="{{ $video->video_link }}" target="blank"><i
                                                class="fa fa-link" style="font-size: 1.5em"></i></a></td>
                                    <td class="text-center">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <input type="checkbox" id="Checkbox_{{ $key }}"
                                                    <?php if ($video->enabel == 1) {
                                                        echo 'checked';
                                                    } ?> onchange="update_enabel(this)"
                                                    value="{{ $video->id }}" />
                                                <label for="Checkbox_{{ $key }}"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $video->created_at }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('youtubVideos.destroy', $video->id) }}" method="Post"
                                            id="destroy-form-{{ $video->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{ route('youtubVideos.edit', $video->id) }}"
                                            class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="icon-Write"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                        <a data-title="{{ trans('messages.Are you sure?') }}"
                                            data-no="{{ trans('messages.Cancel') }}"
                                            data-yes="{{ trans('messages.Yes, delete it!') }}"
                                            data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                            href="#" data-href="{{ $video->id }}"
                                            class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="icon-Trash1"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $videos->withQueryString()->links('pagination::bootstrap-4') !!}

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
            $.post(`{{ route('youtubVideos.updateEnabel') }}`, {
                _token: '{{ csrf_token() }}',
                id: el.value,
                enabel: enabel
            }, function(data) {

            });
        }
    </script>
@endsection
