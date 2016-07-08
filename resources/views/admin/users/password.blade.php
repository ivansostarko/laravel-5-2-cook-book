@extends('layouts.admin')

@section('htmlheader_title')
    Edit password
@endsection

@section('contentheader_title')
    Edit Password
@endsection

@section('sidebar')
    @include('layouts.partials.admin.menu_profile')
@endsection

@section('main-content')


    <form id="editPasswordForm" class="form-horizontal" role="form" method="POST" action="{{ url('/admin/users/password/update', $user->id) }}">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="col-sm-2">
                <label for="name" class="control-label">Password</label>
            </div>
            <div class="col-sm-10">
                <input id="password" type="password"  class="form-control" name="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputPassword3" class="control-label">Confirm</label>
            </div>
            <div class="col-sm-10">

                <input id="password2" type="password"  class="form-control" name="password2" placeholder="Confirm password">
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

            $('#editPasswordForm').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The Password is required'
                            },
                            identical: {
                                field: 'password2',
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                    password2: {
                        validators: {
                            notEmpty: {
                                message: 'The Confirm password is required'
                            },
                            identical: {
                                field: 'password',
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    }


                }
            })
        });

    </script>
@endsection