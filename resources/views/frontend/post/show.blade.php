@extends('frontend.layout.master')

@section('css')
	<style>
		img {
			width: 100% !important;
			height: auto !important;
		}
	</style>
@endsection

@section('headTitle')
		{{ $post->title }}
@endsection

@section('content')
<div class="row no-gutters border overflow-hidden flex-md-row mb-2 shadow-sm h-md-250 position-relative">
    <div class="col-md-12 col-sm-12 col-lg-12 p-4">
        <h3>
            <b>
                {{ $post->title }}
            </b>
        </h3>
        Kategori :
        <a href="{{ route('frontend.kategori', str_replace(' ', '-', $post->category->name) ) }}">{{ $post->category->name }} </a>
        |
        Tanggal Publikasi :
        @if ($post->publish == '0')
            <p class="badge badge-danger">
                Belum di-Publikasi
            </p>
        @else
            {{ date('d-m-Y H:i:s', strtotime($post->published_at)) }}
        @endif
        <hr>
        <div class="text-center">
            <img src="{{ asset('storage/post').'/'.$post->image }}" alt="{{ $post->title }}" class="img-fluid">
            <p class="mt-3">
                <b>
                    {!! $post->subtitle !!}
                </b>
            </p>
        </div>
        <hr>
        <p class="mt-3 pt-3">
						{!! $post->content !!}
				</p>
				
				<hr>
					<h4>Incoming search terms</h4>
				
					<ul>
						@foreach ($post->incomingsearch as $item)
							<li>{{ $item->search }}</li>
						@endforeach
					</ul>
				<hr>

				<div id="disqus_thread"></div>
				<script>
					(function() {
					var d = document, s = d.createElement('script');
					s.src = 'https://bacapaja.disqus.com/embed.js';
					s.setAttribute('data-timestamp', +new Date());
					(d.head || d.body).appendChild(s);
					})();
				</script>
				<noscript>
					Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
				</noscript>
				
    </div>
</div>
@endsection
