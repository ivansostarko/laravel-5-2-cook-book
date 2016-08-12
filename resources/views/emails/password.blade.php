
@extends('layouts.mail')

@section('htmlheader_title')
    {{trans('phrases.your_resend_link')}}
@endsection

@section('contentheader_title')
    {{trans('phrases.your_resend_link')}}
@endsection


@section('main-content')

  <p>{{trans('phrases.your_resend_link_click')}}: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
  </p>
@endsection










