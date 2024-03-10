@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Blog') }}</h3>
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
                                <form action="{{ route('blog.index') }}" method="GET">
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
                        @can('blog_store')
                            <a href="{{ route('blog.create') }}"
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
                                <th class="text-center">{{ trans('messages.Tags') }}</th>
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $key => $blog)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($blogs->currentPage() - 1) * $blogs->perPage() }}
                                    </td>
                                    <td class="text-center">{{ $blog->{'title_' . App::getLocale()} }}</td>
                                    <td class="text-center">
                                        @foreach (explode(',', $blog->{'tags_' . App::getLocale()}) as $tag)
                                            <div class="badge badge-primary">{{ $tag }}</div>
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{ $blog->created_at }}</td>
                                    <td class="text-center">
                                        @can('blog_delete')
                                            <form action="{{ route('blog.destroy', $blog->id) }}" method="Post"
                                                id="destroy-form-{{ $blog->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                        @can('blog_edit')
                                            <a href="{{ route('blog.edit', $blog->id) }}"
                                                class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Write"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                        @can('blog_delete')
                                            <a data-title="{{ trans('messages.Are you sure?') }}"
                                                data-no="{{ trans('messages.Cancel') }}"
                                                data-yes="{{ trans('messages.Yes, delete it!') }}"
                                                data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                                href="#" data-href="{{ $blog->id }}"
                                                class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                    class="icon-Trash1"><span class="path1"></span><span
                                                        class="path2"></span></span></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $blogs->withQueryString()->links('pagination::bootstrap-4') !!}

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
    <script type="text/javascript"></script>
@endsection
