@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Packages & Offers') }}@stop
@section('content')
    @php
        // test //
        $header_data = App\Models\Setting::select('test_exam_id', 'home_title_' . App::getLocale() . ' as home_title', 'home_description_' . App::getLocale() . ' as home_description')->find(1);
    @endphp

    <style>
        @media (max-width: 576px) {
            .header-section.desktop {
                display: none;
            }

            .header-section.mobile {
                display: block !important;
            }

            .header-section .btn {
                padding: 0.4rem 3rem !important;
            }

            .mobile .package-header {
                flex-wrap: wrap;
            }
        }

        .package-card .offer_badge {
            position: absolute;
            overflow: hidden;
            width: 150px;
            height: 150px;
            top: -10px;
            right: -10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .package-card .offer_border {
            position: absolute;
            top: 40px;
            right: -20px;
            width: 150%;
            height: 35px;
            transform: rotate(45deg) translateY(-20px);
            background: transparent;
            border-top: 1px solid yellow;
            border-bottom: 1px solid yellow;
        }

        .package-card .offer_badge::before {
            content: attr(offer-content);
            position: absolute;
            width: 150%;
            height: 40px;
            background-image: linear-gradient(45deg, #148500 0%, #21cb0e 51%, #148500 100%);
            transform: rotate(45deg) translateY(-20px);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.23);
        }

        .package-card .offer_badge::after {
            content: '';
            position: absolute;
            width: 10px;
            bottom: 0;
            right: 0;
            height: 10px;
            z-index: -1;
            box-shadow: -140px -140px #020a00;
            background-image: linear-gradient(45deg, #020a00 0%, #25d511 51%, #0b4700 100%);
        }

        .packages-container, .package-card {
            transition: 0.4s all ease
        }

        .packages-container:hover .package-card {
            filter: blur(3px);
            opacity: .5;
            transform: scale(.98);
            box-shadow: none;
        }

        .packages-container:hover .package-card:hover {
            transform: scale(1);
            filter: blur(0px);
            opacity: 1;
            box-shadow:unset;
            background: #1ba9ff !important;
            color: white !important;
            cursor: pointer;
            border: unset !important;
        }

        .form-check-input, .form-check-input + label {
            cursor: pointer;
        }

        .btn, .lang-btn {
            transition: 0.4s all ease;
        }

        .btn:hover {
            transform: scale(1.1)
        }

        .lang-btn:hover {
            letter-spacing: 1.5px;
        }
    </style>

        <div class="row top-row text-center my-5">
            <h1 class="title" style="color: #1ba9ff;">{{ trans('messages.Packages & Offers') }}</h1>
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
        </div>

        <div class="container-fluid header-section desktop mb-5">
            <div class="row justify-content-center p-4 mx-5" style="border:3px solid #c9c9c9; border-radius:20px">
                <div class="col-12 text-center mb-5">
                    <a href="{{route('start_package')}}"
                       class="btn"
                       style="background:#01b701; border-radius:20px; padding:0.5rem 7rem; color:white; font-size:20px">{{ trans('messages.Start Exam') }}
                    </a>
                </div>
                <div class="col-12 mb-5">
                    <form id="desktopPackages" name="desktopPackages" method="post"
                          action="{{route('purchasePackage')}}">
                        <div class="row packages-container">
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
                            @foreach($packages as $key => $package)
                                <div class="col-lg-4 col-md-6 col-sm-12"  style="{{$loop->iteration ==2?'padding-inline:2rem;':''}}">
                                    @if($package->type_view == 'photo' && $package->{'cove_desktop_' . App::getLocale()} != null )
                                        <a href="{{route('start_package')}}" for="{{$package->id}}" class="package-card"
                                           style=" color:black;position:relative;display: block;text-decoration:none; width:100%;">

                                            <div class="package-wrapper">
                                                <div
                                                    class="package-header d-flex align-items-center justify-content-between flex-wrap">
                                                    @if(!empty($package->{'cove_desktop_' . App::getLocale()}) && file_exists(public_path().'/'.$package->{'cove_desktop_' . App::getLocale()}) )
                                                        <img style="width:100%;aspect-ratio:1/1;"
                                                             src="{{ url($package->{'cove_desktop_' . App::getLocale()}) }}"
                                                             alt="">
                                                    @else
                                                        <img style="width:100%;aspect-ratio:1/1;"
                                                             src="{{ url('front_them/assets/imgs/02.png') }}"
                                                             alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    @else
                                        <a href="{{route('start_package')}}" for="{{$package->id}}" class="package-card"
                                           style=" color:black;position:relative;display: block;text-decoration:none;background-color:{{$package->color_background!= null?$package->color_background:'#0000ff30' }}; border:1px solid {{$package->color_border!= null?$package->color_border:'#b3b3b3'}}; width:100%; border-radius:5px; padding:1.5rem 4rem 1.5rem 1.5rem;">

                                            @if($package->{'badge_' . App::getLocale()} != null)
                                                <span class="offer_badge"
                                                      offer-content="{{$package->{'badge_' . App::getLocale()} }}">
                                     <span class="offer_border"></span>
                                    </span>
                                            @endif
                                            <div class="package-wrapper">
                                                <div
                                                    class="package-header d-flex align-items-center justify-content-between flex-wrap">
                                                    @if(!empty($package->photo_desktop) && file_exists(public_path().'/'.$package->photo_desktop) )
                                                        <img style="height:100px;width:auto;aspect-ratio:1/1;"
                                                             src="{{ url($package->photo_desktop) }}" alt="">
                                                    @else
                                                        <img style="height:100px;width:auto;aspect-ratio:1/1;"
                                                             src="{{ url('front_them/assets/imgs/02.png') }}"
                                                             alt="">
                                                    @endif
                                                    <span class="package-price"
                                                          style="font-size:30px; font-weight:900;">
                                        @if ($package->offer)
                                                            <sub class="before"
                                                                 style="text-decoration: line-through;">{{ $package->price }}</sub>
                                                            <span>{{ $package->price - $package->offer->discount_amount }}</span>
                                                        @else
                                                            {{ $package->price }}
                                                        @endif
                                          €
                                    </span>
                                                </div>
                                                <div class="package-select">
                                                    @if(Auth()->check())
                                                        @if ($package->offer)
                                                            <input class="form-check-input" type="radio" id="{{$package->id}}"
                                                                   name="id"
                                                                   value="{{$package->offer->id}}">
                                                            <input type="hidden" name="package_offer" value="offer">
                                                        @else
                                                            <input class="form-check-input" type="radio" id="{{$package->id}}"
                                                                   name="id"
                                                                   value="{{$package->id}}">
                                                            <input type="hidden" name="package_offer" value="package">
                                                        @endif
                                                    @else
                                                        <input class="form-check-input" type="radio" id="{{$package->id}}"
                                                               name="id"
                                                               value="{{$package->id}}">
                                                        <input type="hidden" name="package_offer" value="package">

                                                    @endif

                                                    <span
                                                        style="font-size:22px; font-weight:700">{{ $package->{'name_' . App::getLocale()} }}</span>
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                                </div>
                                                <div class="package-options">
                                                    <ul style="list-style-type:none" class="">
                                                        {!! $package->{'notes_' . App::getLocale()} !!}
                                                    </ul>
                                                </div>
                                            </div>
                                        </a>
                                    @endif


                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="col-12 text-center">
                    <a href="{{ route('examInfo', $header_data->test_exam_id) }}"
                       class="btn"
                       style="background:#1ba9ff; border-radius:20px; padding:0.5rem 7rem; color:white">{{ trans('messages.Free demo test') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="container-fluid header-section mobile d-none mb-5">
            <div class="row justify-content-center mx-2" style="border:3px solid #c9c9c9; border-radius:20px">

                <div class="col-12 text-center mb-5">

                    <a href="{{route('start_package')}}"
                       class="btn"
                       style="background:#01b701; border-radius:20px; padding:0.5rem 7rem; color:white">{{ trans('messages.Start Exam') }}
                    </a>

                </div>
                <div class="col-12 mb-5">
                    <form id="MobilePackages" name="MobilePackages" method="post"
                          action="{{route('purchasePackage')}}">
                        <div class="row">
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
                            @foreach($packages as $key => $package)
                                <div class="{{$loop->iteration ==1?'col-12':'col-6'}} ">
                                    @if($loop->iteration ==1)
                                        <div class="row justify-content-center">
                                            <div class="col-10 mb-4" style="padding-inline:2rem">
                                                @endif
                                                @if($package->type_view == 'photo' && $package->{'cove_phone_' . App::getLocale()} != null )
                                                    <a href="{{route('start_package')}}" for="mob_{{$package->id}}"
                                                       class="package-card"
                                                       style="color:black;display: block;text-decoration:none;position:relative; width:100%; border-radius:5px; {{$loop->iteration ==1?'transform:scale(1.1);':''}}">


                                                        <div class="package-wrapper">
                                                            <div class="package-header d-flex align-items-center justify-content-between">
                                                                @if(!empty($package->{'cove_phone_' . App::getLocale()}) && file_exists(public_path().'/'.$package->{'cove_phone_' . App::getLocale()}) )
                                                                    <img
                                                                        style="width:100%;aspect-ratio:1/1;"
                                                                        src="{{ url($package->{'cove_phone_' . App::getLocale()}) }}"
                                                                        alt="">
                                                                @else
                                                                    <img
                                                                        style=" width:100%;aspect-ratio:1/1;"
                                                                        src="{{ url('front_them/assets/imgs/02.png') }}"
                                                                        alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </a>
                                                @else
                                                    <a href="{{route('start_package')}}" for="mob_{{$package->id}}"
                                                       class="package-card"
                                                       style="color:black;display: block;text-decoration:none;position:relative;background-color:{{$package->color_background!= null?$package->color_background:'#0000ff30' }}; border:1px solid {{$package->color_border!= null?$package->color_border:'#b3b3b3'}}; width:100%; border-radius:5px; padding:1rem; {{$loop->iteration ==1?'transform:scale(1.1);':''}}">


                                                        @if($package->{'badge_' . App::getLocale()} != null)
                                                            <div class="ribbon ribbon-top-right">
                                                                <span>{{$package->{'badge_' . App::getLocale()} }}</span>
                                                            </div>

                                                        @endif

                                                        <div class="package-wrapper">
                                                            <div class="package-header d-flex align-items-center justify-content-between">
                                                                @if(!empty($package->photo_phone) && file_exists(public_path().'/'.$package->photo_phone) )
                                                                    <img
                                                                        style="height:100px;width:120px;aspect-ratio:1/1; margin-inline-start:1rem"
                                                                        src="{{ url($package->photo_phone) }}"
                                                                        alt="">
                                                                @else
                                                                    <img
                                                                        style="height:100px; width:120px;aspect-ratio:1/1; margin-inline-start:1rem"
                                                                        src="{{ url('front_them/assets/imgs/02.png') }}"
                                                                        alt="">
                                                                @endif
                                                                <span class="package-price"
                                                                      style="font-size:30px; font-weight:900; white-space:nowrap">

                                        @if ($package->offer)
                                                                        <sub
                                                                            class="before"
                                                                            style="text-decoration: line-through;">{{ $package->price }}</sub>
                                                                        <span>{{ $package->price - $package->offer->discount_amount }}</span>
                                                                    @else
                                                                        {{ $package->price }}
                                                                    @endif
                                          €
                                            </span>
                                                            </div>
                                                            <div class="package-select">
                                                                @if(Auth()->check())
                                                                    @if ($package->offer)
                                                                        <input class="form-check-input" type="radio"
                                                                               id="mob_{{$package->id}}"
                                                                               name="id"
                                                                               value="{{$package->offer->id}}">
                                                                        <input type="hidden" name="package_offer" value="offer">
                                                                    @else
                                                                        <input class="form-check-input" type="radio"
                                                                               id="mob_{{$package->id}}"
                                                                               name="id"
                                                                               value="{{$package->id}}">
                                                                        <input type="hidden" name="package_offer" value="package">
                                                                    @endif
                                                                @else
                                                                    <input class="form-check-input" type="radio"
                                                                           id="mob_{{$package->id}}"
                                                                           name="id"
                                                                           value="{{$package->id}}">
                                                                    <input type="hidden" name="package_offer" value="package">
                                                                @endif
                                                                <span
                                                                    style="font-size:18px; font-weight:700;">{{ $package->{'name_' . App::getLocale()} }}</span>
                                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                            </div>
                                                            <div class="package-options">
                                                                <ul style="list-style-type:none" class="">
                                                                    {!! $package->{'notes_' . App::getLocale()} !!}
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endif


                                                @if($loop->iteration ==1)
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </form>

                </div>

                <div class="col-12 text-center">
                    <a href="{{ route('examInfo', $header_data->test_exam_id) }}"
                       class="btn"
                       style="background:#1ba9ff; border-radius:20px; padding:0.5rem 7rem; color:white; white-space:nowrap">{{ trans('messages.Free demo test') }}
                    </a>
                </div>
            </div>
        </div>

@endsection
