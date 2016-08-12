@extends('layouts.admin')

@section('htmlheader_title')
  {{ trans('words.activities') }}
@endsection

@section('contentheader_title')
    {{ trans('words.activities') }} <a data-href="{{ route('admin.activities.clear') }}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-primary pull-right btn-xl" type="button">{{ trans('words.clear_logs') }}</a>
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
            <th>{{ trans('words.user') }}</th>
            <th>{{ trans('words.action') }}</th>
            <th>{{ trans('words.ip_address') }}</th>
            <th>{{ trans('words.date') }}</th>


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
    <link href="{{ asset('/node_modules/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/node_modules/datatables-bootstrap/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
    <script src="{{ asset('/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/node_modules/datatables-bootstrap/js/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {

            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });

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