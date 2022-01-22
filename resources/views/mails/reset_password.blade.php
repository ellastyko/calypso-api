
@extends('mails.email')
@section('content')
    <p>Hello {{ $user->name }}</p>
    <p></p>
@endsection
