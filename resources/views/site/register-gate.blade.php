@extends('site.layouts.main')
@section('meta_title')
    {{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Home') }}
@stop
@section('content')
    <div class="register-gate my-5" style="overflow:hidden">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-md-10">
                <div class="row gx-2 mb-4 align-items-stretch px-3">
                    <div class="col-6">
                        <a class="login-txt d-inline-block w-100 btn bg-danger text-white" href="{{route('login')}}"
                             style="background-color:#1ba9ff40; border-radius:10px; padding:1rem; font-weight:700; font-size:20px">
                             {{ trans('messages.LoginLink') }}
                        </a>
                    </div>
                    <div class="col-6">
                        <a class="register-txt d-inline-block w-100 btn bg-primary text-white" href="{{route('register')}}"
                             style="background-color:#71ff5d40; border-radius:10px; padding:1rem; font-weight:700; font-size:20px">
                                {{ trans('messages.RegisterLink') }}
                        </a>
                    </div>
                </div>
                <!--div class="row">
                    <div class="col-12">
                        <a style="text-decoration:none" href="{{ route('password.request') }}">
                            <p class="alert alert-danger text-center">{{ trans('messages.PasswordLink') }}</p>
                        </a>
                    </div>
                </div-->
                <div class="row justify-content-center">
                    <div class="col-xxl-5 col-md-10">
                        <div class="video-content text-center">
                            @if($youtubeId != null)
                            <span class="mb-3 d-block">{{ trans('messages.video_text') }}</span>

                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$youtubeId}}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen>

                                </iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
