@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Account') }}@stop
@section('content')
    <section class="container-fluid account-page-wrapper">
        <div class="container">
            <div class="row title-row mb-5 text-center">
                <h1 class=" title ">{{ Auth::user()->name }}</h1>
            </div>
            <div class="row mt-3 mb-5">
                <div class="col-lg-10 col-md-12 col-sm-12 nav-links-wrapper m-auto">
                    <nav class="nav nav-pills flex-column flex-sm-row">
                        <a class="flex-sm-fill text-sm-center nav-link active" id="personal-info">
                            <i class="fa-regular fa-address-card"></i> <span>{{ trans('messages.Personal Info') }}</span>
                        </a>
                        <a class="flex-sm-fill text-sm-center nav-link" id="personal-sub">
                            <i class="fa-solid fa-id-card-clip"></i> <span>{{ trans('messages.Subscribtions') }}</span>
                        </a>
                        <a class="flex-sm-fill text-sm-center nav-link" id="personal-password">
                            <i class="fa-solid fa-lock"></i>
                            <span>{{ trans('messages.Change password') }}</span>
                        </a>
                    </nav>
                </div>
            </div>
            <div class="row personal-info mt-2" id="personal-info-wrapper">
                <div class="col-lg-6 col-md-10 col-sm-12 info-card-wrapper m-auto">
                    <div class="item">
                        <span class="head">{{ trans('messages.Username') }} : </span>
                        <span class="data">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="item">
                        <span class="head">{{ trans('messages.Email') }} : </span>
                        <span class="data">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="item">
                        <span class="head">{{ trans('messages.Subscribed since') }}: </span>
                        <span
                            class="data">{{ time_elapsed_string(date('Y-m-d H:i', strtotime(Auth::user()->created_at))) }}</span>
                    </div>
                </div>
                <div class="col-12 btn-wrapper mt-5">
                    <a class=" btn logout " href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ trans('messages.Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="row change-password mt-2" id="personal-password-wrapper">
                <div class="col-lg-6 col-md-10 col-sm-12 password-card-wrapper m-auto">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    {!! Form::open(['route' => 'password.change']) !!}
                    <div class="control-wrapper mb-3">
                        <label for="change-current-password"
                            class="form-label">{{ trans('messages.Old Password') }}</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-control" aria-describedby="change-current-password-eye-btn"
                                id="change-current-password" placeholder="******" name="current_password" required>
                            <button class="btn" type="button" id="change-current-password-btn">
                                <i class="fa-regular fa-eye" id="change-current-password-icon"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <small class="error text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="control-wrapper mb-3">
                        <label for="change-new-password" class="form-label">{{ trans('messages.New Password') }}</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-control" aria-describedby="change-new-password-eye-btn"
                                id="change-new-password" placeholder="******" name="new_password" required>
                            <button class="btn" type="button" id="change-new-password-btn">
                                <i class="fa-regular fa-eye" id="change-new-password-icon"></i>
                            </button>
                        </div>
                        @error('new_password')
                            <small class="error text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="control-wrapper mb-3">
                        <label for="change-confirm-password"
                            class="form-label">{{ trans('messages.confirm password') }}</label>
                        <div class="input-wrapper">
                            <input type="password" class="form-control" aria-describedby="change-confirm-password-btn"
                                id="change-confirm-password" placeholder="******" name="new_password_confirmation" required>
                            <button class="btn" type="button" id="change-confirm-password-btn">
                                <i class="fa-regular fa-eye" id="change-confirm-password-icon"></i>
                            </button>
                        </div>
                        @error('new_password_confirmation')
                            <small class="error text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-block mt-4" type="submit">{{ trans('messages.Reset Password') }}</button>
                    {!! Form::Close() !!}
                </div>
            </div>
            <div class="row subscriptions mt-2" id="personal-sub-wrapper">
                <div class="col-lg-6 col-md-10 col-sm-12 subscriptions-card-wrapper m-auto">
                    <div class="row sub-head-row">
                        <h3>{{ trans('messages.Current subscribtions') }}</h3>
                    </div>

                    @forelse ($current_subscriptions as $subscription)
                        <div class="row sub-row">
                            <div class="col-12 sub-item">
                                <div class="package-data">
                                    <h5>{{ $subscription->package->{'name_' . App::getLocale()} }}</h5>
                                    <span class="price">{{ $subscription->price - $subscription->offer_discount }}
                                        €</span>
                                    @if ($subscription->renewed_times > 0)
                                        <hr>
                                        <span>{{ trans('messages.Renewed ') . $subscription->renewed_times . trans('messages. Times') }}</span>
                                    @endif
                                </div>
                                <div class="sub-btn">
                                    <button
                                        class="btn">{{ trans('messages.Remaining ') . now()->diffInDays(\Carbon\Carbon::parse($subscription->expiration_date)) . trans('messages. Day') }}</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="row no-sub-row">
                            <img src="/assets/imgs/no-sub-image.png" alt="">
                            <p class="text">{{ trans('messages.There are no current subscriptions') }}</p>
                        </div>
                    @endforelse

                    <div class="row sub-head-row mt-5">
                        <h3>{{ trans('messages.previous subscriptions') }}</h3>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger" style="margin-bottom: 3em">
                            {{ session('error') }}
                        </div>
                    @endif
                    @forelse ($previous_subscriptions as $subscription)
                        <div class="row sub-row">
                            @if (session('error1'))
                                <div class="alert alert-danger" style="margin-bottom: 3em">
                                    {{ session('error1') }}
                                </div>
                            @endif
                            @if (session('success1'))
                                <div class="alert alert-success" style="margin-bottom: 3em">
                                    {{ session('success1') }}
                                </div>
                            @endif
                            <div class="col-12 sub-item">
                                <div class="package-data">
                                    <h5>{{ $subscription->package->{'name_' . App::getLocale()} }}</h5>
                                    <span class="price">{{ $subscription->price - $subscription->offer_discount }}
                                        €</span>
                                    <hr>
                                    <span>{{ trans('messages.Expired from ') . now()->diffInDays(\Carbon\Carbon::parse($subscription->expiration_date)) . trans('messages. Day') }}</span>
                                </div>
                                <div class="sub-btn">
                                    @if ($subscription->offer_id != null)
                                        <a class="btn"
                                            href="{{ route('purchasePackage', ['offer', $subscription->offer_id]) }}">{{ trans('messages.Renew') }}</a>
                                    @else
                                        <a href="{{ route('purchasePackage', ['package', $subscription->package_id]) }}"
                                            class="btn">{{ trans('messages.Renew') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="row no-sub-row">
                            <img src="/assets/imgs/no-sub-image.png" alt="">
                            <p class="text">{{ trans('messages.There are no previous subscriptions') }}</p>
                        </div>
                    @endforelse


                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    @if (session('error') || session('success'))
        <script type="text/javascript">
            $('#personal-info').removeClass('active');
            $('#personal-password').addClass('active');
            $('#personal-info-wrapper').hide();
            $('#personal-password-wrapper').show();
        </script>
    @endif

    @if (session('error1') || session('success1'))
        <script type="text/javascript">
            $('.nav-link').removeClass('active');
            $('#personal-sub').addClass('active');
            $('#personal-info-wrapper').hide();
            $('#personal-sub-wrapper').show();
        </script>
    @endif
@endsection
