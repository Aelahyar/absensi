@extends('user.userhome') {{-- Ganti sesuai layout kamu --}}
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rekap Siswa</li>
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
                                    Rekap Absensi Siswa (Tidak Hadir)
                                </div>
                            </h5>
                        </div>

                        <form method="GET" action="{{ route('rekapsiswa') }}" class="row g-3 mb-4">
                            <div class="col-md-5">
                                <label>Dari Tanggal</label>
                                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-5">
                                <label>Sampai Tanggal</label>
                                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-2 align-self-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>

                        @if($rekap->isEmpty())
                            <div class="alert alert-info">Tidak ada data absensi dengan keterangan selain Hadir dalam rentang waktu ini.</div>
                        @else
                            <div class="card-body" style="overflow: auto;">
                                <div class="table-responsive">
                                    {{-- <table id="table1" class="display table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nama Siswa</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rekap as $item)
                                                <tr>
                                                    <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tgl_absen)->format('d-m-Y') }}</td>
                                                    <td>{{ $item->keterangan }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table> --}}
                                    <table id="table1" class="display table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Kelas</th>
                                                <th class="text-center">Nama Siswa</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rekap as $item)
                                                <tr>
                                                    <td>{{ $item->siswa->kelas->nama_kelas ?? 'Tanpa Kelas' }}</td>
                                                    <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tgl_absen)->format('d-m-Y') }}</td>
                                                    <td>{{ $item->keterangan }}</td>
                                                </tr>
                                            @endforeach
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
