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
        {!! Form::open(['route' => 'subscription.store', 'files' => true, 'id' => 'add-subscription-form']) !!}
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="box">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">{{ trans('messages.Clients') }}
                            </label>
                            <div>
                                {!! Form::select('user_id', $clients, $user_id, [
                                    'class' => 'form-control select2',
                                    'id' => 'package_id',
                                    'data-placeholder' => trans('Package'),
                                ]) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="name">{{ trans('messages.Package') }}
                                    </label>
                                    <div>
                                        {!! Form::select('package_id', $packages, null, [
                                            'class' => 'form-control select2',
                                            'id' => 'package_id',
                                            'data-placeholder' => trans('Package'),
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group" id="offer_id_cont">
                                    <label for="name">{{ trans('messages.Offer') }}
                                    </label>
                                    <div>
                                        {!! Form::select('offer_id', $offers, null, [
                                            'placeholder' => trans('messages.Choose Offer'),
                                            'class' => 'form-control',
                                            'id' => 'offer_id',
                                            'onchange' => 'getOfferDiscount(this)',
                                            'data-placeholder' => trans('Offer'),
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    <label for="offer_discount">{{ trans('messages.Discount amount') }}
                                    </label>
                                    <div>
                                        {!! Form::number('offer_discount', 0, [
                                            'class' => 'form-control',
                                            'id' => 'offer_discount',
                                            'placeholder' => trans('messages.Discount amount'),
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
    <script type="text/javascript">
        $('.select2').select2();
        $.post(`{{ route('package.getPackageOffers') }}`, {
            _token: '{{ csrf_token() }}',
            id: $(this).val()
        }, function(data) {
            $("#offer_id_cont").html(data);
        });
        $.post(`{{ route('package.getPackagePrice') }}`, {
            _token: '{{ csrf_token() }}',
            id: $(this).val()
        }, function(data) {
            $("#price").val(data);
        });
        $('#package_id').change(function() {
            $.post(`{{ route('package.getPackageOffers') }}`, {
                _token: '{{ csrf_token() }}',
                id: $(this).val()
            }, function(data) {
                $("#offer_id_cont").html(data);
            });
            $.post(`{{ route('package.getPackagePrice') }}`, {
                _token: '{{ csrf_token() }}',
                id: $(this).val()
            }, function(data) {
                $("#price").val(data);
            });
        })

        function getOfferDiscount(v) {
            var offer_id = v.options[v.selectedIndex].value;
            if (offer_id != '') {
                $.post(`{{ route('offer.getOfferDiscount') }}`, {
                    _token: '{{ csrf_token() }}',
                    id: offer_id
                }, function(data) {
                    $("#offer_discount").val(data);
                });
            } else {
                $('#offer_discount').val(0);
            }
        }
    </script>
@endsection
