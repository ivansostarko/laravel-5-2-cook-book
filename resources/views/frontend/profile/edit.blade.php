@extends('layouts.public')

@section('htmlheader_title')
    Edit Profile
@endsection

@section('contentheader_title')
    Edit Profile
@endsection

@section('sidebar')
    @include('layouts.partials.frontend.menu_profile')
@endsection

@section('main-content')

    <form id="editProfileForm" class="form-horizontal" role="form" method="POST" action="{{ url('/profile/update') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="col-sm-2">
                <label for="name" class="control-label">Name</label>
            </div>
            <div class="col-sm-10">
                <input id="name" id="name" type="text"  class="form-control"  name="name" value="{{$user->name}}" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputPassword3" class="control-label">Email</label>
            </div>
            <div class="col-sm-10">

                <input id="email" class="form-control" type="email"  name="email" value="{{$user->email}}" placeholder="Email address">
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
                                message: 'The Name is required'
                            }
                        }
                    },

                    email: {
                        validators: {
                            notEmpty: {
                                message: 'The Email is required'
                            }
                        }
                    }


                }
            });
        });
    </script>
@endsection