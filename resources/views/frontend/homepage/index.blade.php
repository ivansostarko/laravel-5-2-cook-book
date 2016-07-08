@extends('layouts.public')

@section('htmlheader_title')
	Homepage
@endsection

@section('contentheader_title')
    Latest recipes
@endsection

@section('sidebar')
	@include('layouts.partials.frontend.menu_categories')
@endsection

@section('main-content')



	@if (Session::has('message'))

						<center>	<b>{{ Session::get('message') }}</b></center>
@endif


	<div class="row">
	@foreach($items as $item)


			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<a href="{{ route('web.item', $item->id) }}"><img src="{{ $item->image }}" alt="{{ $item->name }}" class="img-responsive"></a>
					<div class="caption">
						<h4><a href="{{ route('web.item', $item->id) }}">{{ $item->name }}</a></h4>
					</div>
				</div>
			</div>


@endforeach
	</div>
	{{ $items->links() }}
@endsection
