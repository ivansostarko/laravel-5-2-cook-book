@extends('layouts.admin')

@section('htmlheader_title')
	{{ trans('words.dashboard') }}
@endsection

@section('contentheader_title')
	{{ trans('words.dashboard') }}
@endsection

@section('sidebar')
	@include('layouts.partials.admin.menu_profile')
@endsection

@section('main-content')




	<div class="row">
		<h2>{{ trans('words.statistics') }}</h2>
		<table class="table" id="main_table">

			<tbody>

			<tr><td><strong><i class="fa fa-user-secret" aria-hidden="true"></i> {{ trans('words.total_admins') }}</strong></td><td>{{ $admins }}</td></tr>
			<tr><td><strong><i class="fa fa-users" aria-hidden="true"></i> {{ trans('words.total_users') }}</strong></td><td>{{ $users }}</td></tr>
			<tr><td><strong><i class="fa fa-ban" aria-hidden="true"></i> {{ trans('words.banned_users') }}</strong></td><td>{{ $banned }}</td></tr>
			<tr><td><strong><i class="fa fa-user-times" aria-hidden="true"></i> {{ trans('words.unverified_users') }}</strong></td><td>{{ $unverified }}</td></tr>
			<tr><td><strong><i class="fa fa-file-text" aria-hidden="true"></i> {{ trans('words.total_categories') }}</strong></td><td>{{ $categories }}</td></tr>
			<tr><td><strong><i class="fa fa-cutlery" aria-hidden="true"></i> {{ trans('words.total_items') }} </strong></td><td>{{ $items }}</td></tr>

			</tbody>

		</table>
	</div>

	<hr />

	<div class="row">
		<h2>Live data</h2>
		<table class="table" id="main_table">

			<tbody>


			<tr><td><strong><i class="fa fa-user-plus" aria-hidden="true"></i> {{ trans('words.online_guests') }}</strong></td><td>{{ $get_online_guests }}</td></tr>
			<tr><td><strong><i class="fa fa-user" aria-hidden="true"></i> {{ trans('words.online_users') }}</strong></td><td>{{ $get_online_users }}</td></tr>
			</tbody>

		</table>
	</div>


	<hr />

	<div class="row">
		<h2>{{ trans('words.latest_online_users') }} </h2>

		@if (count($latest_users) === 0)
			<p>{{ trans('words.no_users_online') }}</p>
		@elseif (count($latest_users) >= 1)

			<table class="table" id="main_table">
				<thead>
				<tr>
					<th>{{ trans('words.user_id') }}</th>
					<th>{{ trans('words.name') }}</th>
					<th>{{ trans('words.email') }}</th>
					<th>{{ trans('words.ip_address') }}</th>


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
