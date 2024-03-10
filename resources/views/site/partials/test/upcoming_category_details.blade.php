<div class="content">
    <p class="desc">
        {!! $upcomingCategory['description_' . App::getLocale()] !!}
    </p>
    <hr>
    <br>
    <br>
    <button class="btn btn-primary" onclick="moveToNextCategory({{ $up_current_category }},{{ $up_current_question }})">
        <span>{{ trans('messages.Move to next category') }}</span>
    </button>
</div>
