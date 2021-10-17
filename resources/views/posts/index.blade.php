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
  <td>{{ $comment->username }}</td>
  <td>{{ $comment->posts }}</td>
  <td>{{ $comment->created_at }}</td>
</tr>
@endforeach

@endsection
