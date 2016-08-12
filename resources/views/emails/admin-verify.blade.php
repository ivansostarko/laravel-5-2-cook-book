@extends('layouts.mail')

@section('htmlheader_title')
    {{ trans('phrases.verfied_account') }}
@endsection

@section('contentheader_title')
    {{ trans('phrases.verfied_account') }}
@endsection


@section('main-content')
    {{ trans('phrases.admin_verified_account') }}
@endsection
