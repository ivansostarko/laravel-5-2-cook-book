@extends('layouts.admin')

@section('htmlheader_title')
    {{ trans('words.user_details') }}
@endsection

@section('contentheader_title')
    {{ trans('words.user_details') }}
@endsection

@section('sidebar')
    @include('layouts.partials.admin.menu_profile')
@endsection

@section('main-content')

    <div class="row">
        <h2> {{ trans('words.details') }}</h2>
        <table class="table">

            <tbody>
            <tr><td><strong>{{ trans('words.name') }}</strong></td><td> {{ $user->name  }}</td></tr>
            <tr><td><strong>{{ trans('words.email') }}</strong></td><td> {{ $user->email  }}</td></tr>
            <tr><td><strong>{{ trans('words.banned') }}</strong></td><td> @if($user->banned==0) No @else Yes @endif</td></tr>
            <tr><td><strong>{{ trans('words.verified') }}</strong></td><td> @if($user->verified==0) {{ trans('words.no') }} @else {{ trans('words.yes') }} @endif</td></tr>
            <tr><td><strong>{{ trans('words.online') }}</strong></td><td> @if($is_online> 0) {{ trans('words.yes') }} @else {{ trans('words.no') }} @endif</td></tr>
            <tr><td><strong>{{ trans('words.registered') }}</strong></td> <td>{{ date('d.m.Y', strtotime($user->created_at)) }}</td></tr>
            </tbody>

        </table>
    </div>

    <hr />

    <div class="row">
        <h2>Actions</h2>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-default">{{ trans('words.edit_user') }}</a>
            </div>
            <div class="btn-group" role="group">
                <a href="{{ route('admin.users.password.edit', $user->id) }}" class="btn btn-default">{{ trans('words.edit_password') }}</a>
            </div>
            @if($user->verified==0)
            <div class="btn-group" role="group">
                <a href="{{route('admin.users.verify',$user->id)}}" class="btn btn-default">{{ trans('words.verify_user') }}</a>
            </div>
            @endif

            <div class="btn-group" role="group">
                @if($user->banned==0)
                    <a href="{{route('admin.users.ban',$user->id)}}"class="btn btn-default">{{ trans('words.ban_user') }}</a>
                @else
                    <a href="{{route('admin.users.unban',$user->id)}}"class="btn btn-default">{{ trans('words.unban_user') }}</a>
                @endif
            </div>

        </div>
    </div>

<hr />
    <div class="row">
        <h2>{{ trans('words.latest_activity') }}</h2>
        @if (count($activities) === 0)
            <p>{{ trans('words.no_users_online') }}</p>
        @elseif (count($activities) >= 1)

        <table class="table" id="main_table">
            <thead>
            <tr>
                <th>ID</th>
                <th>{{ trans('words.action') }}</th>
                <th>{{ trans('words.ip_address') }}</th>
                <th>{{ trans('words.date') }}</th>


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

@section('styles')
@endsection


@section('scripts')
@endsection
