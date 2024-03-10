@foreach (Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['answers'] as $a)
    @if (in_array($a['answer_' . App::getLocale()], Session::get('exam_object')['examCategory'][$current_category]['questions'][$current_question]['wrong_answers']))
        <div class="answer-container ans-opt answer-cont-31 ball-lin-heigth"
             style="color: #fff;font-size: 1.5em;text-align: center;width: 40px;height: 40px;background-color: rgb(255 0 0 / 43%);border-radius: 50%;border: 2px solid red;position: absolute;top: {{ $a['top_position'] }}% !important; left: {{ $a['left_position'] }}% !important;">
            {{ $a['answer_' . App::getLocale()] }}
        </div>
    @else
        <div class="answer-container ans-opt answer-cont-31 ball-lin-heigth"
             style="color: #fff;font-size: 1.5em;text-align: center;width: 40px;height: 40px;background-color: rgb(0 128 0 / 53%);border-radius: 50%;border: 2px solid green;position: absolute;top: {{ $a['top_position'] }}%!important; left: {{ $a['left_position'] }}%!important;">
            {{ $a['answer_' . App::getLocale()]  }}
        </div>
    @endif
@endforeach


MAIL_MAILER=smtp
MAIL_HOST=mail.aatheorie.nl
MAIL_PORT=465
MAIL_USERNAME=info@send.aatheorie.nl
MAIL_PASSWORD=7Y)Q$eDov!HC
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=info@send.aatheorie.nl
MAIL_FROM_NAME="${APP_NAME}"
