@extends('layouts.admin')

@section('htmlheader_title')
    User details
@endsection

@section('contentheader_title')
    User details
@endsection

@section('sidebar')
    @include('layouts.partials.admin.menu_profile')
@endsection

@section('main-content')

    <div class="row">
        <h2>Details</h2>
        <table class="table">

            <tbody>
            <tr><td><strong>Name</strong></td><td> {{ $user->name  }}</td></tr>
            <tr><td><strong>Email</strong></td><td> {{ $user->email  }}</td></tr>
            <tr><td><strong>Banned</strong></td><td> @if($user->banned==0) No @else Yes @endif</td></tr>
            <tr><td><strong>Verified</strong></td><td> @if($user->verified==0) No @else Yes @endif</td></tr>
            <tr><td><strong>Online</strong></td><td> @if($is_online> 0) Yes @else No @endif</td></tr>
            <tr><td><strong>Registred date</strong></td> <td>{{ date('d.m.Y', strtotime($user->created_at)) }}</td></tr>
            </tbody>

        </table>
    </div>

    <hr />

    <div class="row">
        <h2>Actions</h2>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-default">Edit user</a>
            </div>
            <div class="btn-group" role="group">
                <a href="{{ route('admin.users.password.edit', $user->id) }}" class="btn btn-default">Edit password</a>
            </div>
            @if($user->verified==0)
            <div class="btn-group" role="group">
                <a href="{{route('admin.users.verify',$user->id)}}" class="btn btn-default">Verify user</a>
            </div>
            @endif

            <div class="btn-group" role="group">
                @if($user->banned==0)
                    <a href="{{route('admin.users.ban',$user->id)}}"class="btn btn-default">Ban user</a>
                @else
                    <a href="{{route('admin.users.unban',$user->id)}}"class="btn btn-default">Unban user</a>
                @endif
            </div>

        </div>
    </div>

<hr />
    <div class="row">
        <h2>Latest activity</h2>
        @if (count($activities) === 0)
            <p>No online users</p>
        @elseif (count($activities) >= 1)

        <table class="table" id="main_table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Action</th>
                <th>IP Address</th>
                <th>Date</th>


            </tr>
            </thead>
            <tbody>


            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->id }}</td>
                    <td>{{ $activity->text }}</td>
                    <td>{{ $activity->ip_address }}</td>
                    <td>{{ date('d.m.Y', strtotime($activity->created_at)) }}</td>



                </tr>
            @endforeach

            </tbody>

        </table>
        @endif
        </div>




@endsection

