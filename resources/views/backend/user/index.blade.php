@extends('backend.layout.master')

@section('judul', 'Manajemen Pengguna')

@section('content')
<div class="col-md-12">
    <div id="accordion">
        <div class="card card-dark">
            <div class="card-header" id="formInput" data-toggle="collapse" data-target="#formPengguna"
                aria-expanded="true" aria-controls="formPengguna">
                <h5 class="mb-0">
                    Form Pengguna Baru
                </h5>
            </div>
            <div id="formPengguna" class="collapse {{ !empty($errors) ? '':'show' }} {{ isset($edit) ? 'show':'' }}" aria-labelledby="formInput"
                data-parent="#accordion">
                <div class="col-md-12 mt-2">
                    <div class="col-md-12">
                        @if (isset($edit))
                        <form action="{{ route('user.update', Crypt::encrypt($edit->id)) }}" method="post" class="form">
                            @csrf
                            @method('PUT')
                            @else
                            <form action="{{ route('user.store') }}" method="post" class="form">
                                @csrf
                                @endif
                                <form action="{{ route('user.store') }}" method="post" class="form">
                                    <div class="form-group">
                                        <label for="">Nama Pengguna <i class="text-danger">*</i></label>
                                        <input type="text" name="name" id="name"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required
                                            autofocus value="{{ isset($edit) ? $edit->name: old('name') }}">
                                        <p class="text-sm text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">E-Mail Pengguna <i class="text-danger">*</i></label>
                                        <input type="text" name="email" id="email"
                                            class="form-control {{ $errors->has('email') ? 'is-invalid':old('email') }}" required
                                            value="{{ isset($edit) ? $edit->email:'' }}" {{ isset($edit) ? 'readonly':'' }}>
                                        <p class="text-sm text-danger">{{ $errors->first('email') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password <i class="text-danger">*</i></label>
                                        <input type="password" name="password" id="password"
                                            class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}"
                                            {{ !isset($edit) ? 'required':'' }}>
                                        <p class="text-sm text-danger">{{ $errors->first('password') }}</p>
                                        @if (isset($edit))
                                        <p class="text-sm text-danger">
                                            Kosongkan Apabila Tidak Ingin Merubah Password!
                                        </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Konfirmasi Password <i class="text-danger">*</i></label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid':'' }}"
                                            {{ !isset($edit) ? 'required':'' }}>
                                        <p class="text-sm text-danger">{{ $errors->first('password_confirmation') }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Role <i class="text-danger">*</i></label>
                                        <select name="role" id="role" class="form-control select2" style="width: 100%;"
                                            data-placeholder="Pilih Role Penggguna" required>
                                            {{-- <option value="">Pilih Pengguna</option> --}}
                                            @foreach ($role as $item)
                                            <option value="{{ $item->name }}"
                                                {{ isset($edit) ? $edit->roles->first()->name == $item->name ? 'selected':'' : '' }}>
                                                {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-danger">Keterangan : * Wajib di-Isi</p>
                                    <div class="form-group">
                                        <div class="text-left">
                                            @if (isset($edit))
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-save"></i>
                                                Simpan Perubahan Data
                                            </button>
                                            &ensp;
                                            <a href="{{ route('user.index') }}" class="btn btn-danger">
                                                <i class="fa fa-times"></i>
                                                Batalkan Mengubah Pengguna
                                            </a>
                                            @else
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-check"></i>
                                                Tambah Pengguna Baru
                                            </button>
                                            &ensp;
                                            <button type="reset" class="btn btn-danger res">
                                                <i class="fa fa-undo"></i>
                                                Reset Input Form
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="col-md-12">
    <div class="card card-dark">
        <div class="card-header">
            <h4 class="card-title">
                Data Pengguna
            </h4>
            <div class="card-tools">
                @if (!isset($edit))
                <a href="#formPengguna" class="btn btn-sm btn-primary" data-toggle="collapse"
                    data-target="#formPengguna" aria-expanded="true" aria-controls="formPengguna">
                    <i class="fa fa-plus"></i> &ensp;
                    Tambah Data Pengguna
                </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dTable1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pengguna</th>
                            <th>E-Mail</th>
                            <th>Role</th>
                            <th>Tanggal Buat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @foreach ($item->getRoleNames() as $item2)
                                <label for="" class="btn {{ $item2 == 'Admin' ? 'btn-success':'btn-info' }} btn-sm">
                                    {{ $item2 }}
                                </label>
                                @endforeach
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <form action="{{ route('user.destroy', Crypt::encrypt($item->id)) }}" method="post">
                                    <a href="{{ route('user.edit', Crypt::encrypt($item->id)) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin Untuk Melakukan Menghapus Data Ini ?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                Belum Ada Data Pengguna
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

@section('script')
<script>
    $(document).ready(function () {
        //
    })

</script>
@endsection
