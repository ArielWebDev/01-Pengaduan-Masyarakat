@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <a class="btn btn-primary mb-3" href="{{ route('masyarakat.create') }}" role="button">
            <i class="fa-solid fa-user-plus"></i> Tambah Masyarakat
        </a>
        <div class="col-md-12">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nomor Telepon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($masyarakats as $m)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $m->name }}</td>
                        <td>{{ $m->nomor_telpon }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info btn-sm" onclick="showMasyarakatDetail('{{ $m->name }}', '{{ $m->nomor_telpon }}')">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <a href="{{ route('masyarakat.edit', $m->id) }}" class="btn btn-success btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('masyarakat.destroy', $m->id) }}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Show Masyarakat -->
<div class="modal fade" id="masyarakatDetailModal" tabindex="-1" aria-labelledby="masyarakatDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="masyarakatDetailModalLabel">Detail Masyarakat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Nama:</strong> <span id="masyarakatName"></span></p>
        <p><strong>Nomor Telepon:</strong> <span id="masyarakatTelpon"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript untuk Modal -->
<script>
  function showMasyarakatDetail(name, telpon) {
    document.getElementById('masyarakatName').innerText = name;
    document.getElementById('masyarakatTelpon').innerText = telpon;
    var myModal = new bootstrap.Modal(document.getElementById('masyarakatDetailModal'));
    myModal.show();
  }
</script>
@endsection
