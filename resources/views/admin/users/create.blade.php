@extends('layouts.admin')

@section('htmlheader_title')
    {{ trans('words.create_new_account') }}
@endsection

@section('contentheader_title')
    {{ trans('words.create_new_account') }}
@endsection

@section('sidebar')
    @include('layouts.partials.admin.menu_profile')
@endsection

@section('main-content')



    <form class="form-horizontal"  id="registerForm" role="form" method="POST" action="{{ url('/admin/users/store') }}">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">  {{ trans('words.name') }}</label>

            <div class="col-md-6">
                <input type="text" class="form-control" id="name" placeholder="{{ trans('words.name') }}" name="name"
                       value="{{ old('name') }}">

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">  {{ trans('words.email') }}s</label>

            <div class="col-md-6">
                <input type="email" class="form-control" id="email" placeholder="{{ trans('words.email') }}"
                       name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">{{ trans('words.password') }}</label>

            <div class="col-md-6">
                <input type="password" class="form-control" placeholder="{{ trans('words.email') }}" id="password"
                       name="password">

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label"
                   name="password_confirmation1">{{ trans('words.confirm_password') }}</label>

            <div class="col-md-6">
                <input type="password" class="form-control" id="password_confirmation"
                       placeholder="{{ trans('words.confirm_password') }}" name="password_confirmation">

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
                    {{ trans('words.submit') }}
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
                                message: '{{ trans('validation.name_is_required') }}'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: '{{ trans('validation.email_is_required') }}'
                            },

                            regexp: {
                                regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                                message: '{{ trans('validation.email_invalid') }}'
                            }
                        }
                    },

                    password: {
                        validators: {
                            notEmpty: {
                                message: '{{ trans('validation.password_is_required') }}'
                            },
                            identical: {
                                field: 'password_confirmation',
                                message: '{{ trans('validation.password_is_not_same') }}'
                            }
                        }
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: '{{ trans('validation.password_is_required') }}'
                            },
                            identical: {
                                field: 'password',
                                message: '{{ trans('validation.password_is_not_same') }}'
                            }
                        }
                    }


                }
            });
        });
    </script>
@endsection