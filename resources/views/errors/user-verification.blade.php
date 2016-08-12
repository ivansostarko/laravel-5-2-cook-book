@extends('layouts.public')

@section('htmlheader_title')
    {{ trans('phrases.user_already_verified') }}
@endsection

@section('contentheader_title')
    {{ trans('phrases.user_already_verified') }}
@endsection

@section('sidebar')
    @include('layouts.partials.frontend.menu_categories')
@endsection

@section('main-content')

    {{ trans('phrases.user_already_verified_oops') }}
@endsection

@section('styles')
@endsection


@section('scripts')
@endsection