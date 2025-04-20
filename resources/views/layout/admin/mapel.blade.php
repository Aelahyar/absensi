@extends('admin.home')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Mata Pelajaran</li>
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
                                    Daftar Mata Pelajaran
                                    <button type="button" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal" data-bs-target="#tambahMapel">
                                        <strong>Tambah Data</strong>
                                    </button>
                                </div>
                            </h5>
                        </div>

                        {{-- Modal Tambah --}}
                        <div class="modal fade text-left modal-borderless" id="tambahMapel" tabindex="-1" role="dialog" aria-labelledby="tambahMapelLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title white" id="tambahMapelLabel">Tambah Mata Pelajaran</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('mapel.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label><strong>Kode Mapel</strong></label>
                                                <input type="text" name="kode_mapel" class="form-control" value="MP-{{ time() }}" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label><strong>Nama Mapel</strong></label>
                                                <input type="text" name="mapel" class="form-control" required>
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

                        {{-- Card Body --}}
                        <div class="card-body" style="overflow: auto;">
                            <div class="table-responsive">
                                <table id="table1" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">No</th>
                                            <th scope="col" class="text-center">Kode</th>
                                            <th scope="col" class="text-center">Nama Mapel</th>
                                            <th scope="col" class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($mapel as $no => $m)
                                        <tr>
                                            <td>{{ $no+1 }}</td>
                                            <td>{{ $m->kode_mapel }}</td>
                                            <td>{{ $m->mapel }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#editMapel{{ $m->id }}">
                                                        <i class="bi bi-pencil-square text-success fs-5"></i>
                                                    </button>
                                                    <form action="{{ route('mapel.destroy', $m->id) }}" method="POST" id="deleteForm{{ $m->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link p-0" onclick="confirmDelete({{ $m->id }})">
                                                            <i class="bi bi-trash3 text-danger fs-5"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Modal Edit --}}
                                        <div class="modal fade text-left modal-borderless" id="editMapel{{ $m->id }}" tabindex="-1" role="dialog" aria-labelledby="editMapelLabel{{ $m->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('mapel.update', $m->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header bg-warning">
                                                            <h4 class="modal-title white" id="editMapelLabel{{ $m->id }}">Edit Mapel</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label><strong>Nama Mapel</strong></label>
                                                                <input type="text" name="mapel" value="{{ $m->mapel }}" class="form-control" required>
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
                                            Data Mata Pelajaran belum Tersedia.
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- End Card Body --}}
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
            text: "Data tidak dapat dikembalikan!",
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
