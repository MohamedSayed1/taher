@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Add Client') }}</h3>
            </div>

        </div>
    </div>
    <!-- Main content -->

    <section class="content">
        {!! Form::open(['route' => 'client.store', 'files' => true, 'id' => 'add-client-form']) !!}
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">{{ trans('messages.Name') }}
                            </label>
                            <div>
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('messages.Name')]) !!}
                            </div>
                            @error('name')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('messages.Email') }}
                            </label>
                            <div>
                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('messages.Email')]) !!}
                            </div>
                            @error('email')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ trans('messages.Password') }}
                            </label>
                            <div>
                                {!! Form::password('password', [
                                    'autocomplete' => 'new-password',
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Password'),
                                ]) !!}
                            </div>
                            @error('password')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{ trans('messages.Confirm Password') }}
                            </label>
                            <div>
                                {!! Form::password('password_confirmation', [
                                    'autocomplete' => 'new-password',
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Password'),
                                ]) !!}
                            </div>
                            @error('password_confirmation')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                </div>
                            @enderror
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
