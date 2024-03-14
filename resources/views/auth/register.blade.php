<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('messages.Adnan Eltaher') }} | {{ trans('messages.Signup') }}</title>
    <link href="{{ url('front_them/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('front_them/assets/css/all.min.css') }}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Tajawal&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('front_them/assets/css/style_' . App::getLocale() . '.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/ms-dropdown@4.0.3/dist/css/dd.min.css" />
</head>
<style>
    .ms-dd {
        width:100%
    }
    .singup-container .package-card {
        transition: 0.4s all ease;
        cursor: pointer;
    }

    .singup-container .package-card:hover {
        transform:scale(1.05)
    }

    .btn{
            transition:0.4s all ease;
    }

    .btn:hover{
        transform: scale(1.05)
    }
</style>
<body>
<nav class="not-home">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ url('front_them/assets/imgs/small-logo.png') }}" alt="">
        </a>
        <div class="adnan-txt-desktop text-center" style="color:#1ba9ff; font-size:30px; font-weight:700;">
            <span class="d-block">عدنان الطاهر - Adnaan Altaher</span>
        </div>
        <div class="adnan-txt-mobile text-center d-none " style="color:#1ba9ff; font-size:20px; font-weight:700;">
            <span class="d-block w-100">عدنان الطاهر</span>
            <span class="d-block w-100">Adnaan Altaher</span>
        </div>
        <a href="{{ url()->previous() }}" class="back text-center d-block" style="cursor:pointer;text-decoration:none">
            <img src="{{ url('front_them/assets/imgs/back-arrow.png') }}" alt="" style="width:70px; height:70px">
            <span class="d-block txt" style="color:#1ba9ff; font-size:22px; font-weight:700">
              {{__('messages.Back')}}
                </span>
        </a>
    </div>
</nav>
<section class="container-fluid singup-container" style="overflow: auto; scroll-behavior: auto;height: 100%;">
    <div class="row justify-content-center">
        <!-- <div class="col-lg-1 col-md-0 col-sm-0"></div> -->
        <div class="col-lg-4 col-md-6 col-sm-12 singup-form-wrapper">
            <!-- <div class="row top-nav-row">
                <a href="{{ route('home') }}" class="back-link">
                    <i class="fa-sharp fa-solid fa-angle-right"></i>
                    <span>{{ trans('messages.Back to home') }}</span>
                </a>
            </div>
            <div class="row logo mt-1 mb-3">
                <img src="{{ url('front_them/assets/imgs/logo.png') }}" alt="logo image">
            </div>
            <div class="row head">
                <h1>{{ trans('messages.Create new account') }}</h1>
            </div> -->
            <div class="row">
                <!-- <div class="col-md-9 form-wrapper mt-1"> -->

                <form method="POST" action="{{ route('register') }}" id="register-user-form">
                    @csrf
                    @if(!empty($packeds))
                        @foreach($packeds as $packed)
                            <div class="col-12 mb-3">
                                <label for="{{$packed->id}}" class="package-card"
                                       style="position:relative; background-color:{{$packed->color_background!= null?$packed->color_background:'#0000ff30' }}; border:1px solid {{$packed->color_border!= null?$packed->color_border:'#b3b3b3'}}; width:100%; border-radius:5px; padding:0.5rem 2rem 0.5rem 0.5rem;">

                                    <!-- <div class="ribbon ribbon-top-right"><span>ribbon</span></div> -->
                                    @if($packed->{'badge_' . App::getLocale()} != null)
                                    <div class="ribbon ribbon-top-right">
                                        <span>{{$packed->{'badge_' . App::getLocale()} }}</span>
                                    </div>
                                    @endif
                                    <div class="package-wrapper">
                                        <div class="package-header d-flex align-items-center justify-content-between">
                                    <span class="package-price" style="font-size:20px; font-weight:900">

                                        @if ($packed->offer)
                                            <sub
                                                class="before">{{ $packed->price }}</sub>
                                            <span>{{ $packed->price - $packed->offer->discount_amount }}</span>
                                        @else
                                            {{ $packed->price }}
                                        @endif
                                          €
                                    </span>
                                            <div>
                                                <div class="package-select">
                                                        <input type="radio" class="form-check-input" id="{{$packed->id}}"
                                                               name="package"
                                                               value="{{$packed->id}}" required>
                                                    <span style="font-size:16px; font-weight:700">{{ $packed->{'name_' . App::getLocale()} }}</span>
                                                </div>
                                                <div class="package-options">
                                                    <ul style="list-style-type:none" class="">
                                                        {!! $packed->{'notes_' . App::getLocale()} !!}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    @endif
                    <div class="control-wrapper mb-3">
                    <select class="tech" name="payment" is="ms-dropdown" required>
                        @foreach($methods as $method)
                        <option data-image="{{ $method->image->svg }}" value="{{ $method->id }}">{{ $method->description  }}</option>
                        @endforeach
                    </select>
                    @error('payment')
                    <small class="error text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    <input type="hidden" value="Client" name="user_type">
                    <input type="hidden" value="{{ isset($_GET['prev']) ? $_GET['prev'] : null }}" name="prev">
                    <input type="hidden" value="{{ isset($_GET['prevId']) ? $_GET['prevId'] : null }}"
                           name="prevId">
                    <div class="control-wrapper mb-3">
                        <!-- <label for="sinup-name" class="form-label">{{ trans('messages.Name') }}</label> -->
                        <input type="text" class="form-control" id="sinup-name" name="name"
                               value="{{ old('name') }}" required autocomplete="name" autofocus
                               placeholder="{{ trans('messages.Name') }}">
                        @error('name')
                        <small class="error text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="control-wrapper mb-3">
                        <!-- <label for="sinup-email" class="form-label">{{ trans('messages.Email') }}</label> -->
                        <input type="email" class="form-control" id="sinup-email"
                               placeholder="{{ trans('messages.Email') }}"
                               name="email" value="{{ old('email') }}">
                        @error('email')
                        <small class="error text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!--div class="control-wrapper mb-3"-->
                        <!-- <label for="sinup-email" class="form-label">{{ trans('messages.Verify Email') }}</label> -->
                        <!--input type="email" class="form-control" placeholder="{{ trans('messages.Verify Email') }}"
                               id="sinup-email-verified" name="email_verify" required autocomplete="email">
                    </div-->
                    <small class="error text-danger" style="display: none"
                           id="verify-email-alert">{{ trans('messages.Emails doesnt matches') }}</small>
                    <div class="control-wrapper mb-3">
                        <!-- <label for="sinup-password" class="form-label">{{ trans('messages.Password') }}</label> -->
                        <div class="input-wrapper">
                            <input type="password" class="form-control" aria-describedby="signup-password-btn"
                                   id="signup-password" placeholder="{{ trans('messages.Password') }}" name="password"
                                   required
                                   autocomplete="new-password">
                            <button class="btn" type="button" id="signup-password-btn">
                                <i class="fa-regular fa-eye" id="signup-eye-icon"></i>
                            </button>
                        </div>
                        @error('password')
                        <small class="error text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!--div class="control-wrapper mb-3"-->
                        <!-- <label for="sinup-confirm-password"
                                   class="form-label">{{ trans('messages.confirm password') }}</label> -->
                        <!--div class="input-wrapper">
                            <input type="password" class="form-control"
                                   aria-describedby="signup-confirm-password-btn" id="signup-confirm-password"
                                   placeholder="{{ trans('messages.confirm password') }}" name="password_confirmation"
                                   required
                                   autocomplete="new-password">
                            <button class="btn" type="button" id="signup-confirm-password-btn">
                                <i class="fa-regular fa-eye" id="signup-confirm-eye-icon"></i>
                            </button>
                        </div>
                    </div-->
                    <!-- <div class="control-wrapper mb-3">
                            <label for="sinup-confirm-password"
                                   class="form-label">{{ trans('messages.Packages and offers') }}</label>
                            <div class="input-wrapper">
                                @if(!empty($packeds))
                        @foreach($packeds as $packed)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="package"
                                       id="{{$packed->id}}"
                                                   value="{{$packed->id}}" {{ old('package') == $packed->id ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{$packed->id}}">
                                                {{$packed->{'name_' . App::getLocale()} }}
                            </label>
                        </div>

                        @endforeach
                    @endif
                    </div>
                </div> -->
                    <button class="btn btn-block mt-4" style=" font-weight:700; font-size:20px"
                            type="submit">{{ trans('messages.Create new account') }}</button>
                </form>
                <!-- </div> -->
                <!-- @if($youtubeId != null)
                    <div class="col-md-3">
                        <iframe width="500" height="400" src="https://www.youtube.com/embed/{{$youtubeId}}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>

                        </iframe>

                    </div>

                @endif -->
            </div>
            <div class="row redirection-row mt-2" style="font-weight:900;padding: 0em 0.5em 1em 0.5em">
                <!-- <span style="font-size:1.2rem">{{ trans('messages.You have an account ?') }}</span>
                <a href="{{ route('login') }}">{{ trans('messages.Login') }}</a> -->
                <a class="login-txt d-inline-block w-100 btn bg-danger text-white" href="{{route('login')}}"
                             style="background-color:#1ba9ff40; border-radius:5px; padding:0.5rem; font-weight:700; font-size:20px">
                             {{ trans('messages.LoginLink') }}
                </a>
            </div>

        </div>
    </div>
</section>
<script src="{{ url('front_them/assets/js/popper.min.js') }}"></script>
<script src="{{ url('front_them/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('front_them/assets/js/jquery.min.js') }}"></script>
<script src="{{ url('front_them/assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ url('front_them/assets/js/index.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/ms-dropdown@4.0.3/dist/js/dd.min.js"></script>

</body>


</html>
