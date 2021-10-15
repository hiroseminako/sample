@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/index']) !!}

{{ Form::text('tweet','何をつぶやこうか・・・?',['class' => 'tweet']) }}
{{ Form::submit('') }}
@if($errors->first('tweet'))
{{ $errors->first('tweet') }}
@endif
{!! Form::close() !!}

@foreach($comments as $comment)
<tr>
  <td>{{ $comment->users.username }}</td>
  <td>{{ $comment->posts.posts }}</td>
  <td>{{ $comment->posts.created_at }}</td>
  <!-- <td><img src='{{ $post->images }}'></td> -->
</tr>
@endforeach

@endsection
