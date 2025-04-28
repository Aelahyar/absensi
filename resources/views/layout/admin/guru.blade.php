@extends('admin.home')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Guru</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="col-md-12">
            <div class="card border border-primary border-3 mt-2">
                <div class="card-body">
                    <div class="card">
                        {{-- Card Header --}}
                        <div class="card-header">
                            <h5 class="card-title">
                                <div class="col-sm-12 d-flex justify-content-between">
                                    Data Guru
                                    <button type="button"
                                        class="btn btn-outline-success rounded-pill"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addGuru">
                                        <strong>Add Data</strong>
                                    </button>
                                </div>
                            </h5>
                        </div>

                        {{-- modal tambah Guru --}}
                        <div class="modal fade text-left modal-borderless" id="addGuru" tabindex="-1" role="dialog"
                            aria-labelledby="modalAddGuru" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('guru.store') }}">
                                        @csrf
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title text-white">Tambah Guru</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            {{-- NIK --}}
                                            <label><strong>Nik</strong></label>
                                            <div class="form-group mb-2">
                                                <input name="nik" type="text" class="form-control @error('nik') is-invalid @enderror"
                                                    placeholder="Nomer Induk Keluarga" value="{{ old('nik') }}" required>
                                                @error('nik')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Nama Guru --}}
                                            <label><strong>Nama Guru</strong></label>
                                            <div class="form-group mb-2">
                                                <input name="nama_guru" type="text" class="form-control @error('nama_guru') is-invalid @enderror"
                                                    placeholder="Nama Lengkap Guru" value="{{ old('nama_guru') }}" required>
                                                @error('nama_guru')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Email --}}
                                            <label><strong>Email</strong></label>
                                            <div class="form-group mb-2">
                                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Example@gmail.com" value="{{ old('email') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary ms-1">Tambah</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="card-body" style="overflow: auto;">
                            <div class="table-responsive">
                                <table id="table1" class="display table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">NIK</th>
                                            <th class="text-center">Nama Guru</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($guru as $i => $g)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td class="text-center">{{ $g->nik }}</td>
                                                <td class="text-center">{{ $g->nama_guru }}</td>
                                                <td class="text-center">{{ $g->email }}</td>
                                                <td class="text-center">
                                                    @if($g->status == 'Y')
                                                        <span class="badge bg-success">Aktif</span>
                                                    @else
                                                        <span class="badge bg-danger">Non-Aktif</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-1">
                                                        {{-- Tombol Edit --}}
                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editGuru{{ $g->id_guru }}">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        {{-- Tombol Delete --}}
                                                        <form id="deleteForm{{ $g->id_guru }}" action="{{ route('guru.destroy', $g->id_guru) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link p-0" onclick="confirmDelete({{ $g->id_guru }})">
                                                                <i class="bi bi-trash3 text-danger fs-5"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        {{-- Modal Edit --}}
                                        <div class="modal fade" id="editGuru{{ $g->id_guru }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('guru.update', $g->id_guru) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header bg-warning">
                                                            <h5 class="modal-title text-white">Edit Data Guru</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label><strong>NIK</strong></label>
                                                                <input type="text" name="nik" class="form-control" value="{{ $g->nik }}" required>
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <label><strong>Nama Guru</strong></label>
                                                                <input type="text" name="nama_guru" class="form-control" value="{{ $g->nama_guru }}" required>
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <label><strong>Email</strong></label>
                                                                <input type="email" name="email" class="form-control" value="{{ $g->email }}" required>
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <!-- Hidden input akan dikirim jika checkbox tidak dicentang -->
                                                                <input type="hidden" name="status" value="N">

                                                                <!-- Checkbox ini akan override jadi 1 jika dicentang -->
                                                                <input class="form-check-input" type="checkbox" name="status" value="Y" id="statusCheck{{ $g->id_guru }}" {{ $g->status == "Y" ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="statusCheck{{ $g->id_guru }}">
                                                                    Aktifkan
                                                                </label>
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-warning">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        @empty
                                            <div class="alert alert-danger">
                                                Data Guru belum Tersedia.
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modal = new bootstrap.Modal(document.getElementById('addGuru'));
        modal.show();


        // SweetAlert untuk error validasi
        Swal.fire({
                title: 'Gagal Menyimpan!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                icon: 'error',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });
    });
</script>
@endif

<script>
    function confirmDelete(id_guru) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id_guru).submit();
            }
        });
    }
</script>
@endpush
