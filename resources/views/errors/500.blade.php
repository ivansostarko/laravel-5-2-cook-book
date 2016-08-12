@extends('layouts.error')

@section('htmlheader_title')
     {{ trans('phrases.error_500') }}
@endsection



@section('main-content')

    <div class="error-template">
        <h1>{{ trans('phrases.oops') }}</h1>

        <h2> {{ trans('phrases.service_unavailable') }}</h2>

        <div class="error-details">
            {{ trans('phrases.errors_occured') }}
        </div>
        <div class="error-actions">
            <a href="{{ route('web.homepage') }}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                {{ trans('phrases.take_me_home') }}   </a>
        </div>
    </div>

@endsection

@section('styles')
@endsection


@section('scripts')
@endsection