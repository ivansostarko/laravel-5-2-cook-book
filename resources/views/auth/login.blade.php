@extends('layouts.public')

@section('htmlheader_title')
    {{ trans('words.login') }}
@endsection

@section('contentheader_title')
    {{ trans('words.login') }}
@endsection

@section('sidebar')
    @include('layouts.partials.frontend.menu_categories')
@endsection

@section('main-content')
    @if (Session::has('message'))
        <div class="alert alert-{{ Session::get('message_type') }}" role="alert">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif

    <form id="loginForm" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">  {{ trans('words.email') }}</label>

            <div class="col-md-6">
                <input type="email" class="form-control" id="email" placeholder="  {{ trans('words.email') }}" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">  {{ trans('words.password') }}</label>

            <div class="col-md-6">
                <input type="password" id="password" class="form-control" placeholder="{{ trans('words.password') }}" name="password">

                @if ($errors->has('password'))
                    <span class="help-block"> <strong>{{ $errors->first('password') }}</strong></span>
                @endif

            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember">  {{ trans('words.remember') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    {{ trans('words.login') }}
                </button>


            </div>
            </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
            <a class="btn btn-link" href="{{ route('password.get.email') }}">{{ trans('words.forgot') }}</a>
            <a class="btn btn-link" href="{{ route('verification.resend.edit') }}">{{ trans('words.resend_code') }}</a>
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

            $('#loginForm').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: '{{ trans('validation.email_is_required') }}'
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
                                message: '{{ trans('validation.password_is_required') }}'
                            }
                        }
                    }


                }
            });
        });
    </script>
@endsection