@extends('layouts.admin')

@section('htmlheader_title')
    Edit category
@endsection

@section('contentheader_title')
    Edit category
@endsection

@section('sidebar')
    @include('layouts.partials.admin.menu_profile')
@endsection

@section('main-content')



    <form class="form-horizontal" id="Form" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/admin/categories/update/') }}/{{ $category->id }}">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Name</label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $category->name }}">
            </div>
        </div>



        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Image</label>
            </div>
            <div class="col-sm-10">

                <div class="col-sm-3"><img src="../../../{{ $category->image }}" width="150px"></div>
                <div class="col-sm-9"> <div class="input-group">
                        <label class="input-group-btn">
                    <span class="btn btn-primary">
                        Browse&hellip; <input type="file" id="file" name="file" style="display: none;" multiple>
                    </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                    </div></div>


            </div>
        </div>





        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>


@endsection

@section('styles')
    <link href="{{ asset('/public/plugins/validation/css/formValidation.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/public/plugins/validation/js/formValidation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/public/plugins/validation/js/framework/bootstrap.min.js') }}"></script>



    <script type="text/javascript">
        $(function () {

            $('#Form').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'The Name is required'
                            }
                        }
                    },

                    category: {
                        validators: {
                            notEmpty: {
                                message: 'Please select your native language.'
                            }
                        }
                    },
                    time: {
                        validators: {
                            notEmpty: {
                                message: 'Please select your native language.'
                            },
                            numeric: {
                                message: 'The value is not a number',
                                // The default separators
                                thousandsSeparator: '',
                                decimalSeparator: '.'
                            }
                        }
                    }


                }
            });

            CKEDITOR.replace( 'directions' );
            CKEDITOR.replace( 'ingredients' );

            // We can attach the `fileselect` event to all file inputs on the page
            $(document).on('change', ':file', function() {
                var input = $(this),
                        numFiles = input.get(0).files ? input.get(0).files.length : 1,
                        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            // We can watch for our custom `fileselect` event like this
            $(document).ready( function() {
                $(':file').on('fileselect', function(event, numFiles, label) {

                    var input = $(this).parents('.input-group').find(':text'),
                            log = numFiles > 1 ? numFiles + ' files selected' : label;

                    if( input.length ) {
                        input.val(log);
                    } else {
                        if( log ) alert(log);
                    }

                });
            });
        });

    </script>
@endsection
