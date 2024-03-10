 @if ($saveExamResult['user_guest'] == 'user')
     <div class="row finish-test-row">
         @if ($saveExamResult['passed_exam'] == true)
             <img src="{{ url('front_them/assets/imgs/success-' . App::getLocale() . '.png') }}" alt="">
         @else
             <img src="{{ url('front_them/assets/imgs/fail-' . App::getLocale() . '.png') }}" alt="">
         @endif
         <p></p>
         {{-- <p class="text">{{ trans('messages.You have completed the test successfully') }}</p> --}}
         <button class="btn" onclick="getFinishedExamResultUser({{ $f_exam_id }},{{ $f_user_id }})">
             {{ trans('messages.Show the result') }}
         </button>
     </div>
 @else
     <div class="row finish-test-row">
         @if (Session::get('exam_guest_result_object' . $f_exam_id)['passed_exam'] == true)
             <img src="{{ url('front_them/assets/imgs/success-' . App::getLocale() . '.png') }}" alt="">
         @else
             <img src="{{ url('front_them/assets/imgs/fail-' . App::getLocale() . '.png') }}" alt="">
         @endif
         <p></p>
         {{-- <p class="text">{{ trans('messages.You have completed the test successfully') }}</p> --}}
         <button class="btn" onclick="getFinishedExamResultGuest({{ $f_exam_id }})">
             {{ trans('messages.Show the result') }}
         </button>
     </div>
 @endif

 <script>
     enable_click = true;
     open_tap_or_click_outside = 100;
     resetCounter();
     $('#time_progress_bar').remove();
     $('.hide-after-exam').remove();
     $('.show-after-exam').show();
     $('#redo-exam-btn').remove();
     $('#progress-of-all').html(`
    <div class="progress-bar" role="progressbar" aria-label="Example with label"
                        style="width: 100%;" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="100">100%</div>
    `);
     $('#progress-of-all').remove();
 </script>
