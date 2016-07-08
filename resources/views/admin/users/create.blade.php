@extends('layouts.admin')

@section('htmlheader_title')
    Register
@endsection

@section('contentheader_title')
    Register new user
@endsection

@section('sidebar')
    @include('layouts.partials.admin.menu_profile')
@endsection

@section('main-content')



    <form class="form-horizontal"  id="registerForm" role="form" method="POST" action="{{ url('/admin/users/store') }}">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
                <input type="password" class="form-control" id="password" name="password">

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label" name="password_confirmation1">Confirm Password</label>

            <div class="col-md-6">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
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

            $('#registerForm').formValidation({
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
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'The Email is required'
                            },

                            regexp: {
                                regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                                message: 'The value is not a valid email address'
                            }
                        }
                    },

                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The Password is required'
                            },
                            identical: {
                                field: 'password_confirmation',
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: 'The Confirm password is required1'
                            },
                            identical: {
                                field: 'password',
                                message: 'The password and its confirm are not the same'
                            }
                        }}


                }
            });
        });
    </script>
@endsection