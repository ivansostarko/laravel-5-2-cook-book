@extends('layouts.mail')

@section('htmlheader_title')
    {{ trans('phrases.password_changed') }}
@endsection

@section('contentheader_title')
    Password changed
@endsection


@section('main-content')
    <p>  {{ trans('phrases.password_changed') }}</p>
    <p>{{ trans('phrases.new_password') }}: {{ $password }}</p>
@endsection







