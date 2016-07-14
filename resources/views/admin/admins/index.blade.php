@extends('layouts.admin')
http://www.tutorials.kode-blog.com/laravel-5-ajax-tutorial
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
        <tbody id="admins-list" name="admins-list">


        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ date('d.m.Y', strtotime($admin->created_at)) }}</td>
                <td>

                    <button class="btn btn-warning btn-xs btn-detail edit-modal" value="{{$admin->id}}"><i class="fa fa-pencil"></i> Edit</button>
                    <button class="btn btn-danger btn-xs btn-delete delete-task" value="{{$admin->id}}"><i class="fa fa-ban"></i> Delete</button>



                    <a href="{{ route('admin.admins.password.edit', $admin->id) }}" title="Edit password"><i class="fa fa-key"></i></a>


                </td>

            </tr>
        @endforeach

        </tbody>

    </table>


     <div class="modal fade" id="edit-admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                     <h4 class="modal-title" id="myModalLabel">Edit Administrator</h4>
                 </div>
                 <div class="modal-body">
                     <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">

                         <div class="form-group error">
                             <label for="inputTask" class="col-sm-3 control-label">Name</label>
                             <div class="col-sm-9">
                                 <input type="text" class="form-control has-error" id="name" name="name" placeholder="Name" value="">
                             </div>
                         </div>

                         <div class="form-group">
                             <label for="inputEmail3" class="col-sm-3 control-label">Email address</label>
                             <div class="col-sm-9">
                                 <input type="text" class="form-control" id="email" name="email" placeholder="Email address" value="">
                             </div>
                         </div>
                     </form>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-primary" id="btn-update" value="add">Submit</button>
                     <input type="hidden" id="admin_id" name="admin_id" value="0">
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

        //Edit Administrator
        $('.edit-modal').click(function(){
            var admin_id = $(this).val();

            $.get('admins/edit/' + admin_id, function (data) {

                //success data
                $('#admin_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);

                $('#edit-admin').modal('show');
            })
        });
        ////////////////////////////////////////////////////////////////////

        //Update Administrator
        $("#btn-update").click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })

            e.preventDefault();

            var formData = {
                name: $('#name').val(),
                email: $('#email').val(),
            }

            //used to determine the http verb to use [add=POST], [update=PUT]
            var state = $('#btn-update').val();
            var admin_id = $('#admin_id').val();


            //console.log(formData);

            $.ajax({

                type: 'POST',
                url: '/admin/admins/update/' + admin_id,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    console.log(data);


                    $('#edit-admin').modal('hide')
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });


        //display modal form for creating new task
        $('#btn-add').click(function(){
            $('#btn-save').val("add");
            $('#frmTasks').trigger("reset");
            $('#myModal').modal('show');
        });

        //delete task and remove it from list
        $('.delete-task').click(function(){
            var task_id = $(this).val();

            $.ajax({

                type: "DELETE",
                url: url + '/' + admin_id,
                success: function (data) {
                    console.log(data);

                    $("#task" + admin_id).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });



    </script>
@endsection
