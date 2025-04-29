@extends('admin.home')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Jadwal</li>
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
                                    Edit Jadwal Pelajaran
                                </div>
                            </h5>
                        </div>
                        {{-- Section --}}
                        <div class="col-md-12">
                            <div class="card-header">
                                <form method="POST" action="{{ route('jadwalajar.update', $jadwalajar->id_mengajar) }}" class="row g-3" id="myForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-4">
                                        <label for="kodepel" class="form-label">Kode Pelajaran</label>
                                        <input type="text" class="form-control" id="kodepel" name="kodepel" value="{{ old('kode_pelajaran', $jadwalajar->kode_pelajaran) }}" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="thajar" class="form-label">Tahun Pelajaran</label>
                                        <input type="text" class="form-control" id="thajar" name="thajar" value="{{ old('id_thajaran', $jadwalajar->id_thajaran) }}" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="semester" class="form-label">Semester</label>
                                        <input type="text" class="form-control" id="semester" name="semester" value="{{ old('id_semester', $jadwalajar->id_semester) }}" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="guru_mapel" class="form-label">Guru Mata Pelajaran</label>
                                        <select class="form-select select2" name="guru_mapel" id="guru_mapel" style="width: 100%;">
                                            <option value="">Pilih Guru</option>
                                            @foreach($guru as $item)
                                                <option value="{{ $item->id_guru }}" {{ old('guru_mapel', $jadwalajar->id_guru) == $item->id_guru ? 'selected' : '' }}>
                                                    {{ $item->nama_guru }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                                        <select class="form-select select2" style="width: 100%;" name="mapel" id="mapel" data-placeholder="Pilih Mata Pelajaran">
                                            <option value="">Pilih Mata Pelajaran</option>
                                            @foreach($mapel as $item)
                                                <option value="{{ $item->id_mapel }}" @selected(old('mapel', $jadwalajar->id_mapel) == $item->id_mapel)>
                                                    {{ $item->mapel }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="kelas" class="form-label">Kelas</label>
                                        <select class="form-select select2" style="width: 100%;" name="kelas" id="kelas" data-placeholder="Pilih Kelas">
                                            <option value="">Pilih Kelas</option>
                                            @foreach($kelas as $item)
                                                <option value="{{ $item->id_mkelas }}" @selected(old('kelas', $jadwalajar->id_kelas) == $item->id_mkelas)>
                                                    {{ $item->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="hari" class="form-label">Hari</label>
                                        <select class="form-select select2" style="width: 100%;" name="hari" id="hari" data-placeholder="Pilih Hari">
                                            <option value="">Pilih Hari</option>
                                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                                <option value="{{ $hari }}" @selected(old('hari', $jadwalajar->hari) == $hari)>
                                                    {{ $hari }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="waktu" class="form-label">Waktu</label>
                                        <div class="d-flex align-items-center">
                                            <input type="time" id="jam_mulai" name="jam_mulai" class="form-control" style="max-width: 150px;"
                                                value="{{ old('jam_mulai', $jam_mulai) }}">
                                            <span class="mx-2">-</span>
                                            <input type="time" id="jam_selesai" name="jam_selesai" class="form-control" style="max-width: 150px;"
                                                value="{{ old('jam_selesai', $jam_selesai) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="jamke" class="form-label">Jam Ke</label>
                                        <input type="text" class="form-control" id="jamke" name="jamke" value="{{ old('jamke', $jadwalajar->jamke) }}">
                                    </div>
                                    <div class="col-12 d-flex justify-content-start gap-2">
                                        <a href="{{ route('jadwalajar.index') }}" class="btn btn-danger">Kembali</a>
                                        <button type="button" class="btn btn-primary" id="btn-update">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- end Section --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('#btn-update').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan diperbarui!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, update!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#myForm').submit();
            }
        });
    });
});
</script>
@endpush
