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
                    <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit user"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit User"></i></a>

                    <a href="{{ route('admin.users.password.edit', $user->id) }}" title="Edit password"><i class="fa fa-key" data-toggle="tooltip" data-placement="top" title="Edit Password"></i></a>

                    <a data-href="{{ route('admin.users.destroy', $user->id) }}" data-toggle="modal" data-target="#confirm-delete"  title="Delete user"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="Delete User"></i></a>

                    <a href="{{ route('admin.users.show', $user->id) }}" title="More details"><i class="fa fa-external-link-square" data-toggle="tooltip" data-placement="top" title="More Info"></i></a>

                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
     {{-- Confirm Delete --}}
     <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">

                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                 </div>

                 <div class="modal-body">
                     <p>You are about to delete one track, this procedure is irreversible.</p>
                     <p>Do you want to proceed?</p>
                     <p class="debug-url"></p>
                 </div>

                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                     <a class="btn btn-danger btn-ok">Delete</a>
                 </div>
             </div>
         </div>
     </div>
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

            $('#main_table').dataTable({
                "bPaginate": true,
                "iDisplayLength": 25,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": false,
                "bInfo": true,
                "bAutoWidth": true

            });

            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });

        });

    </script>
@endsection
