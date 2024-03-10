@extends('site.layouts.main')
@section('meta_title')
    {{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Home') }}
@stop
@section('content')

    <div class="register-gate my-5" style="overflow:hidden">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-md-10">
                <div class="row gx-5 mb-4">
                    <div class="col-6">
                        <div class="register-txt"
                             style="background-color:#1ba9ff40; border:1px solid #1ba9ff; border-radius:10px; padding:1rem">
                            <a style="text-decoration:none" href="{{route('login')}}">
                                <span>{{ trans('messages.LoginLink') }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="login-txt"
                             style="background-color:#71ff5d40; border:1px solid #00b81e; border-radius:10px; padding:1rem">
                            <a style="text-decoration:none" href="{{route('register')}}">
                                <span>{{ trans('messages.RegisterLink') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a style="text-decoration:none" href="{{ route('password.request') }}">
                            <p class="alert alert-danger text-center">{{ trans('messages.PasswordLink') }}</p>
                        </a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xxl-5 col-md-10">
                        <div class="video-content text-center">
                            <span class="mb-3 d-block">{{ trans('messages.video_text') }}</span>
                            @if($youtubeId != null)
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
