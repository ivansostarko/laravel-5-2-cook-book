@extends('layouts.admin')

@section('htmlheader_title')
	Dashboard
@endsection

@section('contentheader_title')
	Dashboard
@endsection

@section('sidebar')
	@include('layouts.partials.admin.menu_profile')
@endsection

@section('main-content')




	<div class="row">
		<h2>Statistics</h2>
		<table class="table" id="main_table">

			<tbody>


			<tr><td><strong>Total Admins</strong></td><td>{{ $admins }}</td></tr>
			<tr><td><strong>Total Users</strong></td><td>{{ $users }}</td></tr>
			<tr><td><strong>Banned Users</strong></td><td>{{ $banned }}</td></tr>
			<tr><td><strong>Unverified Users</strong></td><td>{{ $unverified }}</td></tr>
			<tr><td><strong>Total Categories</strong></td><td>{{ $categories }}</td></tr>
			<tr><td><strong>Total Items</strong></td><td>{{ $items }}</td></tr>






			</tbody>

		</table>
	</div>

	<hr />

	<div class="row">
		<h2>Live data</h2>
		<table class="table" id="main_table">

			<tbody>


			<tr><td><strong>Online Guests</strong></td><td>{{ $get_online_guests }}</td></tr>
			<tr><td><strong>Online Users</strong></td><td>{{ $get_online_users }}</td></tr>
			</tbody>

		</table>
	</div>


	<hr />

	<div class="row">
		<h2>Latest online users</h2>

		@if (count($latest_users) === 0)
			<p>No online users</p>
		@elseif (count($latest_users) >= 1)

			<table class="table" id="main_table">
				<thead>
				<tr>
					<th>User ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>IP address</th>


				</tr>
				</thead>
				<tbody>


				@foreach($latest_users as $latest_user)
					<tr>
						<td>{{ $latest_user->user->id }}</td>
						<td>{{ $latest_user->user->name }}</td>
						<td>{{ $latest_user->user->email }}</td>
						<td>{{ $latest_user->ip_address }}</td>



					</tr>
				@endforeach

				</tbody>

			</table>

			@endif


	</div>



@endsection
