@extends('frontend.layout.master')

@section('headTitle')
		Baca Apa Aja !
@endsection

@section('content')

@if (session()->has('kategori'))
<div class="row">
	<div class="col-12">
		<h3>Artikel Postingan Berdasarkan Kategori {{ session()->get('kategori') }}</h3>
		<hr>
	</div>
</div>
@endif

@forelse ($post as $item)
<div class="row no-gutters border overflow-hidden flex-md-row mb-2 shadow-sm h-md-250 position-relative">
    <div class="col-4 d-none d-lg-block">
				<a href="{{ route('baca', str_replace(' ','-', $item->title)) }}">
					<img src="{{ asset('storage/post').'/'.$item->image }}" alt="Iklan-02" class="img-fluid" style="widht: 260px !important; height: 180px;">
        </a>
    </div>
    <div class="col pl-4 pb-4 pr-4 pt-2 d-flex flex-column position-static">
        <h4 class="mb-0">
            <a href="{{ route('baca', str_replace(' ','-', $item->title)) }}">{{ $item->title }}</a>
        </h4>
        <div class="mb-2 text-muted">
            {{ date('d-m-Y', strtotime($item->published_at)) }} | Admin
        </div>
        <p class="mb-auto">
            {{ str_limit($item->subtitle, 30) }}
            {{-- {!! $item->content !!} --}}
        </p>
        {{-- <p href="#" class="stretched-link"><a href="#">Lanjutkan Membaca...</a></p> --}}
        <p><a href="{{ route('baca', str_replace(' ','-', $item->title)) }}">Lanjutkan Membaca...</a></p>
    </div>
</div>
@empty

@endforelse

{{ $post->links() }}

@endsection
