<select name="question_id" id="question-filter" class="select2 form-control">
    <option value="0">{{ trans('messages.All') }}</option>
    @foreach ($questions as $question)
        <option {{ $question_id == $question->id ? 'selected' : '' }} value="{{ $question->id }}">
            {{ $question->{'question_' . App::getLocale()} }}</option>
    @endforeach
</select>
