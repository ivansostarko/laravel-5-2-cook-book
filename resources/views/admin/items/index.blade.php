@extends('layouts.admin')

@section('htmlheader_title')
    {{ trans('words.items') }}
@endsection

@section('contentheader_title')
    {{ trans('words.items') }}
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
            <th>{{ trans('words.image') }}</th>
            <th>{{ trans('words.name') }}</th>
            <th>{{ trans('words.user') }}</th>
            <th>{{ trans('words.category') }}</th>
            <th>{{ trans('words.date') }}</th>
            <th>{{ trans('words.actions') }}</th>
        </tr>
        </thead>
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



            $('#items-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.items.ajax') !!}',
                columns: [
                    { data: 'item_id', name: 'item_id' },
                    { data: 'image', name: 'image' },
                    { data: 'name', name: 'name' },
                    { data: 'author', name: 'author' },
                    { data: 'category', name: 'category' },
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: true, searchable: true}
                ]

            });

            //Init tooltip
            $('[data-toggle="tooltip"]').tooltip();

            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        });

    </script>
@endsection
