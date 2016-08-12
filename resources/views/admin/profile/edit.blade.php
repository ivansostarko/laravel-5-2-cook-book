@extends('layouts.admin')

@section('htmlheader_title')
    {{ trans('words.edit_profile') }}
@endsection

@section('contentheader_title')
    {{ trans('words.edit_profile') }}
@endsection

@section('sidebar')
    @include('layouts.partials.admin.menu_profile')
@endsection

@section('main-content')

    <form id="editProfileForm" class="form-horizontal" role="form" method="POST" action="{{ url('admin/profile/update') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="col-sm-2">
                <label for="name" class="control-label">{{ trans('words.name') }}</label>
            </div>
            <div class="col-sm-10">
                <input id="name" id="name" type="text"  class="form-control"  name="name" value="{{$user->name}}" placeholder="{{ trans('words.name') }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputPassword3" class="control-label">{{ trans('words.email') }}</label>
            </div>
            <div class="col-sm-10">

                <input id="email" class="form-control" type="email"  name="email" value="{{$user->email}}" placeholder="{{ trans('words.email') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">{{ trans('words.submit') }}</button>
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

            $('#editProfileForm').formValidation({
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
                            }
                        }
                    }


                }
            });
        });
    </script>
@endsection