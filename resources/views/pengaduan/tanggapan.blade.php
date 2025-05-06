@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pengaduan</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggapan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $item)
            <tr>
                <td>
                    @if ($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Pengaduan" width="100">
                    @else
                        <span class="text-muted">Tidak ada foto</span>
                    @endif
                </td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>
                    @if ($item->tanggapan)
                        {{ $item->tanggapan->isi }} {{-- Menggunakan "isi" dari tabel tanggapan --}}
                    @else
                        <span class="text-muted">Belum ada tanggapan</span>
                    @endif
                </td>
                <td>
                    @php
                        $statusColors = [
                            'pending' => 'danger',
                            'diproses' => 'primary', 
                            'selesai' => 'success'
                        ];
                    @endphp
                    <span class="badge bg-{{ $statusColors[$item->status] ?? 'secondary' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>
                    @if (!$item->tanggapan)
                        <!-- Tombol Tambah Tanggapan -->
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalTanggapan{{ $item->id }}">
                            Tambah Tanggapan
                        </button>
                    @else
                        <!-- Tombol Edit Tanggapan -->
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalEditTanggapan{{ $item->id }}">
                            Ubah Tanggapan
                        </button>
                    @endif
                </td>
            </tr>

            <!-- Modal Tambah Tanggapan -->
            <div class="modal fade" id="modalTanggapan{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('admin.pengaduan.tanggapan.store', $item->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Tanggapan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <textarea name="isi" class="form-control" required></textarea> {{-- Menggunakan "isi" --}}
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Edit Tanggapan -->
            <div class="modal fade" id="modalEditTanggapan{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('admin.pengaduan.tanggapan.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Tanggapan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <textarea name="isi" class="form-control" required>{{ optional($item->tanggapan)->isi }}</textarea> {{-- Menggunakan "isi" --}}
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>
@endsection
