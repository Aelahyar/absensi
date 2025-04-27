@extends('admin.home')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Siswa</li>
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
                                    Data Siswa
                                    <button type="button" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addSiswa">
                                        <strong>Add Data</strong>
                                    </button>
                                </div>
                            </h5>
                        </div>

                        {{-- Modal Tambah Siswa --}}
                        <div class="modal fade text-left modal-borderless modal-lg" id="addSiswa" tabindex="-1" role="dialog" aria-labelledby="modalAddSiswa" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('siswa.store') }}">
                                        @csrf
                                        <div class="modal-header bg-primary">
                                            <h4 class="modal-title text-white">Tambah Siswa</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label><strong>NIS</strong></label>
                                                    <input name="nis" type="text" placeholder="Masukan NIS" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label><strong>Nama Siswa</strong></label>
                                                    <input name="nama_siswa" type="text" placeholder="Masukan Nama Siswa" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label><strong>Tempat Lahir</strong></label>
                                                    <input name="tempat_lahir" type="text" placeholder="Masukan Tempat Lahir" class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label><strong>Tanggal Lahir</strong></label>
                                                    <input name="tgl_lahir" type="date" placeholder="Masukan Tanggal Lahir" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label><strong>Jenis Kelamin</strong></label>
                                                    <select name="jk" class="form-select" required>
                                                        <option value="">Pilih Jenis Kelamin</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label><strong>Alamat Peserta Didik</strong></label>
                                                    <input name="alamat" type="text" placeholder="Masukan Alamat Peserta Didik" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label><strong>Kelas</strong></label>
                                                    <select name="id_mkelas" class="form-select" required>
                                                        <option value="">Pilih Kelas</option>
                                                        @foreach($kelas as $k)
                                                            <option value="{{ $k->id_mkelas }}">{{ $k->nama_kelas }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label><strong>Status</strong></label>
                                                    <select name="status" class="form-select" required>
                                                        <option value="">Pilih Status</option>
                                                        <option value="Y">Aktif</option>
                                                        <option value="N">Non-Aktif</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label><strong>Pondok / Non Pondok</strong></label>
                                                    <input name="pndk" type="text" placeholder="Masukan Pondok/Non Pondok" class="form-control" required>
                                                </div>
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
                                <table id="table1" class="display table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">NIS/NISN</th>
                                            <th class="text-center">Nama Siswa</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Pondok/Non</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($siswa as $i => $s)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td class="text-center">{{ $s->nis }}</td>
                                                <td>{{ $s->nama_siswa }}</td>
                                                <td class="text-center">{{ $s->kelas->nama_kelas ?? '-' }}</td>
                                                <td class="text-center">{{ $s->pndk }}</td>
                                                <td class="text-center">
                                                    @if ($s->status == 'Y')
                                                        <span class="badge bg-success">Aktif</span>
                                                    @else
                                                        <span class="badge bg-danger">Non-Aktif</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-1">
                                                        {{-- Tombol Edit --}}
                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSiswa{{ $s->id_siswa }}">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>

                                                        <form id="deleteForm{{ $s->id_siswa }}" action="{{ route('siswa.destroy', $s->id_siswa) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="d-flex justify-content-center gap-1">
                                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $s->id_siswa }})">
                                                                    <i class="bi bi-trash3"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>

                                        {{-- Modal Edit Siswa --}}
                                        <div class="modal fade text-left modal-borderless modal-lg" id="editSiswa{{ $s->id_siswa }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('siswa.update', $s->id_siswa) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header bg-warning">
                                                            <h5 class="modal-title text-white">Edit Data Siswa</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label><strong>NIS</strong></label>
                                                                    <input name="nis" type="text" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis', $s->nis) }}">
                                                                    @error('nis')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label><strong>Nama Siswa</strong></label>
                                                                    <input name="nama_siswa" type="text" class="form-control @error('nama_siswa') is-invalid @enderror" value="{{ old('nama_siswa', $s->nama_siswa) }}">
                                                                    @error('nama_siswa')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label><strong>Tempat Lahir</strong></label>
                                                                    <input name="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir', $s->tempat_lahir) }}">
                                                                    @error('tempat_lahir')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label><strong>Tanggal Lahir</strong></label>
                                                                    <input name="tgl_lahir" type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', $s->tgl_lahir) }}">
                                                                    @error('tgl_lahir')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label><strong>Jenis Kelamin</strong></label>
                                                                    <select name="jk" class="form-select">
                                                                        <option value="Laki-laki" {{ old('jk', $s->jk) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                                        <option value="Perempuan" {{ old('jk', $s->jk) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label><strong>Alamat Peserta Didik</strong></label>
                                                                    <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', $s->alamat) }}">
                                                                    @error('alamat')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label><strong>Kelas</strong></label>
                                                                    <select name="id_mkelas" class="form-select">
                                                                        @foreach($kelas as $k)
                                                                            <option value="{{ $k->id_mkelas }}" {{ $s->id_kelas == $k->id_mkelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label><strong>Status</strong></label>
                                                                    <select name="status" class="form-select">
                                                                        <option value="Y" {{ old('status', $s->status) == 'Y' ? 'selected' : '' }}>Aktif</option>
                                                                        <option value="N" {{ old('status', $s->status) == 'N' ? 'selected' : '' }}>Non-Aktif</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label><strong>Pondok/Non-Pondok</strong></label>
                                                                    <input name="pndk" type="text" class="form-control @error('pndk') is-invalid @enderror" value="{{ old('pndk', $s->pndk) }}">
                                                                    @error('pndk')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
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
                                                Data Siswa belum Tersedia.
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
    // document.addEventListener("DOMContentLoaded", function () {
    //     var modal = new bootstrap.Modal(document.getElementById('addSiswa'));
    //     modal.show();
    document.addEventListener("DOMContentLoaded", function () {
        @if ($errors->any())
            @if (session('modal') == 'add')
                // Buka modal tambah siswa jika ada error dari form tambah
                var modalAdd = new bootstrap.Modal(document.getElementById('addSiswa'));
                modalAdd.show();
            @elseif (session('modal') == 'edit')
                // Buka modal edit siswa jika ada error dari form edit
                var siswaId = @json(session('id_siswa'));
                var modalEdit = new bootstrap.Modal(document.getElementById('editSiswa' + siswaId));
                modalEdit.show();
            @endif
        @endif

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
    function confirmDelete(id_siswa) {
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
                document.getElementById('deleteForm' + id_siswa).submit();
            }
        });
    }
</script>
@endpush
