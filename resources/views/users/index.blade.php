@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <a class="btn btn-primary mb-3" href="{{ route('user.create') }}" role="button">
            <i class="fa-solid fa-user-plus"></i> Tambah User
        </a>
        <div class="col-md-12">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Level</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $u)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            @if ($u->level == 'admin')
                                <span class="badge bg-info text-dark">Administrator</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ ucwords($u->level) }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info btn-sm" onclick="showUserDetail('{{ $u->name }}', '{{ $u->email }}', '{{ $u->level }}')">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <a href="{{ route('user.edit', $u->id) }}" class="btn btn-success btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('user.destroy', $u->id) }}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
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

<!-- Modal Show User -->
<div class="modal fade" id="userDetailModal" tabindex="-1" aria-labelledby="userDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userDetailModalLabel">Detail User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Nama:</strong> <span id="userName"></span></p>
        <p><strong>Email:</strong> <span id="userEmail"></span></p>
        <p><strong>Level:</strong> <span id="userLevel"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript untuk Modal -->
<script>
  function showUserDetail(name, email, level) {
    document.getElementById('userName').innerText = name;
    document.getElementById('userEmail').innerText = email;
    document.getElementById('userLevel').innerText = level;
    var myModal = new bootstrap.Modal(document.getElementById('userDetailModal'));
    myModal.show();
  }
</script>
@endsection