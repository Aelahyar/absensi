@extends('admin.home')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Semester</li>
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
                        {{-- card header --}}
                        <div class="card-header">
                            <h5 class="card-title">
                                <div class="col-sm-12 d-flex justify-content-between">
                                    Data Semester
                                    <button type="button"
                                        class="btn btn-outline-success rounded-pill"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addSemester">
                                        <strong>Tambah</strong>
                                    </button>
                                </div>
                            </h5>
                        </div>

                        {{-- modal tambah semester --}}
                        <div class="modal fade text-left modal-borderless" id="addSemester" tabindex="-1" role="dialog"
                            aria-labelledby="modalAddSemester" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('semester.store') }}">
                                        @csrf
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title text-white">Tambah Semester</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label><strong>Semester</strong></label>
                                            <div class="form-group">
                                                <input name="semester" type="text" class="form-control"
                                                    placeholder="Nama Semester..." required>
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

                        {{-- card body --}}
                        <div class="card-body" style="overflow: auto;">
                            <div class="table-responsive">
                                <table id="table1" class="display table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Semester</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($semesters as $no => $smt)
                                        <tr>
                                            <td class="text-center">{{ $no+1 }}</td>
                                            <td class="text-center">{{ $smt->semester }}</td>
                                            <td class="text-center">
                                                @if($smt->status == 1)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    @if ($smt->status == 1)
                                                        {{-- Kalau sedang aktif, tampilkan tombol Nonaktifkan --}}
                                                        <a href="{{ route('semester.setStatus', ['id' => $smt->id, 'status' => 0]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menonaktifkan semester ini?')">
                                                            <i class="fas fa-times-circle"></i> Nonaktifkan
                                                        </a>
                                                    @else
                                                        {{-- Kalau sedang nonaktif, tampilkan tombol Aktifkan --}}
                                                        <a href="{{ route('semester.setStatus', ['id' => $smt->id, 'status' => 1]) }}" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin mengaktifkan semester ini?')">
                                                            <i class="fas fa-check-circle"></i> Aktifkan
                                                        </a>
                                                    @endif


                                                    {{-- Edit --}}
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editSemester{{ $smt->id }}">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>

                                                    {{-- Delete --}}
                                                    <form id="deleteForm{{ $smt->id }}" action="{{ route('semester.destroy', $smt->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $smt->id }})">
                                                            <i class="bi bi-trash3"></i> Del
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Modal Edit --}}
                                        <div class="modal fade text-left modal-borderless" id="editSemester{{ $smt->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="editModalLabel{{ $smt->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('semester.update', $smt->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header bg-warning">
                                                            <h4 class="modal-title text-white">Edit Semester</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label><strong>Semester</strong></label>
                                                                <input name="semester" type="text" value="{{ $smt->semester }}" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-warning">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Semester belum Tersedia.
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
<script>
    function confirmDelete(id) {
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
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>
@endpush
