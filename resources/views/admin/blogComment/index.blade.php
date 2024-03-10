@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> {{ trans('messages.Comments') }}</h3>
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
                                <form action="{{ route('blogComment.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="search" id="search" class="form-control" name="search"
                                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                            placeholder="{{ trans('messages.Comment') }}" aria-label="Search"
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
                                <th class="text-center">{{ trans('messages.comment') }}</th>
                                <th class="text-center">{{ trans('messages.Created') }}</th>
                                <th class="text-center">{{ trans('messages.Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $key => $comment)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 + ($comments->currentPage() - 1) * $comments->perPage() }}
                                    </td>
                                    <td class="text-center">{{ $comment->user->name }}</td>
                                    <td class="text-center">{{ $comment->comment }}</td>
                                    <td class="text-center">{{ $comment->created_at }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('blogComment.destroy', $comment->id) }}" method="Post"
                                            id="destroy-form-{{ $comment->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{ route('blogComment.edit', $comment->id) }}"
                                            class="waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="icon-Write"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                        <a data-title="{{ trans('messages.Are you sure?') }}"
                                            data-no="{{ trans('messages.Cancel') }}"
                                            data-yes="{{ trans('messages.Yes, delete it!') }}"
                                            data-desc="{{ trans('messages.You will not be able to recover this!') }}"
                                            href="#" data-href="{{ $comment->id }}"
                                            class="sa-warning waves-effect waves-light btn btn-primary-light btn-circle"><span
                                                class="icon-Trash1"><span class="path1"></span><span
                                                    class="path2"></span></span></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {!! $comments->withQueryString()->links('pagination::bootstrap-4') !!}

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
