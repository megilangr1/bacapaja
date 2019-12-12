@extends('backend.layout.master')

@section('judul', 'Pengaturan Role')

@section('content')
<div class="col-md-5">
    <div class="card card-dark">
        <div class="card-header">
            <h4 class="card-title">
                Manajemen Role
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('role.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Role</label>
                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-sm">
                        Tambah Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-7">
    <div class="card card-dark">
        <div class="card-header">
            <h4 class="card-title">Data Role</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Guard</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($role as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->guard_name }}</td>
                            <td>
                                <form action="{{ route('role.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Belum Ada Data Role
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
