@extends('site.layouts.main')
@section('meta_title'){{ trans('messages.Adnan Eltaher') . ' | ' . trans('messages.Exams') }}@stop
@section('content')
@php
    $header_data = App\Models\Setting::select('test_exam_id', 'home_title_' . App::getLocale() . ' as home_title', 'home_description_' . App::getLocale() . ' as home_description')->find(1);
    $packages = App\Models\Package::where([['show_in_home', true],['active',1]])
        ->orderBy('arrangement', 'ASC')
        ->with([
            'offer' => function ($offer) {
                $offer->whereDate('end_date', '>', now())->whereDate('start_date', '<', now());
            },
        ])
        ->latest()
        ->take(3)
        ->get();
    $langAndDefaultLang = App\Models\Setting::select('default_lang', 'lang_ar', 'lang_en', 'lang_nl')->find(1);
    $moreThanOneLang = 0;
    if ($langAndDefaultLang->lang_ar == true) {
        $moreThanOneLang++;
    }
    if ($langAndDefaultLang->lang_en == true) {
        $moreThanOneLang++;
    }
    if ($langAndDefaultLang->lang_nl == true) {
        $moreThanOneLang++;
    }

@endphp
    <style>


        .lock_exam .actions .btn {
            display: none;
        }

        .form-check-input, .form-check-input + label {
            cursor: pointer;
        }

        .btn, .lang-btn, .test-long-wrapper{
            transition:0.4s all ease;
        }

        .btn:hover{
            transform: scale(1.1)
        }

        .lang-btn:hover {
            letter-spacing: 1.5px;
        }

        .test-long-wrapper:hover {
             border:1px solid transparent!important;
             background:#1ba9ff !important;
             color:white !important;
             cursor: pointer;
        }

        .test-long-wrapper:hover p, .test-long-wrapper:hover span{
             color:white !important;
        }

    </style>
    <section class="container-fluid tests-page-wrapper">
        <div class="container">
            <div class="row title-row mb-5 text-center">
                <h1 class=" title " style="color:black">{{ trans('messages.Theory driving tests') }}</h1>
                <p class="desc">
                    {{ $setting->exam_header_description }}
                </p>
                <div class="col-12 text-center mb-5">
                @if ($moreThanOneLang > 1)
                        <div class="row lang-container mx-5 home-header-chang-lang">
                            @if ($langAndDefaultLang->lang_ar == true)
                                <a  href="javascript:void(0)" data-code="ar" class="lang-change lang-btn" style="color:black; border:2px solid grey; border-radius:10px; margin-inline-end:5px">
                                    <input class="form-check-input" type="radio" name="lang" id="arabicLang" {{App::getLocale() == 'ar'?"checked":""}}>
                                    <label for="arabicLang">العربية</label>
                                </a>
                            @endif
                            @if ($langAndDefaultLang->lang_en == true)
                                <a href="javascript:void(0)" data-code="en" class="lang-change lang-btn" style="color:black; border:2px solid grey; border-radius:10px;; margin-inline-end:5px">
                                    <input class="form-check-input" type="radio" name="lang" id="englishLang" {{App::getLocale() == 'en'?"checked":""}}>
                                    <label for="englishLang">English</label>
                                </a>
                            @endif
                            @if ($langAndDefaultLang->lang_nl == true)
                                <a href="javascript:void(0)" data-code="nl" class="lang-change lang-btn" style="color:black; border:2px solid grey; border-radius:10px; margin-inline-end:5px">
                                    <input class="form-check-input" type="radio" name="lang" id="netherLang" {{App::getLocale() == 'nl'?"checked":""}}>
                                    <label for="netherLang">Nederlands</label>
                                </a>
                            @endif
                        </div>
                @endif
            </div>
                @guest
                @else
                    <div class="progress-card">
                        <div class="progress-wrapper">
                            <span class="progress-amount">%100</span>
                            <img src="{{ url('front_them/assets/imgs/progress-img.png') }}" alt="">
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#progress-modal">
                                {{ trans('messages.See your progress here') }}
                            </button>
                        </div>

                    </div>
                @endguest
            </div>
            <!-- <div class="row mt-3 mb-5 info-row ">
                <div class="texts-section-wrapper">
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#symbols-modal">
                        <i class="fa-solid fa-circle-question"></i>
                        <span>{{ trans('messages.The meaning of the symbols') }}</span>
                    </button>
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#test-info-modal">
                        <i class="fa-solid fa-circle-info"></i>
                        <span>{{ trans('messages.Information about the theory test') }}</span>
                    </button>
                    @guest
                    @else
                        {{-- <button class="btn" data-bs-toggle="modal" data-bs-target="#settings-modal">
                            <i class="fa-solid fa-gear"></i> <span>{{ trans('messages.Settings') }}</span>
                        </button> --}}
                    @endguest

                </div>
                <div class="layout-section">
                    <button class="btn" id="grid-btn">
                        <img src="{{ url('front_them/assets/imgs/grid.png') }}" alt="">
                    </button>
                    <button class="btn" id="lines-btn">
                        <img src="{{ url('front_them/assets/imgs/lines.png') }}" alt="">
                    </button>
                </div>
            </div> -->
            @if (session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row tests-cards-wrapper">
                @forelse ($exams as $exam)
                    @php
                        $lock_exam = true;
                        if (Auth::check()) {
                            foreach ($exam->packages as $key => $value) {
                                foreach (Auth::user()->subscriptions as $key2 => $value2) {
                                    if ($value2->package_id == $value->id) {
                                        $lock_exam = false;
                                    }
                                }
                            }
                            if (App\Models\Setting::select('test_exam_id')->find(1)->test_exam_id == $exam->id) {
                                $lock_exam = false;
                            }
                        } elseif (App\Models\Setting::select('test_exam_id')->find(1)->test_exam_id == $exam->id) {
                            $lock_exam = false;
                        }
                    @endphp

                    <div class="col-lg-4 col-md-6 col-sm-12 test-card" onclick="gotExam('{{ $lock_exam == true ? route('packages', $exam->id) : route('examInfo', $exam->id) }}')">
                        <label for="exam-1" class="test-long-wrapper  {{ $lock_exam == true ? 'lock_exam' : '' }}" style="background-color: #e7f6ff; border:1px solid #6bbafd;">
                            <a href="{{ $lock_exam == true ? route('packages', $exam->id) : route('examInfo', $exam->id) }}"
                                class="info" style="text-decoration: none">
                                {{-- <img src="{{ url('front_them/assets/imgs/test-icon-1.png') }}" alt=""> --}}
                                <p class="name">{{ $exam->{'name_' . App::getLocale()} }}</p>
                                @if (App\Models\Setting::select('test_exam_id')->find(1)->test_exam_id == $exam->id)
                                    (<span style="color: red;font-size: small">{{ trans('messages.test') }}</span>)
                                @else
                                @endif
                            </a>
                            <div class="actions">
                                @if ($lock_exam == true)
                                    <img style="width: 30px" src="{{ url('front_them/assets/imgs/padlock.png') }}"
                                        alt="">
                                @endif

                                @guest
                                @else
                                    <!--div class="btn" onclick="getExamHistory({{ $exam->id }})">
                                        <img src="{{ url('front_them/assets/imgs/repeate-icon.png') }}" alt="">
                                    </div-->
                                @endguest

                                <!-- <div class="btn info-btn" onclick="openExamInfoModel({{ $exam->id }})">
                                    <img src="{{ url('front_them/assets/imgs/info-icon.png') }}" alt="">
                                </div> -->
                            </div>
                            @if(Auth()->check())
                                <input type="radio" name="exam-1" id="exam-1" {{in_array($exam->id,$done)?"checked":""}}  >
                            @else
                                <input type="radio" name="exam-1" id="exam-1">
                            @endif
                        </label>
                    </div>

                @empty
                    <h3>{{ trans('messages.No Exams') }}</h3>
                @endforelse

            </div>
        </div>
    </section>
    <!-- Symbols Modal -->
    <div class="modal fade symbols-modal" id="symbols-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-btn">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="all: unset; font-size: 1.5em; color: #1ba9ff;cursor: pointer;padding: .5em">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="head">
                        <i class="fa-solid fa-circle-question"></i>
                        <h2 class="title">{{ trans('messages.The meaning of the symbols') }}</h2>
                    </div>
                    <div class="content">
                        <div class="accordion" id="accordionExample">
                            @forelse ($sympol as $key => $symp)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $key }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $key }}" aria-expanded="true"
                                            aria-controls="collapse{{ $key }}">
                                            <img src="{{ url('front_them/assets/imgs/symbols-icon-1.png') }}"
                                                alt="">
                                            <span>{{ $symp->{'question_' . App::getLocale()} }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $key }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {!! $symp->{'answer_' . App::getLocale()} !!}</div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        <div class="btn-row">
                            <button class="btn"
                                data-bs-dismiss="modal">{{ trans('messages.Back to the tests') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Modal -->
    <div class="modal fade exam-info-modal" id="exam-info-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-btn">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="all: unset; font-size: 1.5em; color: #1ba9ff;cursor: pointer;padding: .5em">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="head">
                        <h2 class="title text-center">{{ trans('messages.Exam Info') }}</h2>
                        <br>
                        <hr>
                        <br>
                    </div>
                    <div class="content">
                        <p class="desc" id="examinfop">

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Test Info Modal -->
    <div class="modal fade test-info-modal" id="test-info-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-btn">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="all: unset; font-size: 1.5em; color: #1ba9ff;cursor: pointer;padding: .5em">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="head">
                        <i class="fa-solid fa-circle-info"></i>
                        <h2 class="title">{{ trans('messages.Information about the theory test') }}</h2>
                    </div>
                    <div class="content">
                        <div class="accordion" id="accordionExample">

                            @forelse ($theory_info as $key => $theory_in)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $key }}">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}"
                                            aria-expanded="true" aria-controls="collapse{{ $key }}">
                                            <img src="{{ url('front_them/assets/imgs/symbols-icon-1.png') }}"
                                                alt="">
                                            <span>{{ $theory_in->{'question_' . App::getLocale()} }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $key }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {!! $theory_in->{'answer_' . App::getLocale()} !!}</div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Modal -->
    <div class="modal fade test-history-modal" id="test-history-modal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-btn">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="all: unset; font-size: 1.5em; color: #1ba9ff;cursor: pointer;padding: .5em">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="head">
                        <img src="{{ url('front_them/assets/imgs/test-history-icon.png') }}" alt="">
                        <h2 class="title">{{ trans('messages.Record your previous exams') }}</h2>
                    </div>
                    <div class="content" id="test-history-modal-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Settings Modal -->
    @guest
    @else
        <!-- Progress Modal -->
        <div class="modal fade progress-modal" id="progress-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-btn">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            style="all: unset; font-size: 1.5em; color: #1ba9ff;cursor: pointer;padding: .5em">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="head">
                            <img src="{{ url('front_them/assets/imgs/track-progress-img.png') }}" alt="">
                            <h2 class="title">{{ trans('messages.Your progress in the tests') }}</h2>
                            <p class="desc">
                                {{ trans('messages.The more correct answers, the higher the progress') }}</p>
                        </div>
                        <div class="content">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <th scope="col">
                                            <i class="fa-solid fa-book-open"></i>
                                            <span>{{ trans('messages.Test subject') }}</span>
                                        </th>
                                        <th scope="col">
                                            <i class="fa-solid fa-file"></i>
                                            <span>{{ trans('messages.The result') }}</span>
                                        </th>
                                        <th scope="col">
                                            <i class="fa-solid fa-chart-line"></i>
                                            <span>{{ trans('messages.progress') }}</span>
                                        </th>
                                    </thead>
                                    <tbody>
                                        @forelse ($results as $item)
                                            <tr>
                                                <td scope="row">{{ $item->exam->{'name_' . App::getLocale()} }}</td>
                                                <td>{{ $item->score }}</td>
                                                <td>
                                                    <div class="progress" style="height: 20px;">
                                                        <div class="progress-bar" role="progressbar"
                                                            aria-label="Example with label"
                                                            style="width: {{ $item->score }}%;"
                                                            aria-valuenow="{{ $item->score }}" aria-valuemin="0"
                                                            aria-valuemax="100">{{ $item->score }}%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse



                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="modal fade settings-modal" id="settings-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-btn">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            style="all: unset; font-size: 1.5em; color: #1ba9ff;cursor: pointer;padding: .5em">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="head">
                            <img src="{{ url('front_them/assets/imgs/settings-img.png') }}" alt="">
                            <h2 class="title">الإعدادات</h2>
                        </div>
                        <div class="content">
                            {!! Form::open(['route' => 'examSetting']) !!}
                            <div class="boxes-wrapper">
                                <div class="box move">
                                    <p>انتقل إلى التالى تلقائيا</p>
                                    <label class="toggle-control">
                                        <input type="checkbox" {{ Auth::user()->question_auto_move == 1 ? 'checked' : '' }}
                                            name="question_auto_move">
                                        <span class="control"></span>
                                    </label>
                                </div>
                                <div class="box sound">
                                    <p>الصوت</p>
                                    <label class="toggle-control">
                                        <input type="checkbox" {{ Auth::user()->enabel_sound == 1 ? 'checked' : '' }}
                                            name="enabel_sound">
                                        <span class="control"></span>
                                    </label>
                                </div>

                            </div>
                            <div class="info-wrapper mt-3 mb-3">
                                <p>
                                    <strong>الإنتقال إلى التالى تلقائيا:
                                    </strong> انتقل تلقائيًا إلى السؤال التالي عند الأختيار
                                </p>

                            </div>
                            <div class="btn-row">
                                <button class="btn" type="submit">
                                    <span>حفظ التعديلات</span>
                                </button>
                            </div>
                            {!! Form::Close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    @endguest
@endsection

@section('script')
    <script type="text/javascript">
        function gotExam(url)
        {
            window.location.href = url;
        }

        // $('.lock_exam').click(function() {
        //     return false;
        // });
        $('.test-history-modal').click(function() {
            $('#test-history-modal').modal('show');
        })

        function openExamInfoModel(id) {
            $.post(`{{ route('exam.getInfo') }}`, {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                function(data) {
                    $('#examinfop').html(data);
                    $('#exam-info-modal').modal('show');
                });

        }

        function getExamHistory(id) {
            $.post(`{{ route('exam.getExamHistory') }}`, {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                function(data) {
                    $('#test-history-modal-content').html(data);
                    $('#test-history-modal').modal('show');
                });
        }

    </script>

@endsection
