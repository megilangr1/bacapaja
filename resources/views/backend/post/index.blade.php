@extends('backend.layout.master')

@section('judul', 'Manajemen Artikel')

@section('content')
<div class="col-md-12">
    <div class="card card-dark">
        <div class="card-header">
            <h4 class="card-title">
                Data Artikel
            </h4>

            <div class="card-tools">
                <a href="{{ route('artikel.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>
                    Buat Postingan Artikel Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dTable1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul Artikel</th>
                            <th>Sub Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($post as $item)
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td width="20%">{{ $item->title }}</td>
                                <td width="25%">{{ $item->subtitle }}</td>
                                <td width="10%">{{ $item->category->name }}</td>
                                <td width="15%" class="text-center">
                                    <form action="{{ route('publish', Crypt::encrypt($item->id)) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @if ($item->publish == '1')
                                            <button class="btn btn-xs btn-block btn-success" title="Klik Untuk Mematikan Postingan" onclick="return confirm('Matikan Artikel ?')">
                                                Sudah di-Publikasi
                                            </button>
                                        @else
                                            <button class="btn btn-xs btn-block btn-danger" title="Klik Untuk Mempublikasikan Artikel" onclick="return confirm('Publikasikan Artikel?')">
                                                Belum di-Publikasi
                                            </button>
                                        @endif
                                    </form>
                                </td>
                                <td width="15%">
                                    <form action="{{ route('artikel.destroy', Crypt::encrypt($item->id)) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ route('baca', str_replace(' ','-', $item->title)) }}" target="_blank" class="btn btn-info btn-sm" title="Lihat Artikel">
                                            <i class="fa fa-newspaper"></i>
                                        </a>

                                        <a href="{{ route('artikel.edit', Crypt::encrypt($item->id)) }}" class="btn btn-warning btn-sm" title="Edit Artikel">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <button class="btn btn-danger btn-sm" title="Hapus Artikel" onclick="return confirm('Yakin Untuk Menghapus Artikel?')">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    Belum Ada Data Artikel
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
