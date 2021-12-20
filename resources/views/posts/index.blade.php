@extends('layouts.login')

@section('content')

<div class="new_tweet">
  {!! Form::open(['url' => '/index']) !!}
  <tr>
    <td><img src="images//{{ $user->images }}" class="user_image profile_icon"  height="55px" width="55px"></td>
    <td>{{ Form::textarea('tweet', null, ['class' => 'tweet', 'placeholder' => '何をつぶやこうか・・・?']) }}</td>
    <td>{{ Form::image('images/post.png', 'image', ['class' => 'tweet_submit_button']) }}</td>
    @if($errors->first('tweet'))
    {{ $errors->first('tweet') }}
    @endif
    {!! Form::close() !!}
  </tr>
</div>

@foreach($comments as $comment)
  <div class="all_tweets">
      <p class="tweet_image"><a href="userpage/{{ $comment->id }}"><img src="images/{{ $comment->images }}" height="55px" width="55px" class="profile_icon"></a></p>
      <p class="tweet_username">{{ $comment->username }}</p>
      <p class="tweet_date">{{ $comment->created_at }}</p>
      <p class="tweet_post">{{ $comment->posts }}</p>

      @if( $comment->username === Auth::user()->username )

      <div class="tweet_update_wrap">

        <a href="#" class="edit_button" data-target="modal"><img src="images/edit.png"></a>
        <a href="/index/{{ $comment->id }}/delete" class="trash_button"><img src="images/trash.png"><img src="images/trash_h.png" class="active" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')"></a>

        <div class="tweet_modal" id="modal">
          {!! Form::open(['url' => '/index/{$comment->id}/edit']) !!}
          {{ Form::textarea('tweet_update', $comment->posts, ['class' => 'tweet_update'])}}
          {{ Form::image('images/edit.png', 'image', ['class' => 'tweet_update_button']) }}
          {{ Form::hidden('tweet_id', $comment->id) }}
          @if($errors->first('tweet_update'))
          {{ $errors->first('tweet_update') }}
          @endif
          {!! Form::close() !!}
        </div>

      </div>

      @endif

  </div>
@endforeach

@endsection
