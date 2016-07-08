@extends('layouts.mail')

@section('htmlheader_title')
    Resend verification code
@endsection

@section('contentheader_title')
    Resend verification code
@endsection


@section('main-content')

    <p>Click here to verify your account: <a href="{{ $link = url('verification', $token) . '?email=' . urlencode($email) }}"> {{ $link }}</a></p>


@endsection







