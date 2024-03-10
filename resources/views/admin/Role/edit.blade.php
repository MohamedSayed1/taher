@extends('admin.layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Edit role') }}</h3>
            </div>

        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="box">
                    {!! Form::open([
                        'method' => 'PUT',
                        'route' => ['role.update', $role->id],
                        'files' => true,
                        'id' => 'edit-role-form',
                    ]) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="Name">{{ trans('messages.Name') }}
                            </label>
                            <div>
                                {!! Form::text('name', $role->name, ['class' => 'form-control', 'placeholder' => trans('messages.Name')]) !!}
                            </div>
                            @error('name')
                                <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <h3 class="mb-0 h6">{{ trans('messages.Permissions') }}</h3>
                        @error('permissions')
                            <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}</div>
                        @enderror
                        <hr>

                        @foreach (config('global.permissions') as $permgroup => $permissions)
                            <h3 class="text-center" style="background-color: #7e8299;color: #fff;margin: 1.3em 0em;padding: 5px;">{{ trans('messages.' . $permgroup) }}</h3>
                            <div class="perm-cont">
                                <div class="row">
                                    @foreach ($permissions as $key => $permission)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    {!! Form::checkbox('permissions[]', $key, in_array($key, $role->permissions) ? 1 : 0, [
                                                        'id' => 'Checkbox_' . $key,
                                                    ]) !!}
                                                    <label
                                                        for="Checkbox_{{ $key }}">{{ trans('messages.' . $permission) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> {{ trans('messages.Save') }}
                        </button>
                    </div>
                    {!! Form::Close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
