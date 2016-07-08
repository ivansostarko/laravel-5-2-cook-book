
@extends('layouts.mail')

@section('htmlheader_title')
    Your Password Reset Link
@endsection

@section('contentheader_title')
    Your Password Reset Link
@endsection


@section('main-content')

  <p>Click here to reset your password: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
  </p>
@endsection










