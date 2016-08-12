@extends('layouts.public')

@section('htmlheader_title')
    {{ trans('phrases.resend_verification_code') }}
@endsection

@section('contentheader_title')
    {{ trans('phrases.resend_verification_code') }}
@endsection

@section('sidebar')
    @include('layouts.partials.frontend.menu_categories')
@endsection

@section('main-content')



    <form class="form-horizontal"  id="registerForm" role="form" method="POST" action="{{ url('verification_resend') }}">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-4 control-label">{{ trans('words.email') }}</label>

            <div class="col-md-6">
                <input type="email" class="form-control" id="email" placeholder="{{ trans('words.email') }}" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                    }


                }
            });
        });
    </script>
@endsection