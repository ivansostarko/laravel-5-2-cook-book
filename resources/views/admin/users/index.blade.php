@extends('layouts.admin')

@section('htmlheader_title')
    {{ trans('words.users') }}
@endsection

@section('contentheader_title')
    {{ trans('words.users') }} <a href="{{ route('admin.users.create') }}" class="btn btn-primary pull-right btn-xl" type="button">{{ trans('words.create_new_user') }}</a>
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
            <th>{{ trans('words.name') }}</th>
            <th>{{ trans('words.email') }}</th>
            <th>{{ trans('words.verified') }}</th>
            <th>{{ trans('words.banned') }}</th>
            <th>{{ trans('words.registred') }}</th>
            <th>{{ trans('words.actions') }}</th>

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
                    <a href="{{ route('admin.users.edit', $user->id) }}" title="{{ trans('words.edit_user') }}"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="{{ trans('words.edit_user') }}"></i></a>

                    <a href="{{ route('admin.users.password.edit', $user->id) }}" title="{{ trans('words.edit_password') }}"><i class="fa fa-key" data-toggle="tooltip" data-placement="top" title="{{ trans('words.edit_password') }}"></i></a>

                    <a data-href="{{ route('admin.users.destroy', $user->id) }}" data-toggle="modal" data-target="#confirm-delete"  ><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="{{ trans('words.delete_user') }}"></i></a>

                    <a href="{{ route('admin.users.show', $user->id) }}" title="More details"><i class="fa fa-external-link-square" data-toggle="tooltip" data-placement="top" title="{{ trans('words.more_info') }}"></i></a>

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
                     <h4 class="modal-title" id="myModalLabel">{{ trans('words.confirm_delete') }} </h4>
                 </div>

                 <div class="modal-body">
                     <p>{{ trans('words.confirm_delete_process') }}</p>
                     <p class="debug-url"></p>
                 </div>

                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('words.cancel') }}</button>
                     <a class="btn btn-danger btn-ok">{{ trans('words.delete') }}</a>
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
