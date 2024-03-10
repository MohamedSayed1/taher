@forelse ($blogs as $blog)
    <div class="col-lg-4 col-md-4 col-sm-12 wrapper animate__animated animate__fadeInUp">
        <div class="news-card card">
            <div class="blog-img-wrapper">
                <img src="{{ url($blog->image) }}" alt="">
                <div class="date">
                    <span>{{ time_elapsed_string(date('Y-m-d H:i', strtotime($blog->created_at))) }}</span>
                </div>
            </div>
            <div class="content-wrapper">
                <h5 class="title">{{ $blog->{'title_' . App::getLocale()} }}</h5>
                <p class="desc">
                    {{ $blog->{'description_' . App::getLocale()} }}
                </p>
            </div>
            <a class="btn" href="{{ route('article', $blog->{'slug_' . App::getLocale()}) }}">
                <span>{{ trans('messages.Read more') }}</span>
                @if (App::getLocale() == 'ar')
                    <i class="fa-solid fa-angles-left"></i>
                @else
                    <i class="fa-solid fa-angles-right"></i>
                @endif
            </a>
        </div>
    </div>
@empty
@endforelse
