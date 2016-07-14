@extends('layouts.public')

@section('htmlheader_title')
{{ $query }}
@endsection

@section('contentheader_title')
Results for: {{ $query}}
@endsection

@section('sidebar')
	@include('layouts.partials.frontend.menu_categories')
@endsection

@section('main-content')


  @if (count($items) === 0)
	  <p>No results found</p>
  @elseif (count($items) >= 1)

	  @foreach($items as $item)

		  <div class="row">
			  <div class="col-md-7">
				  <a href="{{ route('web.item', $item->id) }}">
					  @if(($item->image != null) ||($item->image != ""))
						  <img class="lazy img-responsive" data-original="../{{ $item->image }}" width="443" height="249" alt="{{ $item->name }}">
						  <noscript>
							  <img class="img-responsive" src="../{{ $item->image }}" width="443" height="249" alt="{{ $item->name }}">
						  </noscript>
					  @else
						  <img class="lazy img-responsive" data-original="{{ asset('public/images/no-image.png') }}" alt="{{ $item->name }}" width="443" height="249">
						  <noscript>
							  <img class="img-responsive" src="{{ $item->image }}" width="443" height="249" alt="{{ $item->name }}">
						  </noscript>
					  @endif
				  </a>
			  </div>
			  <div class="col-md-5">
				  <h3><a href="{{ route('web.item', $item->id) }}">{{ $item->name }}</a></h3>
				  <?php $content = str_limit($item->content, $limit = 300, $end = '...') ?>
				  <p>  {!!html_entity_decode($content)!!}</p>
				  <a class="btn btn-primary" href="{{ route('web.item', $item->id) }}">View more...</a>
			  </div>
		  </div>
		  <hr />

	  @endforeach

	  {{ $items->links() }}
  @endif






@endsection

@section('styles')
@endsection


@section('scripts')
@endsection