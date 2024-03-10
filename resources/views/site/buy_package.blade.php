@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Purchase done') }}@stop
@section('content')
    <section class="container-fluid static-page-wrapper">
        <div class="container text-center" style="margin-bottom: 20em">
            <a href="{{ route('purchaseDone', ['package', $package->id]) }}"
                class="btn btn-primary">{{ trans('messages.Burchase Done Click here') }}</a>
        </div>
    </section>
@endsection
