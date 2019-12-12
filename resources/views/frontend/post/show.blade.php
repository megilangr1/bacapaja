@extends('frontend.layout.master')

@section('css')
	<style>
		img {
			width: 100% !important;
			height: auto !important;
		}
	</style>
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
    </div>
</div>
@endsection
