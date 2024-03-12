@if( Request::is('/'))
<div class="container nav-bar-container pt-2">
    <nav class="pc-navbar d-flex flex-wrap align-items-center justify-content-lg-start navbar navbar-expand-lg">
        <a href="{{ route('home') }}" class="d-flex logo align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
            <img src="{{ url('front_them/assets/imgs/small-logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav col-12 col-lg-auto ms-lg-auto mb-2 justify-content-center mb-md-0">
                <!--li><a href="{{ route('home') }}"
                        class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}  px-3 pb-0 link-dark">{{ trans('messages.Home') }}</a>
                </li-->
                <!--li><a href="{{ route('packages') }}"
                        class="nav-link {{ Route::currentRouteName() == 'packages' ? 'active' : '' }} px-3 pb-0 link-dark">{{ trans('messages.Packages and offers') }}</a>
                </li-->

                <li><a href="{{ route('contactUs') }}"
                       class="nav-link {{ Route::currentRouteName() == 'contactUs' ? 'active' : '' }} px-3 pb-0 link-dark">{{ trans('messages.Contact us') }}</a>
                </li>
                <li><a href="{{ route('theoryPackages') }}"
                        class="nav-link {{ Route::currentRouteName() == 'theoryPackages' ? 'active' : '' }} px-3 pb-0 link-dark">{{ trans('messages.Theory Packages') }}</a>
                </li>
                <li><a href="{{ route('exams') }}"
                        class="nav-link {{ Route::currentRouteName() == 'exams' ? 'active' : '' }} px-3 pb-0 link-dark">{{ trans('messages.Exams') }}</a>
                </li>
                @php
                    //$aBlogs = App\Models\BlogCategory::orderBy('arrangement', 'ASC')->first();
                @endphp
                <!--li><a href="{{ route('blog', $aBlogs->{'slug_' . App::getLocale()} ? $aBlogs->{'slug_' . App::getLocale()} : $aBlogs->slug_ar) }}"
                        class="nav-link {{ Route::currentRouteName() == 'blog' || Route::currentRouteName() == 'article' ? 'active' : '' }} px-3 pb-0 link-dark">{{ trans('messages.Blog') }}</a>
                </li-->
            </ul>
            <!--div class="btns-wrapper text-end d-flex justify-content-between align-items-center">
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn login-btn mx-2">{{ trans('messages.Login') }}</a>
                    @endif
                @else
                    <a href="#" class="link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ trans('messages.My account') }}
                    </a>
                    <ul class="dropdown-menu text-small  mx-2">
                        <li><a class="dropdown-item" href="{{ route('account') }}">{{ Auth::user()->name }}</a></li>
                        <li><a id="logout-click-button" class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ trans('messages.Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                @endguest
            </div-->
            <div class="nav-btns">

                @if(Auth()->check())

                    <a id="logout-click-button" class="btn bg-danger" style="color:white" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ trans('messages.Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a href="{{route('register')}}" class="btn bg-primary" style="color:white">
                        {{ trans('messages.buy') }}
                    </a>
                    <a id="logout-click-button" class="btn bg-danger" style="color:white" href="{{ route('login') }}"
                       >{{ trans('messages.Login') }}
                    </a>

                    @endif
            </div>

        </div>
    </nav>
</div>
@else
<nav class="pc-navbar">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ url('front_them/assets/imgs/small-logo.png') }}" alt="">
        </a>
        <div class="adnan-txt text-center" style="color:#1ba9ff; font-size:30px; font-weight:700;">
            <span class="d-block">عدنان الطاهر - Adnaan Altaher</span>
        </div>
        <a href="{{ url()->previous() }}" class="back text-center d-block" style="cursor:pointer;text-decoration:none">
            <img src="{{ url('front_them/assets/imgs/back-arrow.png') }}" alt="" style="width:70px; height:70px">
            <span class="d-block txt" style="color:#1ba9ff; font-size:22px; font-weight:700">
              {{__('messages.Back')}}
                </span>
        </a>
    </div>
</nav>
@endif
