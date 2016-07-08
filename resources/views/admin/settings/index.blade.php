@extends('layouts.admin')

@section('htmlheader_title')
    Settings
@endsection

@section('contentheader_title')
    Settings
@endsection

@section('sidebar')
    @include('layouts.partials.admin.menu_profile')
@endsection

@section('main-content')



    @if (Session::has('message'))
        <div class="alert alert-{{ Session::get('message_type') }}" role="alert">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif


    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/settings/store') }}">
        {{ csrf_field() }}
    <div class="form-group">
        <label for="google_analytics">Google Analytics</label>
        <textarea class="form-control" rows="5" id="google_analytics" name="google_analytics">{{ $setting_google_analytics }}</textarea>
    </div>

    <div class="form-group">

            <button type="submit" class="btn btn-default">Submit</button>

    </div>
    </form>

@endsection

