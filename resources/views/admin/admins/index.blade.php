@extends('layouts.admin')

@section('htmlheader_title')
    Admins
@endsection

@section('contentheader_title')
   Admins <a href="{{ route('admin.admins.create') }}" class="btn btn-primary pull-right btn-xl" type="button">Insert new admin</a>
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
            <th>Date created</th>
            <th>Actions</th>

        </tr>
        </thead>
        <tbody>


        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ date('d.m.Y', strtotime($admin->created_at)) }}</td>
                <td>
                    <a href="{{ route('admin.admins.edit', $admin->id) }}"><i class="fa fa-pencil"></i></a>

                    <a href="{{ route('admin.admins.password.edit', $admin->id) }}" title="Edit password"><i class="fa fa-key"></i></a>

                    <a href="{{ route('admin.admins.destroy', $admin->id) }}" title="Delete file"><i class="fa fa-ban"></i></a>

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
