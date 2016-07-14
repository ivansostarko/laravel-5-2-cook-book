@extends('layouts.error')

@section('htmlheader_title')
    Error 404 page
@endsection



@section('main-content')

    <div class="error-template">
        <h1>
            Oops!</h1>
        <h2>
            404 Not Found</h2>
        <div class="error-details">
            Sorry, an error has occured, Requested page not found!
        </div>
        <div class="error-actions">
            <a href="{{ route('web.homepage') }}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                Take Me Home </a>
        </div>
    </div>

@endsection


@section('styles')
@endsection


@section('scripts')
@endsection