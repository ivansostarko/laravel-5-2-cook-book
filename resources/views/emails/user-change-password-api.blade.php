@extends('layouts.mail')

@section('htmlheader_title')
    Password changed
@endsection

@section('contentheader_title')
    Password changed
@endsection


@section('main-content')
    <p>Your password has beend changed</p>
    <p>New password: {{ $password }}</p>
@endsection







