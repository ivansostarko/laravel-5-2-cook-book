@extends('layouts.admin')

@section('htmlheader_title')
	Profile
@endsection

@section('contentheader_title')
    Profile
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



<table class="table">
	@if($user->name != null)
		<tr>
			<td><i class="fa fa-user" aria-hidden="true"></i> Name</td>
			<td>{{$user->name}}</td>
		</tr>
	@endif


	<tr>
		<td><i class="fa fa-envelope" aria-hidden="true"></i> Email</td>
		<td>{{$user->email}}</td>
	</tr>


	<tr>
		<td><i class="fa fa-calendar" aria-hidden="true"></i> Registered</td>
		<td>{{ date('d.m.Y', strtotime($user->created_at)) }}</td>

	</tr>
</table>


@endsection

@section('styles')
@endsection


@section('scripts')
@endsection