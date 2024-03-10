<header class="main-header">
    <div class="d-flex align-items-center logo-box justify-content-center">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
            <!-- logo-->
            <div class="logo-mini">
                <span class="light-logo"><img src="{{ url('front_them/assets/imgs/logo.png') }}" alt="logo"></span>
                <span class="dark-logo"><img src="{{ url('front_them/assets/imgs/logo.png') }}" alt="logo"></span>
            </div>
            <!-- logo-->
            <div class="logo-lg">
                <span class="light-logo"><img style="max-width: 86%;" src="{{ url('front_them/assets/imgs/logo.png') }}"
                        alt="logo"></span>
                <span class="dark-logo"><img style="max-width: 86%;" src="{{ url('front_them/assets/imgs/logo.png') }}"
                        alt="logo"></span>
            </div>
        </a>
    </div>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-10">
        <!-- Sidebar toggle button-->
        <div class="app-menu">
            <ul class="header-megamenu nav">
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link rounded push-btn" data-toggle="push-menu"
                        role="button">
                        <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span></span>
                    </a>
                </li>
                <li>
                    <h3><a href="{{ route('home') }}" target="blank">{{ trans('messages.Adnan Eltaher') }}</a></h3>
                </li>

            </ul>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                {{-- @if (App\Models\Setting::select('lang')->find(1)->lang == 'ar_nl') --}}
                    @if (App::getLocale() == 'ar')
                        <li class="dropdown notifications-menu">
                            <a href="javascript:void(0)" data-code="nl"
                                class="lang-change waves-effect waves-light dropdown-toggle">
                                <i class="flag-icon flag-icon-nl"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </a>
                        </li>
                    @else
                        <li class="dropdown notifications-menu">
                            <a href="javascript:void(0)" data-code="ar"
                                class="lang-change waves-effect waves-light dropdown-toggle">
                                <i class="flag-icon flag-icon-iq"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </a>
                        </li>
                    @endif
                {{-- @endif --}}


                <!-- User Account-->
                <li class="dropdown user user-menu">
                    <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
                        title="User">
                        <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i>
                                {{ Auth::user()->name }}</a>

                            <a class="dropdown-item" href="{{ route('setting.index') }}"><i
                                    class="ti-settings text-muted mr-2"></i>
                                {{ trans('messages.Settings') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <i class="ti-lock text-muted mr-2"></i> {{ trans('messages.Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
