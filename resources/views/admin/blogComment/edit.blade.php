@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Edit Blog') }}</h3>
            </div>

        </div>
    </div>

    <style>
        .bootstrap-tagsinput {
            width: 100%;
            padding: 0.6em;
        }
    </style>
    <!-- Main content -->

    <section class="content">
        {!! Form::open([
            'method' => 'PUT',
            'route' => ['blogComment.update', $blogComment->id],
            'files' => true,
            'id' => 'edit-pade-form',
        ]) !!}
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="box">
                    <div class="box-body">
                        <div class="p-15">
                            <div class="form-group">
                                <label for="comment">{{ trans('messages.Comment') }}
                                </label>
                                <div>
                                    {!! Form::textarea('comment', $blogComment->comment, [
                                        'id' => 'editor1',
                                        'class' => 'form-control',
                                        'placeholder' => trans('messages.Comment'),
                                    ]) !!}
                                </div>
                                @error('comment')
                                    <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> {{ trans('messages.Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::Close() !!}
    </section>
@endsection


@section('script')
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endsection
