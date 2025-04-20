@extends('admin.home')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelas</li>
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
                                    Data Kelas
                                    <button href="{{ route('kelasadmin.store') }}" type="button"
                                        class="btn btn-outline-success rounded-pill" data-bs-toggle="modal"
                                        data-bs-target="#inlineForm">
                                        <strong>Add Data</strong>
                                    </button>
                                </div>
                            </h5>
                        </div>
                        {{-- Modal Tambah --}}
                        <div class="modal fade text-left modal-borderless" id="inlineForm" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title white" id="myModalLabel33">Input Data Kelas</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('kelasadmin.store') }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            <label><strong>Kode Kelas</strong></label>
                                            <div class="form-group">
                                                    <input name="kd_kelas" type="text" value="KL-{{ time() }}" class="form-control" readonly>
                                            </div>
                                            <label><strong>Nama Kelas</strong></label>
                                            <div class="form-group">
                                                <input type="text" name="nama_kelas" placeholder="Masukan Nama Kelas"
                                                    class="form-control @error('nama_kelas') is-invalid @enderror" required
                                                    oninvalid="this.setCustomValidity('Mohon isi Nama Kelas')"
                                                    oninput="this.setCustomValidity('')">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Batal</span>
                                            </button>
                                            <button type="submit" id="toast-success" class="btn btn-primary ms-1">
                                                <span id="toast-success" class="d-none d-sm-block">Tambah</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                        {{-- card body --}}
                        <div class="card-body" style="overflow: auto;">
                            <div class="table-responsive">
                                <table id="table1" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">No</th>
                                            <th scope="col" class="text-center">Kode Kelas</th>
                                            <th scope="col" class="text-center">Nama Kelas</th>
                                            <th scope="col" class="text-center">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($kelas as $no => $Prsh)
                                            <tr>
                                                <td class="text-center">{{ $no+1 }}</td>
                                                <td class="text-center">{{ $Prsh->kd_kelas }}</td>
                                                <td class="text-center">{{ $Prsh->nama_kelas }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                                        {{-- Tombol Edit --}}
                                                        <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#editKelas{{ $Prsh->id_mkelas }}">
                                                            <i class="bi bi-pencil-square text-success fs-5"></i>
                                                        </button>

                                                        {{-- Tombol Delete --}}
                                                        <form id="deleteForm{{ $Prsh->id_mkelas }}" action="{{ route('kelasadmin.destroy', $Prsh->id_mkelas) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link p-0" onclick="confirmDelete({{ $Prsh->id_mkelas }})">
                                                                <i class="bi bi-trash3 text-danger fs-5"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade text-left modal-borderless" id="editKelas{{ $Prsh->id_mkelas }}" tabindex="-1" role="dialog"
                                                aria-labelledby="editModalLabel{{ $Prsh->id_mkelas }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ route('kelasadmin.update', $Prsh->id_mkelas) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header bg-warning">
                                                                <h4 class="modal-title white" id="editModalLabel{{ $Prsh->id_mkelas }}">Edit Kelas</h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label><strong>Nama Kelas</strong></label>
                                                                    <input name="nama_kelas" type="text" value="{{ $Prsh->nama_kelas }}"
                                                                        class="form-control @error('nama_kelas') is-invalid @enderror" required
                                                                        oninvalid="this.setCustomValidity('Mohon isi Nama Kelas')"
                                                                        oninput="this.setCustomValidity('')">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Batal</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-warning ms-1">
                                                                    <span class="d-none d-sm-block">Simpan</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data Kelas belum Tersedia.
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
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(id_mklas) {
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
                document.getElementById('deleteForm' + id_mklas).submit();
            }
        });
    }
</script>
@endpush
