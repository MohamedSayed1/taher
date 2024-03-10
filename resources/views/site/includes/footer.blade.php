@php
    $footer_data = App\Models\Setting::select('footer_desc_' . App::getLocale() . ' as footer_desc', 'address_' . App::getLocale() . ' as address', 'main_phone', 'secoundry_phone', 'email', 'facebook', 'tweeter', 'whatsapp', 'youyube', 'lat', 'lon')->find(1);
@endphp
@if(Request::is('start-exam/*'))
<style>
@media (max-width:576px) {
.none_footer {
display: none !important;
}
}
</style>
@endif
<footer class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-3 col-sm-12 info-wrapper">
                <img src="{{ url('front_them/assets/imgs/logo.png') }}" alt="" class="logo">
                <p class="desc">
                    {{ $footer_data->footer_desc }}
                </p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 links-wrapper">
                <a href="{{ route('packages') }}" class="link">
                    @if (App::getLocale() == 'ar')
                        <i class="fa-solid fa-angles-left"></i>
                    @else
                        <i class="fa-solid fa-angles-right"></i>
                    @endif
                    <span>{{ trans('messages.Packages and offers') }}</span>
                </a>
                <a href="{{ route('faq') }}" class="link">
                    @if (App::getLocale() == 'ar')
                        <i class="fa-solid fa-angles-left"></i>
                    @else
                        <i class="fa-solid fa-angles-right"></i>
                    @endif
                    <span>{{ trans('messages.FAQ') }}</span>
                </a>
                @php
                    $aBlogs = App\Models\BlogCategory::orderBy('arrangement', 'ASC')->first();
                @endphp
                <a href="{{ route('blog', $aBlogs->{'slug_' . App::getLocale()} ? $aBlogs->{'slug_' . App::getLocale()} : $aBlogs->slug_ar) }}"
                    class="link">
                    @if (App::getLocale() == 'ar')
                        <i class="fa-solid fa-angles-left"></i>
                    @else
                        <i class="fa-solid fa-angles-right"></i>
                    @endif
                    <span>{{ trans('messages.Blog') }}</span>
                </a>
                <a href="{{ route('contactUs') }}" class="link">
                    @if (App::getLocale() == 'ar')
                        <i class="fa-solid fa-angles-left"></i>
                    @else
                        <i class="fa-solid fa-angles-right"></i>
                    @endif
                    <span>{{ trans('messages.Contact us') }}</span>
                </a>
                @foreach (App\Models\Page::where('enabel', true)->get() as $page)
                    <a href="{{ url('/', [$page->{'slug_' . App::getLocale()}]) }}" class="link">
                        @if (App::getLocale() == 'ar')
                            <i class="fa-solid fa-angles-left"></i>
                        @else
                            <i class="fa-solid fa-angles-right"></i>
                        @endif
                        <span>{{ $page->{'title_' . App::getLocale()} }}</span>
                    </a>
                @endforeach
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 contact-info-wrapper">
                <div class="info-item">
                    <i class="fa-solid fa-phone"></i>
                    <a href="tel:{{ $footer_data->main_phone }}">{{ $footer_data->main_phone }}</a> -
                    <a href="tel:{{ $footer_data->secoundry_phone }}">{{ $footer_data->secoundry_phone }}</a>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-envelope"></i>
                    <a href="mailto:mail@email.com">{{ $footer_data->email }}</a>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <span> {{ $footer_data->address }}</span>
                </div>
            </div>
        </div>
        <div class="row copyrights-row">
            <div class="col-lg-6 col-md-6 col-sm-12 social-links">
                <a href="{{ $footer_data->facebook }}" class="social-link" target="blank"><i
                        class="fa-brands fa-facebook-f"></i></a>
                <a href="{{ $footer_data->youyube }}" class="social-link" target="blank"><i
                        class="fa-brands fa-youtube"></i></a>
                <a href="{{ 'https://www.google.com/maps/@' . $footer_data->lat . ',' . $footer_data->lon . ',15z' }}"
                    class="social-link" target="blank"><i class="fa-solid fa-location-dot"></i></a>
                <a href="{{ $footer_data->whatsapp }}" class="social-link" target="blank"><i
                        class="fa-brands fa-whatsapp"></i></a>
            </div>

        </div>
    </div>
</footer>
