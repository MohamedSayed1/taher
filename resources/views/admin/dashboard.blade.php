@extends('admin.layouts.main')
@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">

                <div class="col-lg col-md col-sm-12">
                    <a href="{{ route('package.index') }}" class="box pull-up">
                        <div class="box-body">
                            <div class="text-center">
                                <span class="fa fa-fw fa-th font-size-70"><span class="path1"></span><span
                                        class="path2"></span></span>
                                <h3 class="mb-0">{{ App\Models\Package::count() }}</h3>
                                <h5 class="mb-0">{{ trans('messages.Total Packages') }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg col-md col-sm-12">
                    <a href="{{ route('exam.index') }}" class="box pull-up">
                        <div class="box-body">
                            <div class="text-center">
                                <span class="si-bag si font-size-70"><span class="path1"></span><span
                                        class="path2"></span></span>
                                <h3 class="mb-0">{{ App\Models\Exam::count() }}</h3>
                                <h5 class="mb-0">{{ trans('messages.Total Exams') }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg col-md col-sm-12">
                    <a href="{{ route('examCategory.index') }}" class="box pull-up">
                        <div class="box-body">
                            <div class="text-center">
                                <span class="si-bag si font-size-70"><span class="path1"></span><span
                                        class="path2"></span></span>
                                <h3 class="mb-0">{{ App\Models\ExamCategory::count() }}</h3>
                                <h5 class="mb-0">{{ trans('messages.Total Exam Categories') }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg col-md col-sm-12">
                    <a href="{{ route('question.index') }}" class="box pull-up">
                        <div class="box-body">
                            <div class="text-center">
                                <span class="fa fa-question-circle-o font-size-70"><span class="path1"></span><span
                                        class="path2"></span></span>
                                <h3 class="mb-0">{{ App\Models\Question::count() }}</h3>
                                <h5 class="mb-0">{{ trans('messages.Total Questions') }}</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg col-md col-sm-12">
                    <a href="{{ route('answer.index') }}" class="box pull-up">
                        <div class="box-body">
                            <div class="text-center">
                                <span class="fa fa-reply-all font-size-70"><span class="path1"></span><span
                                        class="path2"></span></span>
                                <h3 class="mb-0">{{ App\Models\Answer::count() }}</h3>
                                <h5 class="mb-0">{{ trans('messages.Total Answers') }}</h5>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <div class="row">
                <div class="box">
                    <div class="box-header with-border" style="padding: 13px 14px 0px !important">
                        <h4 class="box-title" style="margin-inline-end: 5%">{{ trans('messages.This Clients chart') }}
                        </h4>
                    </div>
                    <div class="box-body">
                        <div class="chart-canvas-div">
                            <canvas id="line-chart2" height="102%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="box">
                <div class="box-body">
                    <h4 class="box-title">{{ trans('messages.Latest Subscripitons') }}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center">
                            <thead>
                                <tr>
                                    <th class="bb-2 text-center">{{ trans('messages.No') }}#</th>
                                    <th class="bb-2 text-center">{{ trans('messages.Date') }}</th>
                                    <th class="bb-2 text-center">{{ trans('messages.Client') }}</th>
                                    <th class="bb-2 text-center">{{ trans('messages.Package') }}</th>
                                    <th class="bb-2 text-center">{{ trans('messages.View') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="text-center">
                                        1
                                    </td>
                                    <td class="text-center">{{ date('Y-m-d') }}</td>
                                    <td class="text-center">-------</td>
                                    <td class="text-center">----------</td>
                                    <td class="text-center">---------</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div> --}}
        </section>

        <!-- /.content -->
    </div>
@endsection
@section('modal')
@endsection

@section('script')
    <script>
        if ($('#line-chart2').length > 0) {
            var ctx1 = document.getElementById("line-chart2").getContext("2d");
            var data1 = {
                labels: [
                    {{ implode(',', array_keys($chartArray)) }}
                ],
                datasets: [{
                    label: "Nader",
                    backgroundColor: "#FFFFFF",
                    borderColor: "#1BA9FF",
                    pointBorderColor: "#1BA9FF",
                    pointHighlightStroke: "#1BA9FF",
                    data: [
                        {{ implode(',',array_values($chartArray)) }}
                    ]
                }]

            };

            var areaChart = new Chart(ctx1, {
                type: "line",
                data: data1,

                options: {
                    tooltips: {
                        mode: "label"
                    },
                    elements: {
                        point: {
                            hitRadius: 90
                        }
                    },

                    scales: {
                        yAxes: [{
                            stacked: true,
                            gridLines: {
                                color: "rgba(135,135,135,0)",
                            },
                            ticks: {
                                fontFamily: "Nunito Sans",
                                fontColor: "#1BA9FF"
                            }
                        }],
                        xAxes: [{
                            stacked: true,
                            gridLines: {
                                color: "rgba(135,135,135,0)",
                            },
                            ticks: {
                                fontFamily: "Nunito Sans",
                                fontColor: "#1BA9FF"
                            }
                        }]
                    },
                    animation: {
                        duration: 3000
                    },
                    responsive: true,
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor: 'rgba(33,33,33,1)',
                        cornerRadius: 0,
                        footerFontFamily: "'Nunito Sans'"
                    }

                }
            });
        }
    </script>
@endsection
