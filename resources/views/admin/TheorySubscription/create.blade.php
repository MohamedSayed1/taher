@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ trans('messages.Create Subscribtion') }}</h3>
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
        {!! Form::open(['route' => 'theorySubscription.store', 'files' => true, 'id' => 'add-theorySubscription-form']) !!}
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="box">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">{{ trans('messages.Clients') }}
                            </label>
                            <div>
                                {!! Form::select('user_id', $clients, null, [
                                    'class' => 'form-control select2',
                                    'id' => 'package_id',
                                    'data-placeholder' => trans('Package'),
                                ]) !!}
                            </div>
                        </div>
                        {!! Form::hidden('theory_package_id', $theory_package_id, []) !!}

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group" style="padding: 1em;">
                                    <label for="price">{{ trans('messages.Price') }}
                                    </label>
                                    <div>
                                        {!! Form::number('price', 0, [
                                            'class' => 'form-control',
                                            'id' => 'price',
                                            'placeholder' => trans('messages.Price'),
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group" style="padding: 1em;">
                                    <label for="whatsapp">{{ trans('messages.Whatsapp') }}
                                    </label>
                                    <div>
                                        {!! Form::number('whatsapp', 0, [
                                            'class' => 'form-control',
                                            'id' => 'whatsapp',
                                            'placeholder' => trans('messages.Whatsapp'),
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group" style="padding: 1em;">
                                    <label for="subscription_date">{{ trans('messages.Subscription date') }}
                                    </label>
                                    <div>
                                        {!! Form::datetimeLocal('subscription_date', null, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('messages.Start date'),
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group" style="padding: 1em;">
                                    <label for="expiration_date">{{ trans('messages.Expiration date') }}
                                    </label>
                                    <div>
                                        {!! Form::datetimeLocal('expiration_date', null, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('messages.Expiration date'),
                                        ]) !!}
                                    </div>
                                </div>
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
    <script type="text/javascript"></script>
@endsection
