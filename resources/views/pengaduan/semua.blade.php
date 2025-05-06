@extends('layouts.frontsite')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Semua Pengaduan</h2>

    @foreach($semuaPengaduan as $item)
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $item->foto) }}" class="img-fluid rounded-start" alt="Foto Pengaduan">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <p class="card-text">{{ $item->deskripsi }}</p>
                    <p class="card-text"><small class="text-muted">Status: {{ ucfirst($item->status) }}</small></p>
                    
                    <hr>
                    <h6>Tanggapan:</h6>
                    @if($item->tanggapan)
                        <p>{{ $item->tanggapan->isi }}</p>
                    @else
                        <p class="text-muted">Belum ada tanggapan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
