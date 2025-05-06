@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5><i class="fa-solid fa-user-plus"></i> Tambah Masyarakat</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('masyarakat.store') }}" method="POST">
                        @csrf

                        <!-- Input Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" required placeholder="Masukkan Nama">
                        </div>

                        <!-- Input Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Masukkan Password">
                        </div>

                        <!-- Input Nomor Telepon -->
                        <div class="mb-3">
                            <label for="nomor_telpon" class="form-label">Nomor Telepon</label>
                            <input type="text" name="nomor_telpon" class="form-control" required placeholder="Masukkan Nomor Telepon">
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('masyarakat.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-save"></i> Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
