@extends('layouts.login')

@section('content')

<div class="new_tweet">
{!! Form::open(['url' => '/index']) !!}
{{ Form::text('tweet', null, ['class' => 'tweet', 'placeholder' => '何をつぶやこうか・・・?']) }}
{{ Form::image('images/post.png', 'image', ['class' => 'tweet_submit_button']) }}
@if($errors->first('tweet'))
{{ $errors->first('tweet') }}
@endif
{!! Form::close() !!}
</div>

@foreach($comments as $comment)
  <div class="all_tweets">
    <tr>
      <td>{{ $comment->username }}</td><br>
      <td>{{ $comment->posts }}</td>
      <td>{{ $comment->created_at }}</td><br>
      <td><img src="images/{{ $comment->images }}" height="55px" width="55px" class="profile_icon"></td><br>

      @if( $comment->username === Auth::user()->username )

      <div class="tweet_update_wrap">

        <a href="#" class="edit_button"><img src="images/edit.png"></a>
        <a href="/index/{{ $comment->id }}/delete" class="trash_button"><img src="images/trash.png"><img src="images/trash_h.png" class="active" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')"></a>

        <div class="tweet_modal">
          {!! Form::open(['url' => '/index/{$comment->id}/edit']) !!}
          {{ Form::text('tweet_update', $comment->posts, ['class' => 'tweet_update'])}}
          {{ Form::image('images/edit.png', 'image', ['class' => 'tweet_update_button']) }}
          {{ Form::hidden('tweet_id', $comment->id) }}
          @if($errors->first('tweet_update'))
          {{ $errors->first('tweet_update') }}
          @endif
          {!! Form::close() !!}
        </div>

      </div>

      @endif

    </tr>
  </div>
@endforeach

@endsection
