@extends('layouts.email')

@section('content')
    <p>Hello {{ $user->name }}</p>
    <a href="{{ $link  }}" target="_blank">Verify email</a>
@endsection
