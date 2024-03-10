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
</style>
<body>
<nav>
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ url('front_them/assets/imgs/small-logo.png') }}" alt="">
        </a>
        <div class="adnan-txt text-center" style="color:#1ba9ff; font-size:30px; font-weight:700;">
            <span class="d-block">Adnan Eltaher</span>
            <span class="d-block">عدنان الطاهر</span>
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
        <div class="col-lg-4 col-md-6 col-sm-12 singup-form-wrapper">

            <div class="row">

                <form method="POST" action="{{ route('purchasePackage') }}">
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
                                                    <input type="radio" id="{{$packed->id}}"
                                                           name="package"  class="form-check-input"
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
                                <option data-image="{{ $method->image->svg }}" value="{{ $method->id }}">{{ $method->description }}</option>
                            @endforeach
                        </select>
                        @error('payment')
                        <small class="error text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <button class="btn btn-block mt-4"
                            type="submit">{{ trans('messages.voltooi') }}</button>
                </form>

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
<script type="text/javascript">
    $('#register-user-form').submit(function (event) {
        var emailone = $('#sinup-email').val();
        var emailtwo = $('#sinup-email-verified').val();
        if (emailone != emailtwo) {
            event.preventDefault();
            $('#verify-email-alert').show();
            setTimeout(() => {
                $('#verify-email-alert').hide();
            }, 2000);
        }
    });
</script>
</body>


</html>
