@extends('layouts.mail')

@section('htmlheader_title')
    {{ trans('phrases.welcome') }}
@endsection

@section('contentheader_title')
    {{ trans('phrases.welcome') }}
@endsection


@section('main-content')
    <h3> {{ trans('phrases.welcome') }} {{ $email }}</h3>
@endsection
