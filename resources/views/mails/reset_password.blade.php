@extends('mails.email')

@section('content')
    <p>Hello {{ $user->name }}</p>
    <a href="{{ $link  }}" target="_blank">Reset password</a>
@endsection
