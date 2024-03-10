<p class="title">{{ trans('messages.Comments') }}</p>
@forelse ($comments as $comment)
    <div class="comment">
        <p class="name">{{ $comment->user->name }}</p>
        <p class="date-time">
            {{ time_elapsed_string(date('Y-m-d H:i', strtotime($comment->created_at))) }}
        </p>
        <p class="comment-text">
            {{ $comment->comment }}
        </p>
    </div>
@empty
    <div class="no-data">
        <i class="fa-solid fa-comment-slash"></i>
        <p>{{ trans('messages.There are no comments yet') }}</p>
    </div>
@endforelse
