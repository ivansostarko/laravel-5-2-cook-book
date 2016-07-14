@extends('layouts.admin')

@section('htmlheader_title')
   Items
@endsection

@section('contentheader_title')
   Items
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

    <table class="table table-bordered" id="items-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>User</th>
            <th>Category</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>


@endsection

@section('styles')
    <link href="{{ asset('/public/plugins/validation/css/formValidation.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/node_modules/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/node_modules/datatables-bootstrap/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
    <script src="{{ asset('/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/node_modules/datatables-bootstrap/js/dataTables.bootstrap.min.js') }}"></script>


    <script type="text/javascript">
        $(function () {

            //Init tooltip
            $('[data-toggle="tooltip"]').tooltip();

            $('#items-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.items.ajax') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'image', name: 'image' },
                    { data: 'name', name: 'name' },
                    { data: 'author', name: 'author' },
                    { data: 'category', name: 'category' },
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]

            });
        });

    </script>
@endsection
