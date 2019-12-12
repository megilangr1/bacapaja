@extends('backend.layout.master')

@section('judul', 'Manajemen Kategori')

@section('content')
<div class="col-md-4">
    <div class="card card-dark">
        <div class="card-header">
            <h4 class="card-title">
                Form Kategori
            </h4>
        </div>
        <div class="card-body">
            <form
                action="{{ isset($edit) ? route('kategori.update', Crypt::encrypt($edit->id)) : route('kategori.store') }}"
                method="post" class="form">
                @csrf
                @if (isset($edit))
                @method('PUT')
                @endif

                <div class="form-group">
                    <label for="">Nama Kategori : <i class="text-danger">*</i></label>
                    <input type="text" name="name" id="name"
                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required autofocus
                        value="{{ isset($edit) ? $edit->name:old('name') }}">
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>

                <div class="form-group">
                    @if (isset($edit))
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-save"></i> &ensp;
                        Simpan Perubahan Data
                    </button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-danger">
                        <i class="fa fa-times"></i> &ensp;
                        Batal Merubah Data
                    </a>
                    @else
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-check"></i> &ensp;
                        Tambah Kategori
                    </button>
                    <button type="reset" class="btn btn-sm btn-danger">
                        <i class="fa fa-undo"></i> &ensp;
                        Reset Input
                    </button>
                    @endif
                    <p class="text-danger">
                        <sub>Keterangan : * Wajib di-Isi</sub>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title">
                Data Kategori
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dTable1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Artikel Terkait</th>
                            <th>Tanggal Buat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($category as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>#</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <form action="{{ route('kategori.destroy', Crypt::encrypt($item->id)) }}" method="post"
                                    class="form">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('kategori.edit', Crypt::encrypt($item->id)) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin Untuk Melakukan Menghapus Data Ini ?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
