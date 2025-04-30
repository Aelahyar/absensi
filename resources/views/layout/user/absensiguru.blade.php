@extends('user.userhome')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>
                    Presensi Guru - Hari {{ ucfirst($hariIni) }}</h3>
                {{-- <p class="text-subtitle text-muted">A group for input to display information in before or after input. --}}
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ Route('dashboarduser') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Presensi Guru</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @foreach($mengajars as $namaKelas => $listMengajar)
        <form action="{{ route('presensi.store') }}" method="POST">
        @csrf
            <section class="section">
                <div class="col-md-12">
                    <div class="card border border-primary border-3 mt-2">
                        <div class="card-body">
                            <div class="card">
                                {{-- Card Header --}}
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <div class="col-sm-12 d-flex justify-content-between">
                                            Kelas {{ $namaKelas }}
                                        </div>
                                    </h3>
                                </div>

                                {{-- Card Body --}}
                                <div class="card-body" style="overflow: auto; margin-bottom: -40px;">
                                    <div class="card my-4">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Jam Ke</th>
                                                    <th class="text-center">Waktu</th>
                                                    <th class="text-center">Guru</th>
                                                    <th class="text-center">Mata Pelajaran</th>
                                                    <th class="text-center">Absen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($listMengajar as $mengajar)
                                                @php
                                                    $sudahAbsen = \App\Models\LogPresensi::where('id_mengajar', $mengajar->id_mengajar)
                                                        ->where('tanggal', \Carbon\Carbon::now()->toDateString())
                                                        ->exists();
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ $mengajar->jamke }}</td>
                                                    <td class="text-center">{{ $mengajar->jam_mengajar }}</td>
                                                    <td class="text-center">{{ $mengajar->guru->nama_guru ?? '-' }}</td>
                                                    <td class="text-center">{{ $mengajar->mapel->mapel ?? '-' }}</td>
                                                    <td class="text-center">
                                                        @if($sudahAbsen)
                                                            <span class="badge bg-success">Sudah Absen</span>
                                                        @else
                                                            <select name="absen[{{ $mengajar->id_mengajar }}]" class="form-select  absen-select" required>
                                                                <option value="">-- Pilih --</option>
                                                                <option value="hadir">Hadir</option>
                                                                <option value="izin">Izin</option>
                                                                <option value="alpha">Alpha</option>
                                                            </select>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center my-4 ">
                                <button type="button" class="btn btn-success btnSimpanAbsensi" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Pastikan semua guru sudah di Absen">Simpan Absensi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </form>
    @endforeach
</div>
@endsection

@push('scripts')
<script>
// Karena banyak form, kita target semua tombol dengan id sama
// document.querySelectorAll('#btnSimpanAbsensi').forEach(function(button) {
//         button.addEventListener('click', function(event) {
//             event.preventDefault();

//             Swal.fire({
//                 title: 'Simpan Absensi?',
//                 text: "Pastikan data sudah benar.",
//                 icon: 'question',
//                 showCancelButton: true,
//                 confirmButtonColor: '#28a745',
//                 cancelButtonColor: '#d33',
//                 confirmButtonText: 'Ya, Simpan!',
//                 cancelButtonText: 'Batal'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     // Ambil form terdekat dari tombol yang diklik
//                     event.target.closest('form').submit();
//                 }
//             });
//         });
//     });
document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    }, false);
document.querySelectorAll('.btnSimpanAbsensi').forEach(function (button) {
    button.addEventListener('click', function (event) {
        event.preventDefault();

        let form = event.target.closest('form');
        let selects = form.querySelectorAll('select[name^="absen["]:not([disabled])');
        let valid = true;

        selects.forEach(function (select) {
            if (select.value === '') {
                valid = false;
            }
        });

        if (!valid) {
            Swal.fire({
                title: 'Oops!',
                text: 'Semua Guru di kelas ini harus sudah Presensi.',
                icon: 'warning',
                confirmButtonText: 'Oke'
            });
            return;
        }

        Swal.fire({
            title: 'Simpan Absensi?',
            text: "Pastikan data sudah benar.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

</script>
@endpush
