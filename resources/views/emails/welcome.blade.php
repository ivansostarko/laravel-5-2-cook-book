@extends('layouts.mail')

@section('htmlheader_title')
    Welcome
@endsection

@section('contentheader_title')
    Welcome
@endsection


@section('main-content')
    <h3>Welcome {{ $email }}</h3>
@endsection
