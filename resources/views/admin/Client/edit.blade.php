@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Edit Client') }}</h3>
            </div>

        </div>
    </div>
    <!-- Main content -->

    <section class="content">
        {!! Form::open([
            'method' => 'PUT',
            'route' => ['client.update', $client->id],
            'files' => true,
            'id' => 'edit-client-form',
        ]) !!}
        {!! Form::hidden('id', $client->id, []) !!}
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">{{ trans('messages.Name') }}
                            </label>
                            <div>
                                {!! Form::text('name', $client->name, ['class' => 'form-control', 'placeholder' => trans('messages.Name')]) !!}
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
                                {!! Form::text('email', $client->email, ['class' => 'form-control', 'placeholder' => trans('messages.Email')]) !!}
                            </div>
                            @error('email')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!--
                                            <div class="form-group">
                                                <label for="old_password">{{ trans('messages.Old Password') }}
                                                </label>
                                                <div>
                                                    {!! Form::password('old_password', [
                                                        'autocomplete' => 'new-password',
                                                        'class' => 'form-control',
                                                        'placeholder' => trans('messages.Leave blank if you dont need to change'),
                                                    ]) !!}
                                                </div>
                                                @error('old_password')
        <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                                                        </div>
    @enderror
                                            </div>
                    -->
                        <div class="form-group">
                            <label for="new_password">{{ trans('messages.New Password') }}
                            </label>
                            <div class="password-container">
                                {!! Form::password('new_password', [
                                    'id' => 'login-password',
                                    'autocomplete' => 'new-password',
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Leave blank if you dont need to change'),
                                ]) !!}
                                <i class="fa fa-eye login-eye-icon-{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
                                    id="login-eye-icon"
                                    style="cursor: pointer;"></i>
                            </div>
                            @error('new_password')
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
        $(document).on('click', '#login-eye-icon', function() {
            $("#login-eye-icon").toggleClass("fa-eye fa-eye-slash");
            var input = $("#login-password");
            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
        });
    </script>
@endsection
