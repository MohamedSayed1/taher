@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Videos') }}@stop
@section('content')
    <section class="container-fluid theory-package-wrapper">
        <div class="container">
            <div class="row top-row text-center">
                <h1 class="title">{{ trans('messages.Videos') }}</h1>
            </div>
            <div class="all-videos mt-4">
                <div class="row">
                    @foreach ($videos as $video)
                        <div class="col-md-3 video-card-content mb-3">
                            <div class="video-card-container"
                                onclick="openViedioModel('{{ $video->video_type }}','{{ $video->video_link_id }}','{{ $video->{'title_' . App::getLocale()} }}','{{ $video->{'description_' . App::getLocale()} }}')">
                                <div class="video-card">
                                    {{-- <img src="http://img.youtube.com/vi/{{ $video->video_link_id }}/mqdefault.jpg"
                                        class="video-img w-100" alt=""> --}}
                                    <img src="{{ $video->image ? url($video->image) : '' }}" class="video-img w-100"
                                        alt="">
                                    <div class="video-info">
                                        <h4>{{ $video->{'title_' . App::getLocale()} }}</h4>
                                        @php
                                            $descLen = strlen($video->{'description_' . App::getLocale()});
                                        @endphp
                                        {{-- <h3>{{ $descLen }}</h3> --}}
                                        @if ($descLen > 160)
                                            <p>{{ substr($video->{'description_' . App::getLocale()}, 0, 160) }}...</p>
                                        @else
                                            <p>{{ $video->{'description_' . App::getLocale()} }} </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <div class="modal fade bd-example-modal-lg play-video-modal" id="play-video" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="close-btn">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="all: unset; font-size: 1.5em; color: #1ba9ff;cursor: pointer;padding: .5em">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="content">
                        <h3 class="text-center" id="play-video-title"></h3>
                        <br>
                        <hr>
                        <br>
                        <div id="play-video-content">

                        </div>
                        <p class="text-center" id="play-video-desc"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function openViedioModel(video_type, video_link_id, title, description) {
            if (video_type == 'youtube') {
                $('#play-video-content').html(
                    `<iframe width="660" height="415" src="https://www.youtube.com/embed/${video_link_id}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>`
                );
            } else if (video_type == 'tiktok') {
                $.post(`{{ route('tiktok.getModelData') }}`, {
                        _token: '{{ csrf_token() }}',
                        id: video_link_id
                    },
                    function(data) {
                        $('#play-video-content').html(data);
                    });
            } else if (video_type == 'instagram') {
                $.post(`{{ route('instagram.getInstagramModelData') }}`, {
                        _token: '{{ csrf_token() }}',
                        id: video_link_id
                    },
                    function(data) {
                        $('#play-video-content').html(data);
                    });
            }

            $('#play-video-title').text(title)
            $('#play-video-desc').text(description)
            $('#play-video').modal('show');
        }

        $('#play-video').on('hidden.bs.modal', function() {
            $('#play-video-content').html('');
        })
    </script>
@endsection
