@extends('layouts.email')

@section('content')
    <h2>Hello {{ $user->name }}</h2>
    <p>Your password was successfully reset</p>
@endsection
