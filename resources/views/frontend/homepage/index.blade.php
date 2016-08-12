@extends('layouts.public')

@section('htmlheader_title')
    {{ trans('words.homepage') }}
@endsection

@section('contentheader_title')
    {{ trans('words.latest_recipes') }}
@endsection

@section('sidebar')
    @include('layouts.partials.frontend.menu_categories')
@endsection

@section('main-content')



    @if (Session::has('message'))
        <center><b>{{ Session::get('message') }}</b></center>
    @endif


    <div class="row">
        @foreach($items as $item)


            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <a href="{{ route('web.item', $item->id) }}">
                        @if(($item->image != null) ||($item->image != ""))
                            <img class="lazy img-responsive" data-original="{{ $item->image }}" width="230"
                                 height="129">
                            <noscript>
                                <img class="img-responsive" src="{{ $item->image }}" width="230" height="129">
                            </noscript>
                        @else
                            <img class="lazy img-responsive" data-original="{{ asset('public/images/no-image.png') }}"
                                 width="230" height="129">
                            <noscript>
                                <img class="img-responsive" src="{{ $item->image }}" width="230" height="129">
                            </noscript>
                        @endif

                    </a>
                    <div class="caption">
                        <h4><a href="{{ route('web.item', $item->id) }}">{{ $item->name }}</a></h4>
                    </div>
                </div>
            </div>


        @endforeach
    </div>

@endsection

