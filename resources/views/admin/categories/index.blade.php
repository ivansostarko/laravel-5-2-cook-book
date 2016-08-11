@extends('layouts.admin')

@section('htmlheader_title')
   Categories
@endsection

@section('contentheader_title')
    Categories <a href="{{ route('admin.categories.create') }}" class="btn btn-primary pull-right btn-xl" type="button">Insert new category</a>
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
            <th>Image</th>
            <th>Name</th>
          <th>Date published</th>
            <th>Actions</th>

        </tr>
        </thead>
        <tbody>


        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>
                    @if(($category->image != null) ||($category->image != ""))
                        <img class="lazy img-responsive" data-original="../{{ $category->image }}" width="150" alt="{{ $category->name }}">
                        <noscript>
                            <img class="img-responsive" src="../{{ $category->image }}" width="150" alt="{{ $category->name }}">
                        </noscript>
                    @else
                        <img class="lazy img-responsive" data-original="{{ asset('public/images/no-image.png') }}" alt="{{ $category->name }}" width="150">
                        <noscript>
                            <img class="img-responsive" src="../{{ $category->image }}" width="150"  alt="{{ $category->name }}">
                        </noscript>
                    @endif
                </td>
                <td>{{ $category->name }}</td>
                <td>{{ date('d.m.Y', strtotime($category->created_at)) }}</td>
                <td>
                  	<a href="{{ route('admin.categories.edit', $category->id) }}"><i class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" title="Edit Category"></i></a>
                    <a href="#"  data-href="{{ route('admin.categories.destroy', $category->id) }}" data-toggle="modal" data-target="#confirm-delete" title="Delete file"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="Delete Category"></i></a>

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
