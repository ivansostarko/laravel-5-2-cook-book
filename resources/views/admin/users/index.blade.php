@extends('layouts.admin')

@section('htmlheader_title')
    Users
@endsection

@section('contentheader_title')
   Users <a href="{{ route('admin.users.create') }}" class="btn btn-primary pull-right btn-xl" type="button">Insert new user</a>
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

    <table class="table" id="main_table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Verified</th>
            <th>Banned</th>
            <th>Date created</th>

            <th>Actions</th>

        </tr>
        </thead>
        <tbody>


        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>

                <td><i class="fa @if($user->verified == 1)fa-check @else fa-ban @endif" aria-hidden="true"></i></td>
                <td><i class="fa @if($user->banned == 1)fa-check @else fa-ban @endif" aria-hidden="true"></i></td>
                <td>{{ date('d.m.Y', strtotime($user->created_at)) }}</td>


                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit user"><i class="fa fa-pencil"></i></a>

                    <a href="{{ route('admin.users.password.edit', $user->id) }}" title="Edit password"><i class="fa fa-key"></i></a>

                    <a href="{{ route('admin.users.destroy', $user->id) }}" title="Delete user"><i class="fa fa-ban"></i></a>

                    <a href="{{ route('admin.users.show', $user->id) }}" title="More details"><i class="fa fa-external-link-square"></i></a>

                </td>
            </tr>
        @endforeach

        </tbody>

    </table>

@endsection

@section('styles')
    <link href="{{ asset('/public/plugins/validation/css/formValidation.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/public/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/public/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
    <script src="{{ asset('/public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/public/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>


    <script type="text/javascript">
        $(function () {

            $('#main_table').dataTable({
                "bPaginate": true,
                "iDisplayLength": 25,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": false,
                "bInfo": true,
                "bAutoWidth": true

            });
        });

    </script>
@endsection
