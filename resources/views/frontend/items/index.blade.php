@extends('layouts.public')

@section('htmlheader_title')
   {{ trans('words.my_recipes') }}
@endsection

@section('contentheader_title')
    {{ trans('words.my_recipes') }}
@endsection

@section('sidebar')
    @include('layouts.partials.frontend.menu_items')
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
            <th>{{ trans('words.image') }}</th>
            <th>{{ trans('words.name') }}</th>
            <th>{{ trans('words.category') }}</th>
            <th>{{ trans('words.date_published') }}</th>
            <th>{{ trans('words.actions') }}</th>

        </tr>
        </thead>
        <tbody>


        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><a href="{{ route('web.item', $item->id) }}">
                        @if(($item->image != null) ||($item->image != ""))
                            <img class="lazy img-responsive" data-original="{{ $item->image }}" width="150" alt="{{ $item->name }}">
                            <noscript>
                                <img class="img-responsive" src="{{ $item->image }}" width="150" alt="{{ $item->name }}">
                            </noscript>
                        @else
                            <img class="lazy img-responsive" data-original="{{ asset('public/images/no-image.png') }}" alt="{{ $item->name }}" width="150">
                            <noscript>
                                <img class="img-responsive" src="{{ $item->image }}" width="150"  alt="{{ $item->name }}">
                            </noscript>
                        @endif
                    </a></td>
                <td><a href="{{ route('web.item', $item->id) }}">{{ $item->name }}</a></td>
                <td><a href="{{ route('web.category', $item->category_id) }}">{{ $item->categories->name }}</a></td>
                <td>{{ date('d.m.Y', strtotime($item->created_at)) }}</td>
                <td>
                  	<a href="{{ route('user.items.edit', $item->id) }}"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="{{ trans('words.edit_item') }}"></i></a>


                    <a data-href="{{ route('user.items.destroy', $item->id) }}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="{{ trans('words.delete_item') }} "></i></a>

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
                "iDisplayLength": 10,
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
