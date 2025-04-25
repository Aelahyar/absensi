@extends('user.userhome')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ Route('dashboarduser') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Absensi Siswa</li>
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
                                    Absensi Siswa
                                </div>
                            </h5>
                        </div>


                        {{-- Card Body --}}
                        <div class="card-body" style="overflow: auto;">
                            <form action="{{ route('absensi.store') }}" method="POST">
                                @csrf
                                <input type="date" name="tgl_absen" value="{{ $tgl_absen }}" class="form-control mb-3" readonly>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama Siswa</th>
                                            <th class="text-center">Absensi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siswas as $siswa)
                                            @php
                                                $sudahAbsen = $siswa->logAbsensi()->where('tgl_absen', $tgl_absen)->exists();
                                            @endphp

                                            <tr>
                                                <td class="text-center">
                                                    {{ $siswa->nama_siswa }}
                                                    @if($sudahAbsen)
                                                        <span class="badge bg-success text-center text-white">Sudah absen</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="hidden" name="id_siswa[]" value="{{ $siswa->id_siswa }}">

                                                    @if(!$sudahAbsen)
                                                        <select name="keterangan[{{ $siswa->id_siswa }}]" class="form-control" required>
                                                            <option value="" class="text-center">-- Pilih Keterangan --</option>
                                                            <option value="H" class="text-center">Hadir</option>
                                                            <option value="I" class="text-center">Izin</option>
                                                            <option value="S" class="text-center">Sakit</option>
                                                            <option value="A" class="text-center">Alfa</option>
                                                        </select>
                                                    @else
                                                        <em>Absen tidak bisa diubah.</em>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <button type="button" id="btnSimpanAbsensi" class="btn btn-success">Simpan Absensi</button>

                            </form>
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
document.getElementById('btnSimpanAbsensi').addEventListener('click', function (event) {
    event.preventDefault();

    let valid = true;
    let selects = document.querySelectorAll('select[name^="keterangan"]');

    selects.forEach(function (select) {
        if (select.value === '') {
            valid = false;
        }
    });

    if (!valid) {
        Swal.fire({
            title: 'Oops!',
            text: 'Semua siswa harus memiliki keterangan.',
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
            // Ambil form dari tombol yang diklik
            event.target.closest('form').submit();
        }
    });
});

</script>
@endpush
