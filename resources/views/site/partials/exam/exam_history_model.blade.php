<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <th style="width: 20%" scope="col">
                <i class="fa-solid fa-calendar-days"></i>
                <span>{{ trans('messages.Test date') }}</span>
            </th>
            <th style="width: 20%" scope="col">
                <i class="fa-solid fa-clock"></i> <span>{{ trans('messages.Test duration') }}</span>
            </th>
            <th style="width: 20%" scope="col">
                <i class="fa-solid fa-check"></i> <span>{{ trans('messages.Correct answers') }}</span>
            </th>
            <th style="width: 20%" scope="col">
                <i class="fa-solid fa-xmark"></i> <span>{{ trans('messages.Wrong answers') }}</span>
            </th>
            <th style="width: 20%" scope="col">
                <i class="fa-solid fa-xmark"></i> <span>{{ trans('messages.Score') }}</span>
            </th>
        </thead>
        <tbody>
            @forelse ($result as $item)
                <tr>
                    <td scope="row">{{ time_elapsed_string(date('Y-m-d H:i', strtotime($item->created_at))) }}
                        <hr>
                        {{ date('Y-m-d H:i', strtotime($item->created_at)) }}
                    </td>
                    <td>{{ $item->exam->duration_in_minutes }} {{ trans('messages.Minute') }}</td>
                    <td>{{ $item->total_right_questions }}</td>
                    <td>{{ $item->total_wrong_questions + $item->total_skiped_questions + $item->total_not_answered_questions }}
                    </td>
                    <td>
                        @if ($item->passed_exam == true)
                            <img style="width: 60%;"
                                src="{{ url('front_them/assets/imgs/success-' . App::getLocale() . '.png') }}"
                                alt="">
                        @else
                            <img style="width: 60%;"
                                src="{{ url('front_them/assets/imgs/fail-' . App::getLocale() . '.png') }}"
                                alt="">
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">{{ trans('messages.No result for this exam') }}</td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
