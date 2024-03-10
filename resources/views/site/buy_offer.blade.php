@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Purchase done') }}@stop
@section('content')
    <section class="container-fluid static-page-wrapper">
        <div class="container">
            <a href="{{ route('purchaseDone', ['offer', $offer->id]) }}"
                class="btn">{{ trans('messages.Burchase Done Click here') }}</a>
        </div>
    </section>
@endsection
