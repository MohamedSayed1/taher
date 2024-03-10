<div class="modal-header">
    <h5 class="modal-title">{{ trans('messages.' . $examOpinion->problem_type) }}</h5>
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" style="overflow-y: scroll;">
    <h5>{{ trans('messages.The Client') }} :
        {{ $examOpinion->user ? $examOpinion->user->name : trans('messages.Guest') }}</h5>
    <h5>{{ trans('messages.The Exam') }} : {{ $examOpinion->exam->{'name_' . App::getLocale()} }}</h5>
    <h5>{{ trans('messages.The Question') }} : {{ $examOpinion->question->{'question_' . App::getLocale()} }}</h5>
    <h5>{{ trans('messages.Type') }} : {{ trans('messages.' . $examOpinion->problem_type) }}</h5>
    <p>
        {{ $examOpinion->problem_descreption }}
    </p>
</div>
