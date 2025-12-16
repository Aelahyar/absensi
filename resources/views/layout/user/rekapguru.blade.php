@extends('user.userhome') {{-- Ganti sesuai layout kamu --}}
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rekapitulasi Guru</li>
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
                                    Rekapitulasi Absensi Guru
                                <h3 style="display: none; text-align: center;" id="judul-halaman">Rekapitulasi Absensi Guru MTs MA Al-Anwar</h3>
                                </div>
                            </h5>
                        </div>

                        <form method="GET" action="{{ route('rekapguru') }}" class="row g-3 mb-4">
                            <div class="col-md-5">
                                <label>Dari Tanggal</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
                            </div>
                            <div class="col-md-5">
                                <label>Sampai Tanggal</label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
                            </div>
                            <div class="col-md-2 align-self-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>

                        @if($rekapAbsensi->isEmpty())
                            <div class="alert alert-info">Tidak ada data absensi dengan keterangan selain Hadir dalam rentang waktu ini.</div>
                        @else
                            <div class="card-body" style="overflow: auto;">
                                <div class="table-responsive">
                                    <table id="table1" class="display table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama Guru</th>
                                                <th class="text-center">Jam Ke</th>
                                                <th class="text-center">Kelas</th>
                                                <th class="text-center">Mata Pelajaran</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Tanggal</th>
                                                <th scope="col" class="text-center">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($rekapAbsensi as $key => $absen)
                                                <tr class="text-center">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="text-start">{{ $absen->mengajar->guru->nama_guru ?? '-' }}</td>
                                                    <td>{{ $absen->mengajar->jamke ?? '-' }}</td>
                                                    <td>{{ $absen->mengajar->kelas->nama_kelas ?? '-' }}</td>
                                                    <td class="text-start">{{ $absen->mengajar->mapel->mapel ?? '-' }}</td>
                                                    <td class="text-start">
                                                        @if($absen->status == 'izinD')
                                                            <span class="badge bg-info">Izin D. Tugas</span>
                                                        @elseif($absen->status == 'izinT')
                                                            <span class="badge bg-warning">Izin T. Tugas</span>
                                                        @else
                                                            <span class="badge bg-danger">Alpa</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                                            {{-- Tombol Edit --}}
                                                            <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#editKelas{{ $absen->id }}">
                                                                <i class="bi bi-pencil-square text-success fs-5"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Modal Edit -->
                                                <div class="modal fade text-left modal-borderless"
                                                    id="editKelas{{ $absen->id }}"
                                                    tabindex="-1"
                                                    role="dialog"
                                                    aria-labelledby="editModalLabel{{ $absen->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{ route('rekap.update', $absen->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header bg-primary">
                                                                    <h4 class="modal-title white" id="editModalLabel{{ $absen->id }}">Edit Presensi</h4>
                                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label><strong>Status</strong></label>
                                                                        <select name="status" class="form-control" required>
                                                                            <option value="izinD" {{ $absen->status == 'izinD' ? 'selected' : '' }}>Izin D. Tugas</option>
                                                                            <option value="izinT" {{ $absen->status == 'izinT' ? 'selected' : '' }}>Izin T. Tugas</option>
                                                                            <option value="alpa"  {{ $absen->status == 'alpa'  ? 'selected' : '' }}>Alpa</option>
                                                                            <option value="hadir" {{ $absen->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
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
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak ada data absensi</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
    <script>


    </script>
@endpush
