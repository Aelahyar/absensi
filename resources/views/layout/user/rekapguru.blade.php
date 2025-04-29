@extends('user.userhome') {{-- Ganti sesuai layout kamu --}}
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rekap Guru</li>
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
                                    Rekap Absensi Guru (Tidak Hadir)
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($rekapAbsensi as $key => $absen)
                                                <tr class="text-center">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $absen->mengajar->guru->nama_guru ?? '-' }}</td>
                                                    <td>{{ $absen->mengajar->jamke ?? '-' }}</td>
                                                    <td>{{ $absen->mengajar->kelas->nama_kelas ?? '-' }}</td>
                                                    <td>{{ $absen->mengajar->mapel->mapel ?? '-' }}</td>
                                                    <td>
                                                        @if($absen->status == 'hadir')
                                                            <span class="badge bg-success">Hadir</span>
                                                        @elseif($absen->status == 'izin')
                                                            <span class="badge bg-warning">Izin</span>
                                                        @else
                                                            <span class="badge bg-danger">Alpha</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
                                                </tr>
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
