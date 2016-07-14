@extends('layouts.public')

@section('htmlheader_title')
{{$item->name}}
@endsection

@section('contentheader_title')
    <h1 class="title">{{$item->name}}</h1>
@endsection

@section('sidebar')
  @include('layouts.partials.frontend.menu_categories')
@endsection

@section('main-content')





  @if(($item->image != null) ||($item->image != ""))
    <img class="lazy img-responsive" data-original="../{{ $item->image }}" width="100%" >
    <noscript>
      <img class="img-responsive" src="../{{ $item->image }}" width="100%">
    </noscript>
  @else
    <img class="lazy img-responsive" data-original="{{ asset('public/images/no-image.png') }}" width="100%">
    <noscript>
      <img class="img-responsive" src="../{{ $item->image }}" width="100%">
    </noscript>
  @endif


    <h2>Ingredients</h2>
  <div>
    {!!html_entity_decode($item->ingredients)!!}
  </div>
  <h2>Directions </h2>
  <div>
  {!!html_entity_decode($item->content)!!}
</div>



  <table class="table" width="100%">
    <tr>
      <td><i class="fa fa-clock-o" aria-hidden="true"></i> Preparation time:</td>
      <th>{{$item->time}} minutes</th>
    </tr>
    <tr>
      <td><i class="fa fa-user" aria-hidden="true"></i> Reciept by</td>
      <th><a href="mailto:{{$item->users->email}}">{{$item->users->name}} </a></th>
    </tr>
    <tr>
      <td><i class="fa fa-calendar" aria-hidden="true"></i> Date published</td>
      <td>{{ date('d.m.Y', strtotime($item->created_at)) }}</td>
    </tr>
  </table>
@endsection

@section('styles')
@endsection


@section('scripts')
@endsection
