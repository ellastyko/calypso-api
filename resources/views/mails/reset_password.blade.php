
@extends('mails.email')
@section('content')
    <p>Hello {{ $user->name }}</p>
    <p>Reset link: {{ $link  }}</p>
@endsection
