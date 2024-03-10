<style>
    .bootstrap-tagsinput {
        width: 100%;
        padding: 0.6em;
    }
</style>
<!-- Main content -->

{!! Form::open([
    'method' => 'PUT',
    'route' => ['examCategory.update', $examCategory->id],
    'files' => true,
    'id' => 'edit-examCategory-form',
]) !!}
<!-- Nav tabs -->
<ul class="nav nav-tabs customtab2" role="tablist">
    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><span
                class="hidden-sm-up"><i class="ion-home"></i></span> <span
                class="hidden-xs-down">{{ trans('messages.Arabic') }}</span></a> </li>
    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><span
                class="hidden-sm-up"><i class="ion-person"></i></span> <span
                class="hidden-xs-down">{{ trans('messages.Netherland') }}</span></a> </li>
    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home8" role="tab"><span
                class="hidden-sm-up"><i class="ion-home"></i></span> <span
                class="hidden-xs-down">{{ trans('messages.English') }}</span></a> </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="home7" role="tabpanel">
        <div class="p-15">
            <div class="form-group">
                <label for="name_ar">{{ trans('messages.Name Ar') }}
                </label>
                <div>
                    {!! Form::text('name_ar', $examCategory->name_ar, [
                        'id' => 'name_ar',
                        'class' => 'form-control',
                        'placeholder' => trans('messages.Name Ar'),
                    ]) !!}
                </div>
                <div class="badge badge-danger text-center" style="width: 100%;display:none" id="name_ar-error">

                </div>
            </div>
            <div class="form-group">
                <label for="description_ar">{{ trans('messages.Description Ar') }}
                </label>
                <div>
                    {!! Form::textarea('description_ar', $examCategory->description_ar, [
                        'id' => 'description_ar',
                        'class' => 'form-control',
                        'placeholder' => trans('messages.Description Ar'),
                    ]) !!}
                </div>
                <div class="badge badge-danger text-center" style="width: 100%;display:none" id="description_ar-error">

                </div>
            </div>

        </div>
    </div>
    <div class="tab-pane" id="home8" role="tabpanel">
        <div class="p-15">
            <div class="form-group">
                <label for="name_en">{{ trans('messages.Name EN') }}
                </label>
                <div>
                    {!! Form::text('name_en', $examCategory->name_en, [
                        'id' => 'name_en',
                        'class' => 'form-control',
                        'placeholder' => trans('messages.Name EN'),
                    ]) !!}
                </div>
                <div class="badge badge-danger text-center" style="width: 100%;display:none" id="name_en-error">

                </div>
            </div>
            <div class="form-group">
                <label for="description_en">{{ trans('messages.Description EN') }}
                </label>
                <div>
                    {!! Form::textarea('description_en', $examCategory->description_en, [
                        'id' => 'description_en',
                        'class' => 'form-control',
                        'placeholder' => trans('messages.Description Ar'),
                    ]) !!}
                </div>
                <div class="badge badge-danger text-center" style="width: 100%;display:none" id="description_en-error">

                </div>
            </div>

        </div>
    </div>
    <div class="tab-pane" id="profile7" role="tabpanel">
        <div class="p-15">
            <div class="form-group">
                <label for="name_nl">{{ trans('messages.Name Nl') }}
                </label>
                <div>
                    {!! Form::text('name_nl', $examCategory->name_nl, [
                        'id' => 'name_nl',
                        'class' => 'form-control',
                        'placeholder' => trans('messages.Name Nl'),
                    ]) !!}
                </div>
                <div class="badge badge-danger text-center" style="width: 100%;display:none" id="name_nl-error">

                </div>
            </div>

            <div class="form-group">
                <label for="description_nl">{{ trans('messages.Description Nl') }}
                </label>
                <div>
                    {!! Form::textarea('description_nl', $examCategory->description_nl, [
                        'id' => 'description_nl',
                        'class' => 'form-control',
                        'placeholder' => trans('messages.Description Nl'),
                    ]) !!}
                </div>
                <div class="badge badge-danger text-center" style="width: 100%;display:none" id="description_nl-error">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="checkbox">
        {!! Form::checkbox('explaination_while_exam', null, $examCategory->explaination_while_exam, [
            'id' => 'explaination_while_exam',
        ]) !!}
        <label for="explaination_while_exam">{{ trans('messages.Explaination while exam') }}</label>
    </div>
</div>
<div class="form-group">
    <div class="checkbox">
        {!! Form::checkbox('question_auto_move', null, $examCategory->question_auto_move, [
            'id' => 'question_auto_move',
        ]) !!}
        <label for="question_auto_move">{{ trans('messages.Question auto move') }}</label>
    </div>
</div>
<div class="form-group">
    <label for="name">{{ trans('messages.Duration type') }}
    </label>
    <div>
        {!! Form::select(
            'duration_type',
            ['for_question' => trans('messages.for every question'), 'for_category' => trans('messages.for Category')],
            $examCategory->duration_type,
            [
                'id' => 'duration_type',
                'class' => 'form-control',
                'data-placeholder' => trans('Duration type'),
            ],
        ) !!}

    </div>
    @error('question_type')
        <div class="badge badge-danger text-center" style="width: 100%">{{ $message }}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="wrong_question_to_fail">{{ trans('messages.Wrong question to fail') }}
    </label>
    <div>
        {!! Form::number('wrong_question_to_fail', $examCategory->wrong_question_to_fail, [
            'id' => 'wrong_question_to_fail',
            'class' => 'form-control',
            'placeholder' => trans('messages.Wrong question to fail'),
        ]) !!}
    </div>
    @error('wrong_question_to_fail')
        <div class="badge badge-danger text-center" style="width: 100%">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="row">
    <div class="col-md">
        <div class="form-group">
            <label for="duration">{{ trans('messages.Duration') }}
            </label>
            <div>
                {!! Form::number('duration', $examCategory->duration, [
                    'id' => 'duration',
                    'class' => 'form-control',
                    'placeholder' => trans('messages.Duration'),
                ]) !!}
            </div>
            @error('duration')
                <div class="badge badge-danger text-center" style="width: 100%">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    @if ($examCategory->duration_type == 'for_question')
        <div class="col-md-4" style="padding-top: 2.2em">
            <span style="color: red" id="duration_hint" style="width: 100%">
                {{ trans('messages.Question duration in secounds') }}
            </span>
        </div>
    @else
        <div class="col-md-4" style="padding-top: 2.2em">
            <span style="color: red" id="duration_hint" style="width: 100%">
                {{ trans('messages.Category duration in minutes') }}
            </span>
        </div>
    @endif

</div>
<div class="form-group">
    <label for="arrangment">{{ trans('messages.Arrangment') }}
    </label>
    <div>
        {!! Form::number('arrangment', $examCategory->arrangment, [
            'id' => 'arrangment',
            'class' => 'form-control',
            'placeholder' => trans('messages.Arrangment'),
        ]) !!}
    </div>
    <div class="badge badge-danger text-center" style="width: 100%;display:none" id="arrangment-error">

    </div>
</div>
<!-- /.box-body -->
<button type="submit" class="btn btn-rounded btn-primary btn-outline">
    <i class="ti-save-alt"></i> {{ trans('messages.Save') }}
</button>

{!! Form::Close() !!}
<script type="text/javascript">
    $('.select2').select2();
    CKEDITOR.replace('description_ar')
    CKEDITOR.replace('description_en')
    CKEDITOR.replace('description_nl')
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    $('#duration_type').change(function() {
        if ($(this).val() == 'for_question') {
            $('#duration_hint').text("{{ trans('messages.Question duration in secounds') }}")
        } else {
            $('#duration_hint').text("{{ trans('messages.Category duration in minutes') }}")
        }
    })
    $('#edit-examCategory-form').on('submit', function(e) {
        e.preventDefault();
        var is_checked = 'off';
        if ($("input[name='explaination_while_exam']").is(":checked")) {
            is_checked = 'on';
        }
        var question_a_m_is_checked = 'off';
        if ($("input[name='question_auto_move']").is(":checked")) {
            question_a_m_is_checked = 'on';
        }
        var name_ar = $('#name_ar').val();
        var name_en = $('#name_en').val();
        var name_nl = $('#name_nl').val();
        var description_ar = $('#description_ar').val();
        var description_en = $('#description_en').val();
        var description_nl = $('#description_nl').val();
        var arrangment = $('#arrangment').val();
        var duration_type = $('#duration_type').val();
        var duration = $('#duration').val();
        var wrong_question_to_fail = $('#wrong_question_to_fail').val();
        url = $(this)[0].action;
        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                name_ar: name_ar,
                name_en: name_en,
                name_nl: name_nl,
                description_ar: CKEDITOR.instances['description_ar'].getData(),
                description_en: CKEDITOR.instances['description_en'].getData(),
                description_nl: CKEDITOR.instances['description_nl'].getData(),
                arrangment: arrangment,
                duration_type: duration_type,
                duration: duration,
                wrong_question_to_fail: wrong_question_to_fail,
                redirect_head: 'ajax_create',
                exam_id: {{ $examCategory->exam_id }},
                explaination_while_exam: is_checked,
                question_auto_move: question_a_m_is_checked,
            },
            success: function(data) {
                $("#exam-categories-section").html(data);
                $('#create-with-ajax').modal('hide');
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log("nader")
                var errors = $.parseJSON(xhr.responseText);
                $.each(errors, function(key, value) {
                    if ($.isPlainObject(value)) {
                        $.each(value, function(key, value) {
                            console.log(key + " " + value);
                            $('#' + key + '-error').show().html(value);

                        });
                    } else {

                    }
                });
            }
        });
    });
</script>
