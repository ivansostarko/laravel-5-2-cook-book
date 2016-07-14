@extends('layouts.admin')

@section('htmlheader_title')
    Activities
@endsection

@section('contentheader_title')
    Activities <a href="{{ route('admin.activities.clear') }}" class="btn btn-primary pull-right btn-xl" type="button">Clear logs</a>
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
            <th>User</th>
            <th>Action</th>
            <th>IP Address</th>
            <th>Date</th>


        </tr>
        </thead>
        <tbody>


        @foreach($activities as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->user->name }}</td>
                <td>{{ $activity->text }}</td>
                <td>{{ $activity->ip_address }}</td>
                <td>{{ date('d.m.Y', strtotime($activity->created_at)) }}</td>



            </tr>
        @endforeach

        </tbody>

    </table>


@endsection

@section('styles')
    <link href="{{ asset('/node_modules/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/node_modules/datatables-bootstrap/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
    <script src="{{ asset('/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/node_modules/datatables-bootstrap/js/dataTables.bootstrap.min.js') }}"></script>

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