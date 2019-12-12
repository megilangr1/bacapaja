@extends('backend.layout.master')

@section('css')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('') }}plugins/summernote/summernote-bs4.css">
@endsection

@section('judul', 'Artikel Baru')

@section('content')
<div class="col-md-12">
    <div class="card card-dark">
        <div class="card-header">
            <h4 class="card-title">
                Form Artikel
            </h4>

            <div class="card-tools">
                <a href="{{ route('artikel.index') }}" class="btn btn-danger btn-sm">
                    <i class="fa fa-arrow-left"></i> &ensp;
                    Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('artikel.update', Crypt::encrypt($post->id)) }}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Judul Arikel : <i class="text-danger">*</i></label>
                    <input type="text" name="judul" id="judul"
                        class="form-control {{ $errors->has('judul') ? 'is-invalid':'' }}" required autofocus
                        value="{{ $post->title }}">
                    <p class="text-danger">{{ $errors->first('judul') }}</p>
                </div>
                <div class="form-group">
                    <label for="">Sub Judul Artikel : <i class="text-danger">*</i></label>
                    <textarea name="sub" id="sub" class="form-control {{ $errors->has('sub') ? 'is-invalid':'' }}" rows="3" required>{{ $post->subtitle }}</textarea>
                    <p class="text-danger">{{ $errors->first('sub') }}</p>
                </div>
                <div class="form-group">
                    <label for="">Kategori Artikel</label>
                    <select name="category_id" id="category_id" class="form-control select2" style="width:100%;" data-placeholder="Pilih Kategori Artikel" required>
                        <option value=""></option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}" {{ $post->category_id == $item->id ? 'selected':'' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Photo Artikel</label>
                    <p>
                        <a href="{{ asset('storage/post').'/'.$post->image }}" target="_blank">
                            <img src="{{ asset('storage/post').'/'.$post->image }}" alt="{{ $post->image }}" class="img-fluid" width="240px" height="240px;" >
                        </a>
                    </p>
                    <input type="file" name="photo" id="photo" class="form-control {{ $errors->has('photo') ? 'is-invalid':'' }}" value="{{ old('photo') }}">
                </div>
                <div class="form-group">
                    <label for="">Isi Artikel : </label>
                    {{-- <textarea class="isi" name="content" required placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $post->content }}</textarea> --}}
                    <textarea class="isi form-control" id="isi" name="content" required placeholder="" style="">{{ $post->content }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-check"></i> &ensp;
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('artikel.index') }}" class="btn btn-sm btn-danger">
                        <i class="fa fa-undo"></i> &ensp;
                        Batalkan Perubahan
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

<!-- Summernote -->
<script src="{{ asset('') }}plugins/summernote/summernote-bs4.min.js"></script>
<script>
$(function () {
    // Summernote
    // $('.isi').summernote()
		
		CKEDITOR.replace( 'isi' );
})
</script>
@endsection
