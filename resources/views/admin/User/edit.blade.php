@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Edit Moderator') }}</h3>
            </div>

        </div>
    </div>
    <!-- Main content -->

    <section class="content">
        {!! Form::open([
            'method' => 'PUT',
            'route' => ['user.update', $user->id],
            'files' => true,
            'id' => 'edit-user-form',
        ]) !!}
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">{{ trans('messages.Name') }}
                            </label>
                            <div>
                                {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => trans('messages.Name')]) !!}
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
                                {!! Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => trans('messages.Email')]) !!}
                            </div>
                            @error('email')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ trans('messages.Phone') }}
                            </label>
                            <div>
                                {!! Form::text('phone', $user->phone, ['class' => 'form-control', 'placeholder' => trans('messages.Phone')]) !!}
                            </div>
                            @error('phone')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                </div>
                            @enderror
                        </div>
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
                        <div class="form-group">
                            <label for="new_password">{{ trans('messages.New Password') }}
                            </label>
                            <div>
                                {!! Form::password('new_password', [
                                    'autocomplete' => 'new-password',
                                    'class' => 'form-control',
                                    'placeholder' => trans('messages.Leave blank if you dont need to change'),
                                ]) !!}
                            </div>
                            @error('new_password')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ trans('messages.Gender') }}
                            </label>
                            <div>
                                {!! Form::select('gender', ['Male' => trans('messages.Male'), 'Female' => trans('messages.Female')], $user->gender, [
                                    'class' => 'form-control select2',
                                    'style' => 'width:100%;',
                                    'data-placeholder' => trans('messages.Gender'),
                                ]) !!}
                            </div>
                            @error('gender')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{ trans('messages.Role') }}
                            </label>
                            <div>
                                {!! Form::select('role_id', $roles, $user->role_id, [
                                    'class' => 'form-control select2',
                                    'style' => 'width:100%;',
                                    'data-placeholder' => trans('messages.Roles'),
                                ]) !!}
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
