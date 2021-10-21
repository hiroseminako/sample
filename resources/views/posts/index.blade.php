@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/index']) !!}

{{ Form::text('tweet', null, ['class' => 'tweet', 'placeholder' => '何をつぶやこうか・・・?']) }}
{{ Form::submit('') }}
@if($errors->first('tweet'))
{{ $errors->first('tweet') }}
@endif
{!! Form::close() !!}

@foreach($comments as $comment)
<tr>
  <td>{{ $comment->username }}</td><br>
  <td>{{ $comment->posts }}</td>
  <td>{{ $comment->created_at }}</td><br>
  <td><img src="images/{{ $comment->images }}"></td><br>
</tr>
@endforeach

@endsection
