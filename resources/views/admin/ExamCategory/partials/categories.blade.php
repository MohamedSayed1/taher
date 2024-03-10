<select name="category_id" id="category-filter" class="select2 form-control">
    <option value="0">{{ trans('messages.All') }}</option>
    @foreach ($categories as $category)
        <option {{ $category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
            {{ $category->{'name_' . App::getLocale()} }}</option>
    @endforeach
</select>
<script type="text/javascript">
    $('#category-filter').change(function() {
        category_id = $('#category-filter').val();
        $.post(`{{ route('question.getQuestions') }}`, {
            _token: '{{ csrf_token() }}',
            category_id: category_id,
            question_id: 0,
        }, function(data) {
            $('#questions-container').html(data)
        });
    })
</script>
