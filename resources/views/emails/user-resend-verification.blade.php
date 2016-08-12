@extends('layouts.mail')

@section('htmlheader_title')
    {{ trans('phrases.resend_verification_code') }}
@endsection

@section('contentheader_title')
    {{ trans('phrases.resend_verification_code') }}
@endsection


@section('main-content')

    <p>{{ trans('phrases.resend_verification_code_click') }}: <a href="{{ $link = url('verification', $token) . '?email=' . urlencode($email) }}"> {{ $link }}</a></p>


@endsection







