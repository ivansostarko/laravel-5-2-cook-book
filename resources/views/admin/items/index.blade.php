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

    <table class="table" id="main_table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Author</th>
            <th>Category</th>
            <th>Date published</th>
            <th>Actions</th>

        </tr>
        </thead>
        <tbody>


        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><a href="{{ route('web.item', $item->id) }}">
                        @if(($item->image != null) ||($item->image != ""))
                            <img class="lazy img-responsive" data-original="../{{ $item->image }}" width="150" alt="{{ $item->name }}">
                            <noscript>
                                <img class="img-responsive" src="../{{ $item->image }}" width="150" alt="{{ $item->name }}">
                            </noscript>
                        @else
                            <img class="lazy img-responsive" data-original="{{ asset('public/images/no-image.png') }}" alt="{{ $item->name }}" width="150">
                            <noscript>
                                <img class="img-responsive" src="../{{ $item->image }}" width="150"  alt="{{ $item->name }}">
                            </noscript>
                        @endif
                    </a></td>
                <td><a href="{{ route('web.item', $item->id) }}">{{ $item->name }}</a></td>
                <td>{{ $item->users->name }}</td>
                <td>{{ $item->categories->name}}</td>
                <td>{{ date('d.m.Y', strtotime($item->created_at)) }}</td>
                <td>
                  	<a href="{{ route('admin.items.edit', $item->id) }}"><i class="fa fa-pencil"></i></a>


                    <a href="{{ route('admin.items.destroy', $item->id) }}" title="Delete file"><i class="fa fa-ban"></i></a>

                </td>

            </tr>
        @endforeach

        </tbody>

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
