@extends('frontend.layout.master')

@section('content')
<div class="row">
@php $bg = 0; @endphp
@forelse ($categories as $item)
	@php
		$bg = rand(0, 10);
		switch ($bg) {
			case '1': $color = 'bg-indigo'; break;
			case '2': $color = 'bg-navy'; break;
			case '3': $color = 'bg-purple'; break;
			case '4': $color = 'bg-fuchsia'; break;
			case '5': $color = 'bg-pink'; break;
			case '6': $color = 'bg-maroon'; break;
			case '7': $color = 'bg-orange'; break;
			case '8': $color = 'bg-lime'; break;
			case '9': $color = 'bg-teal'; break;
			case '10': $color = 'bg-olive'; break;
			default: $color = 'bg-light'; break;
		}
	@endphp
	<div class="col-md-4">
		<div class="card card-widget widget-user-2">
			<div class="widget-user-header {{ $color }}" style="border-radius: .25rem;">
				<div class="widget-user-image">
					<img class="img-circle elevation-2" src="{{ asset('images/category-image.jpg') }}" alt="User Avatar">
				</div>
				<h3 class="widget-user-username">{{ $item->name }}</h3>
				<h5 class="widget-user-desc">Jumlah Artikel : {{ $item->post->count() }}</h5>
			</div>
		</div>
	</div>
@empty

@endforelse
</div>

@endsection
