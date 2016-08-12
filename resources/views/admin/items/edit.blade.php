@extends('layouts.admin')

@section('htmlheader_title')
    {{ trans('words.edit_item') }}
@endsection

@section('contentheader_title')
    {{ trans('words.edit_item') }}
@endsection

@section('sidebar')
    @include('layouts.partials.admin.menu_profile')
@endsection

@section('main-content')



    <form class="form-horizontal" id="Form" role="form" method="POST" enctype="multipart/form-data"
          action="{{ url('/admin/items/update/') }}/{{ $items->id }}">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label"> {{ trans('words.name') }}</label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder=" {{ trans('words.name') }}"
                       value="{{ $items->name }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputPassword3" class="control-label"> {{ trans('words.category') }}</label>
            </div>
            <div class="col-sm-10">
                <select class="form-control" id="category" name="category">

                    @foreach($categories as $category)
                        @if($category->id  ==  $items->category_id)
                            <option value="{{$category->id}}" selected>{{$category->name}}</option>

                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label"> {{ trans('words.ingredients') }}</label>
            </div>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="ingredients"
                          id="ingredients">{{ $items->ingredients }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label"> {{ trans('words.directions') }}</label>
            </div>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="directions"
                          id="directions">{{ $items->content }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label"> {{ trans('words.preparation_time') }}</label>
            </div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" id="time" name="time"
                           placeholder=" {{ trans('words.preparation_time') }}" value="{{ $items->time }}"
                           aria-describedby="basic-addon2">
                    <span class="input-group-addon" id="basic-addon2"> {{ trans('words.minutes') }}</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">
                <label for="inputEmail3" class="control-label">Image</label>
            </div>
            <div class="col-sm-10">

                <div class="col-sm-3"><img src="../../../{{ $items->image }}" width="150px"></div>
                <div class="col-sm-9">
                    <div class="input-group">
                        <label class="input-group-btn">
                    <span class="btn btn-primary">
                         {{ trans('words.browse') }}&hellip; <input type="file" id="file" name="file"
                                                                    style="display: none;" multiple>
                    </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                    </div>
                </div>


            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default"> {{ trans('words.submit') }}</button>
            </div>
        </div>
    </form>


@endsection

@section('styles')
    <link href="{{ asset('/public/plugins/validation/css/formValidation.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/node_modules/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/public/plugins/validation/js/formValidation.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('/public/plugins/validation/js/framework/bootstrap.min.js') }}"></script>



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
                                message: '{{ trans('validation.name_is_required') }}'
                            }
                        }
                    },

                    category: {
                        validators: {
                            notEmpty: {
                                message: '{{ trans('validation.select_category') }}'
                            }
                        }
                    },
                    time: {
                        validators: {
                            notEmpty: {
                                message: '{{ trans('validation.preparation_time_required') }}'
                            },
                            numeric: {
                                message: '{{ trans('validation.preparation_time_invalid') }}',
                                // The default separators
                                thousandsSeparator: '',
                                decimalSeparator: '.'
                            }
                        }
                    }


                }
            });

            CKEDITOR.replace('directions');
            CKEDITOR.replace('ingredients');


            $(document).on('change', ':file', function () {
                var input = $(this),
                        numFiles = input.get(0).files ? input.get(0).files.length : 1,
                        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });


            $(document).ready(function () {
                $(':file').on('fileselect', function (event, numFiles, label) {

                    var input = $(this).parents('.input-group').find(':text'),
                            log = numFiles > 1 ? numFiles + ' files selected' : label;

                    if (input.length) {
                        input.val(log);
                    } else {
                        if (log) alert(log);
                    }

                });
            });
        });

    </script>
@endsection
