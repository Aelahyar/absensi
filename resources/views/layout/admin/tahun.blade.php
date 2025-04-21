@extends('admin.home')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tahun Pelajaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    {{-- Main Section --}}
    <section class="section">
        <div class="col-md-12">
            <div class="card border border-primary border-3 mt-2">
                <div class="card-body">
                    <div class="card">
                        {{-- Header --}}
                        <div class="card-header">
                            <h5 class="card-title">
                                <div class="col-sm-12 d-flex justify-content-between">
                                    Data Tahun Pelajaran
                                    <button type="button" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addTahunPelajaran">
                                        <strong>Add Data</strong>
                                    </button>
                                </div>
                            </h5>
                        </div>

                        {{-- Table --}}
                        <div class="card-body" style="overflow: auto;">
                            <div class="table-responsive">
                                <table id="table1" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Tahun Pelajaran</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $no => $ta)
                                            <tr>
                                                <td class="text-center">{{ $no + 1 }}</td>
                                                <td class="text-center"><strong>{{ $ta->tahun_ajaran }}</strong></td>
                                                <td class="text-center">
                                                    @if ($ta->status == 1)
                                                        <span class="badge bg-success">Aktif</span>
                                                    @else
                                                        <span class="badge bg-danger">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                {{-- Tombol Aktivasi/Non-aktivasi --}}
                                                @if ($ta->status == 1)
                                                    {{-- Kalau sedang aktif, tampilkan tombol Nonaktifkan --}}
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="confirmUpdateStatus('{{ route('tahunajaran.setStatus', ['id_thajaran' => $ta->id_thajaran, 'status' => 0]) }}', 'nonaktifkan')">
                                                            <i class="fas fa-times-circle"></i> Nonaktifkan
                                                        </a>
                                                @else
                                                    {{-- Kalau sedang nonaktif, tampilkan tombol Aktifkan --}}
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-success btn-sm"
                                                        onclick="confirmUpdateStatus('{{ route('tahunajaran.setStatus', ['id_thajaran' => $ta->id_thajaran, 'status' => 1]) }}', 'aktifkan')">
                                                            <i class="fas fa-check-circle"></i> Aktifkan
                                                        </a>
                                                @endif

                                                    {{-- Tombol Edit --}}
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTahunPelajaran{{ $ta->id_thajaran }}">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>

                                                    {{-- Tombol Delete --}}
                                                    <form action="{{ route('tahunajaran.destroy', $ta->id_thajaran) }}" method="POST" class="d-inline" id="deleteForm{{ $ta->id_thajaran }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $ta->id_thajaran }})">
                                                            <i class="bi bi-trash3"></i> Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            {{-- Modal Edit --}}
                                            <div class="modal fade" id="editTahunPelajaran{{ $ta->id_thajaran }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('tahunajaran.update', $ta->id_thajaran) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header bg-warning">
                                                                <h5 class="modal-title text-white">Edit Tahun Pelajaran</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group mb-3">
                                                                    <label><strong>Tahun Pelajaran</strong></label>
                                                                    <input type="text" name="tahun_ajaran" class="form-control" value="{{ $ta->tahun_ajaran }}" required>
                                                                </div>
                                                                <div class="form-check">
                                                                    <!-- Hidden input akan dikirim jika checkbox tidak dicentang -->
                                                                    <input type="hidden" name="status" value="0">

                                                                    <!-- Checkbox ini akan override jadi 1 jika dicentang -->
                                                                    <input class="form-check-input" type="checkbox" name="status" value="1" id="statusCheck{{ $ta->id_thajaran }}" {{ $ta->status == 1 ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="statusCheck{{ $ta->id_thajaran }}">
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
                                            Data Tahun Pelajaran belum Tersedia.
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Modal Tambah --}}
                        <div class="modal fade" id="addTahunPelajaran" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('tahunajaran.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title text-white">Tambah Tahun Pelajaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label><strong>Tahun Pelajaran</strong></label>
                                                <input name="tahun_ajaran" type="text" placeholder="2024/2025" class="form-control" required>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="status" value="1" id="statusBaru">
                                                <label class="form-check-label" for="statusBaru">
                                                    Aktifkan
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div> <!-- inner card -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    function confirmUpdateStatus(url, action) {
        Swal.fire({
            title: `Yakin ingin ${action} tahun ajaran ini?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
    function confirmDelete(id_thajaran) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id_thajaran).submit();
            }
        });
    }
</script>
@endpush
