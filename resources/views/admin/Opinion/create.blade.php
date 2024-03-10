@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Add Opinion') }}</h3>
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
        {!! Form::open(['route' => 'opinion.store', 'files' => true, 'id' => 'add-opinion-form']) !!}
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="opinion">{{ trans('messages.Opinion') }}
                            </label>
                            <div>
                                {!! Form::textarea('opinion', null, ['class' => 'form-control', 'placeholder' => trans('messages.Opinion')]) !!}
                            </div>
                            @error('opinion')
                                <div class="badge badge-danger text-center" style="width: 100%">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">{{ trans('messages.Client') }}
                            </label>
                            <div>
                                {!! Form::select('user_id', $clients, null, [
                                    'class' => 'form-control select2',
                                    'data-placeholder' => trans('messages.Client'),
                                ]) !!}

                            </div>
                            @error('user_id')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                {!! Form::checkbox('enable', null, 1, ['id' => 'Checkbox_1']) !!}
                                <label for="Checkbox_1">{{ trans('messages.Enable Faq') }}</label>
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
