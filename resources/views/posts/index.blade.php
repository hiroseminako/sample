@extends('layouts.login')

@section('content')
{!! Form::open(['url' => '/login']) !!}

{{ Form::text('comment','何をつぶやこうか・・・?',['class' => 'comment']) }}


{!! Form::close() !!}

@endsection
