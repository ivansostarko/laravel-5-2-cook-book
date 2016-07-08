
@extends('layouts.error')

@section('htmlheader_title')
    Error 503 page
@endsection



@section('main-content')

    <div class="error-template">
        <h1>
            Oops!</h1>
        <h2>
            Service unavailable</h2>
        <div class="error-details">
            Sorry, an error has occured.
        </div>
        <div class="error-actions">
            <a href="{{ route('web.homepage') }}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                Take Me Home </a>
        </div>
    </div>

@endsection