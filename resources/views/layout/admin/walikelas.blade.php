@extends('admin.home')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wali Kelas</li>
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
                                    Data Wali Kelas
                                    <button type="button" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal" data-bs-target="#modalTambah">
                                        <strong>Add Data</strong>
                                    </button>
                                </div>
                            </h5>
                        </div>

                        {{-- Modal Tambah --}}
                        <div class="modal fade text-left modal-borderless" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title white">Tambah Wali Kelas</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('walikelas.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label><strong>Nama Guru</strong></label>
                                                <select name="wakel" class="form-control" required>
                                                    <option value="">Pilih Guru</option>
                                                    @foreach($guru as $g)
                                                        <option value="{{ $g->id_guru }}">{{ $g->nama_guru }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Nama Kelas</strong></label>
                                                <select name="kelas" class="form-control" required>
                                                    <option value="">Pilih Kelas</option>
                                                    @foreach($kelas as $kls)
                                                        <option value="{{ $kls->id_mkelas }}">{{ $kls->nama_kelas }}</option>
                                                    @endforeach
                                                </select>
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
                                <table id="table1" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Nama Wali Kelas</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $no => $item)
                                            <tr>
                                                <td class="text-center">{{ $no + 1 }}</td>
                                                <td class="text-center">{{ $item->kelas->nama_kelas }}</td>
                                                <td class="text-center">{{ $item->guru->nama_guru }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                                        {{-- Tombol Edit --}}
                                                        <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id_walikelas }}">
                                                            <i class="bi bi-pencil-square text-success fs-5"></i>
                                                        </button>

                                                        {{-- Tombol Delete --}}
                                                        <form id="deleteForm{{ $item->id_walikelas }}" action="{{ route('walikelas.destroy', $item->id_walikelas) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link p-0" onclick="confirmDelete({{ $item->id_walikelas }})">
                                                                <i class="bi bi-trash3 text-danger fs-5"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>

                                            {{-- Modal Edit --}}
                                            <div class="modal fade text-left modal-borderless" id="modalEdit{{ $item->id_walikelas }}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('walikelas.update', $item->id_walikelas) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header bg-warning">
                                                                <h4 class="modal-title white">Edit Wali Kelas</h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label><strong>Nama Guru</strong></label>
                                                                    <select name="wakel" class="form-control">
                                                                        @foreach($guru as $g)
                                                                            <option value="{{ $g->id_guru }}" {{ $g->id_guru == $item->id_guru ? 'selected' : '' }}>{{ $g->nama_guru }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label><strong>Nama Kelas</strong></label>
                                                                    <select name="kelas" class="form-control">
                                                                        @foreach($kelas as $kls)
                                                                            <option value="{{ $kls->id_mkelas }}" {{ $kls->id_mkelas == $item->id_mkelas ? 'selected' : '' }}>{{ $kls->nama_kelas }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-warning ms-1">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Wali Kelas belum Tersedia.
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
