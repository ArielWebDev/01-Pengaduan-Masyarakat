@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5><i class="fa-solid fa-edit"></i> Edit Masyarakat</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('masyarakat.update', $masyarakat->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Input Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" value="{{ $masyarakat->name }}" class="form-control" required>
                        </div>

                        <!-- Input Password (Opsional) -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                            <input type="password" name="password" class="form-control" placeholder="Isi jika ingin mengubah password">
                        </div>

                        <!-- Input Nomor Telepon -->
                        <div class="mb-3">
                            <label for="nomor_telpon" class="form-label">Nomor Telepon</label>
                            <input type="text" name="nomor_telpon" value="{{ $masyarakat->nomor_telpon }}" class="form-control" required>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('masyarakat.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save"></i> Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
