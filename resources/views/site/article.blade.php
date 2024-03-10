@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . $article->{'title_' . App::getLocale()} }}@stop
@section('content')
    <section class="container-fluid article-page-wrapper">
        <div class="container">
            <div class="row breadcrumb-row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('blog', $article->blogCategory->{'slug_' . App::getLocale()}) }}">{{ trans('messages.Blog') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $article->blogCategory->{'name_' . App::getLocale()} }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row article-wrapper mt-3 mb-5 ">
                <div class="col-lg-10 col-md-10 col-sm-12 article-content-wrapper">
                    <div class="article-card">
                        <div class="blog-img-wrapper">
                            <img src="{{ url($article->image) }}" alt="">

                        </div>
                        <div class="content-wrapper">
                            <div class="date">
                                <span>{{ time_elapsed_string(date('Y-m-d H:i', strtotime($article->created_at))) }}</span>
                            </div>
                            <h1 class="title">{{ $article->{'title_' . App::getLocale()} }}</h1>
                            <p class="desc">
                                {!! $article->{'body_' . App::getLocale()} !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 share-content-wrapper">
                    <div class="share-wrapper">
                        <p class="text">شارك الموضوع</p>
                        <ul class="links-list">
                            <div class="ss-box" data-ss-social="facebook, twitter, whatsapp, email, messenger"
                                data-ss-messenger="app_id: 123456" ss-responsive data-ss-content="false"></div>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row comments-wrapper mb-5 ">
                <div class="col-lg-10 col-md-10 col-sm-12 comments-content-wrapper">
                    @guest
                    @else
                        <div class="add-comment-wrapper">
                            {!! Form::open([
                                'route' => 'blogCommentStore',
                                'files' => true,
                                'id' => 'add-blog-comment-form',
                            ]) !!}
                            {!! Form::hidden('blog_id', $article->id, []) !!}
                            {!! Form::hidden('user_id', Auth::user()->id, []) !!}
                            <div class="mb-3">
                                <label for="comment" class="form-label">{{ trans('messages.Write your comment here') }}</label>
                                {!! Form::textarea('comment', null, [
                                    'id' => 'comment',
                                    'class' => 'form-control',
                                    'rows' => '3',
                                ]) !!}
                            </div>
                            <div class="btn-wrapper">
                                <button class="btn" type="submit">{{ trans('messages.Send') }}</button>
                            </div>
                            {!! Form::Close() !!}
                        </div>
                        <hr />
                    @endguest


                    <div class="comment-list" id="comment-list">
                        <p class="title">{{ trans('messages.Comments') }}</p>
                        @forelse ($article->comments as $comment)
                            <div class="comment">
                                <p class="name">{{ $comment->user->name }}</p>
                                <p class="date-time">
                                    {{ time_elapsed_string(date('Y-m-d H:i', strtotime($comment->created_at))) }}
                                </p>
                                <p class="comment-text">
                                    {{ $comment->comment }}
                                </p>
                            </div>
                        @empty
                            <div class="no-data">
                                <i class="fa-solid fa-comment-slash"></i>
                                <p>{{ trans('messages.There are no comments yet') }}</p>
                            </div>
                        @endforelse


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $('#add-blog-comment-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            if ($('#comment').val() == '') {
                $('#comment').css('border','2px solid red');
                setTimeout(() => {
                    $('#comment').css('border','2px solid #ccc');
                }, 2000);
            } else {
                $.ajax({
                    url: "{{ route('blogCommentStore') }}",
                    type: "POST",
                    data: formData,
                    success: function(msg) {
                        $('#comment').val('')
                        $.post(`{{ route('getBlogComments') }}`, {
                            _token: '{{ csrf_token() }}',
                            blog_id: {{ $article->id }}
                        }, function(data) {
                            $('#comment-list').html(data);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error)
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }

        });
    </script>
@endsection
