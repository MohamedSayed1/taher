@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Packages & Offers') }}@stop
@section('content')
    <section class="packages-page-wrapper container">
        <div class="row top-row text-center">
            <h1 class="title">{{ trans('messages.Packages & Offers') }}</h1>
        </div>
        <div class="row cards-row " id="packages-cards">
            @if (session('error'))
                <div class="alert alert-danger" style="margin-bottom: 3em">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @forelse ($packages as $key => $package)
                @if ($package->{'badge_' . App::getLocale()})
                    <div class="package-wrapper active animate__animated animate__zoomIn">
                        @if (Auth::check())
                            @if ($package->offer)
                                <a style="text-decoration:none" href="{{ route('purchasePackage', ['offer', $package->offer->id]) }}">
                                    @else
                                        <a style="text-decoration:none" href="{{ route('purchasePackage', ['package', $package->id]) }}">
                                            @endif
                                            @else
                                                <a style="text-decoration:none" href="{{ route('register') }}">
                                                    @endif
                        <div class="ribbon"><span>{{ $package->{'badge_' . App::getLocale()} }}</span></div>
                        <h4 class="title">{{ $package->{'name_' . App::getLocale()} }}</h4>
                        <div class="price-wrapper">
                            <p class="price">
                                @if ($package->offer)
                                    <sub class="before">{{ $package->price }}</sub>
                                    <span>{{ $package->price - $package->offer->discount_amount }}</span>
                                @else
                                    <span>{{ $package->price }}</span>
                                @endif
                                <sub>€</sub>
                            </p>
                        </div>
                        <ul class="features">
                            {!! $package->{'notes_' . App::getLocale()} !!}
                        </ul>
                        @if (Auth::check())
                            @if ($package->offer)
                                <a class="btn"
                                    href="{{ route('purchasePackage', ['offer', $package->offer->id]) }}">{{ trans('messages.buyNow') }}</a>
                            @else
                                <a href="{{ route('purchasePackage', ['package', $package->id]) }}"
                                    class="btn">{{ trans('messages.buyNow') }}</a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="btn">{{ trans('messages.buyNow') }}</a>
                        @endif
                                                </a>
                    </div>
                @else
                    <div class="package-wrapper animate__animated animate__zoomIn">
                        @if (Auth::check())
                            @if ($package->offer)
                                <a style="text-decoration:none" href="{{ route('purchasePackage', ['offer', $package->offer->id]) }}">
                                    @else
                                        <a style="text-decoration:none" href="{{ route('purchasePackage', ['package', $package->id]) }}">
                                            @endif
                                            @else
                                                <a style="text-decoration:none" href="{{ route('register') }}">
                                                    @endif
                        <h4 class="title">{{ $package->{'name_' . App::getLocale()} }}</h4>
                        <div class="price-wrapper">
                            <p class="price">
                                @if ($package->offer)
                                    <sub class="before">{{ $package->price }}</sub>
                                    <span>{{ $package->price - $package->offer->discount_amount }}</span>
                                @else
                                    <span>{{ $package->price }}</span>
                                @endif
                                <sub>€</sub>
                            </p>
                        </div>
                        <ul class="features">
                            {!! $package->{'notes_' . App::getLocale()} !!}
                        </ul>
                        @if (Auth::check())
                            @if ($package->offer)
                                <a class="btn"
                                    href="{{ route('purchasePackage', ['offer', $package->offer->id]) }}">{{ trans('messages.buyNow') }}</a>
                            @else
                                <a href="{{ route('purchasePackage', ['package', $package->id]) }}"
                                    class="btn">{{ trans('messages.buyNow') }}</a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="btn">{{ trans('messages.buyNow') }}</a>
                        @endif
                                                </a>
                    </div>
                @endif
            @empty
                <h3>{{ trans('messages.No Packages') }}</h3>
            @endforelse

        </div>
    </section>
@endsection
