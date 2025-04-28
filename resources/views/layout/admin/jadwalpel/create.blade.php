@extends('admin.home')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="col-md-12">
            <div class="card border border-primary border-3">
                <div class="card-body">
                    <div class="card">
                        {{-- card header --}}
                        <div class="card-header">
                            <h5 class="card-title">
                                <div class="col-sm-12 d-flex justify-content-between">
                                    Tambah Jadwal Pelajaran
                                </div>
                            </h5>
                        </div>
                        {{-- Section --}}
                        <div class="col-md-12 mt-2">
                            <div class="card">
                                <div class="card-header">
                                    <form method="POST" action="{{ route('jadwalajar.store') }}" class="row g-3" id="myForm">
                                        @csrf
                                        <div class="col-md-4">
                                            <label for="kodepel" class="form-label">Kode Pelajaran</label>
                                            <input type="text" class="form-control" id="kodepel" name="kodepel" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="thajar" class="form-label">Tahun Pelajaran</label>
                                            <input type="text" class="form-control" id="thajar" value="{{ optional($thajar)->tahun_ajaran ?? 'Belum diatur' }}" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="semester" class="form-label">Semester</label>
                                            <input type="text" class="form-control" id="semester" value="{{ optional($semester)->semester ?? 'Belum diatur' }}" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="basic-usage" class="form-label">Guru Mata Pelajaran</label>
                                            <select class="form-select select2" style="width: 100%;" name="guru_mapel" id="guru_mapel" data-placeholder="Pilih Guru">
                                                <option value="">Pilih Guru</option>
                                                @foreach ($guru as $Guru)
                                                    <option value="{{ $Guru->id_guru }}">{{ $Guru->nama_guru }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="basic-usage" class="form-label">Mata Pelajaran</label>
                                            <select class="form-select select2" style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                name="mapel" id="mapel" data-placeholder="Pilih Mata Pelajaran">
                                                <option value="">Pilih Mata Pelajaran</option>
                                                @foreach ($mapel as $item)
                                                    <option value="{{ $item->id_mapel }}">{{ $item->mapel }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="basic-usage" class="form-label">Kelas</label>
                                            <select class="form-select select2" style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                name="kelas" id="kelas" data-placeholder="Pilih Kelas">
                                                <option value="">Pilih Kelas</option>
                                                @foreach ($kelas as $item)
                                                    <option value="{{ $item->id_mkelas }}">{{ $item->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="hari" class="form-label">Hari</label>
                                            <select class="form-select select2" style="width: 100%;" name="hari" id="hari" data-placeholder="Pilih Hari">
                                                <option value="">Pilih Hari</option>
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selasa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Kamis">Kamis</option>
                                                <option value="Jumat">Jumat</option>
                                                <option value="Sabtu">Sabtu</option>
                                                <option value="Minggu">Minggu</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="jamke" class="form-label">Jam Ke</label>
                                            <input type="text" class="form-control" id="jamke" name="jamke">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="waktu" class="form-label">Waktu</label>
                                            <div class="d-flex align-items-center">
                                                <input type="time" id="jam_mulai" name="jam_mulai" class="form-control" style="max-width: 150px;">
                                                <span class="mx-2">-</span>
                                                <input type="time" id="jam_selesai" name="jam_selesai" class="form-control" style="max-width: 150px;">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary" onclick="addRow()">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- end Section --}}
                        {{-- table --}}
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-body border border-2 border-primary" style="overflow: scroll" content="{{ csrf_token() }}">
                                        <table class="table" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">Kode Pelajaran</th>
                                                    <th scope="col" class="text-center">Tahun Pelajaran</th>
                                                    <th scope="col" class="text-center">Semester</th>
                                                    <th scope="col" class="text-center">Guru</th>
                                                    <th scope="col" class="text-center">Mata Pelajaran</th>
                                                    <th scope="col" class="text-center">Kelas</th>
                                                    <th scope="col" class="text-center">Hari</th>
                                                    <th scope="col" class="text-center">Waktu</th>
                                                    <th scope="col" class="text-center">Jam ke</th>
                                                    <th scope="col" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12 mt-3 text-end">
                                        <button type="submit" class="btn btn-success" onclick="simpanData()">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end Table --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    function generateKodePel() {
        let now = new Date();
        let kode = 'MPL-' +
            now.getFullYear().toString() +
            ('0' + (now.getMonth() + 1)).slice(-2) +
            ('0' + now.getDate()).slice(-2) +
            ('0' + now.getHours()).slice(-2) +
            ('0' + now.getMinutes()).slice(-2) +
            ('0' + now.getSeconds()).slice(-2);
        return kode;
    }

    $(document).ready(function() {
        $('#kodepel').val(generateKodePel());
    });

    function validateForm() {
        // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
        let emptyFields = [];

        // Mendapatkan nilai dari semua input
        let kodepel = $('#kodepel').val();
        let thajar = $('#thajar').val();
        let semester = $('#semester').val();
        let guru_mapel = $('#guru_mapel').val();
        let mapel = $('#mapel').val();
        let kelas = $('#kelas').val();
        let hari = $('#hari').val();
        let jam_mulai = $('#jam_mulai').val();
        let jam_selesai = $('#jam_selesai').val();
        let jamke = $('#jamke').val();

        // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
        if (!kodepel) emptyFields.push('Kode Pelajaran');
        if (!thajar) emptyFields.push('Tahun Ajaran');
        if (!semester) emptyFields.push('Semester');
        if (!guru_mapel) emptyFields.push('Guru');
        if (!mapel) emptyFields.push('Mata Pelajaran');
        if (!kelas) emptyFields.push('Kelas');
        if (!hari) emptyFields.push('Hari');
        if (!jam_mulai || !jam_selesai) emptyFields.push('Jam Mulai dan Jam Selesai');
        if (!jamke) emptyFields.push('Jam Ke');

        // Jika daftar kolom yang belum diisi tidak kosong, tampilkan pesan peringatan
        if (emptyFields.length > 0) {
            Swal.fire({
                title: 'Warning!',
                html: "Harap isi kolom berikut: <br>" + emptyFields.join('<br>'),
                icon: 'warning'
            });
            return false;
        } else {
            return true; // Form valid
        }
    }

    let dataArray = [];
    // ADD ROW
    function addRow() {
        if (validateForm()) {

            let kodepel = $('#kodepel').val();
            let thajar = $('#thajar').val();
            let semester = $('#semester').val();
            let guru_mapel = $('#guru_mapel').val(); // id guru
            let guru_nama = $('#guru_mapel option:selected').text(); // nama guru
            let mapel = $('#mapel').val(); // id mapel
            let mapel_nama = $('#mapel option:selected').text(); // nama mapel
            let kelas = $('#kelas').val(); // id kelas
            let kelas_nama = $('#kelas option:selected').text(); // nama kelas
            let hari = $('#hari').val();
            let jam_mulai = $('#jam_mulai').val();
            let jam_selesai = $('#jam_selesai').val();
            let waktu = jam_mulai + '-' + jam_selesai;
            let jamke = $('#jamke').val();

            let newRow = `<tr>` +
                `<td class="text-center">${kodepel}</td>` +
                `<td class="text-center">${thajar}</td>` +
                `<td class="text-center">${semester}</td>` +
                `<td class="text-center">${guru_nama}</td>` +
                `<td class="text-center">${mapel_nama}</td>` +
                `<td class="text-center">${kelas_nama}</td>` +
                `<td class="text-center">${hari}</td>` +
                `<td class="text-center">${waktu}</td>` +
                `<td class="text-center">${jamke}</td>` +
                `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                `</tr>`;
            // add table
            $('#dataTable tbody').append(newRow);
            $('#kodepel').val(generateKodePel());
            // clear
            $('#guru_mapel').val('').trigger('change');
            $('#mapel').val('').trigger('change');
            $('#kelas').val('').trigger('change');
            $('#hari').val('').trigger('change');
            $('#jam_mulai').val('');
            $('#jam_selesai').val('');
            $('#jamke').val('');
            // Tambahkan ke array dataArray
            console.log(dataArray);
            dataArray.push({
                kodepel: kodepel,
                thajar: thajar,
                semester: semester,
                guru_mapel: guru_mapel,
                mapel: mapel,
                kelas: kelas,
                hari: hari,
                waktu: waktu,
                jamke: jamke
            });
        }
    }

    function hapusBaris(button) {
        // Cari baris yang dihapus
        let row = $(button).closest('tr');
        // Cari index dari baris tersebut
        let index = row.index();
        // Hapus dari array
        dataArray.splice(index, 1);
        // Hapus dari tabel
        row.fadeOut(300, function() {
            $(this).remove();
        });
        console.log(dataArray);
    }

    function simpanData() {
        if (dataArray.length === 0) {
            Swal.fire('Warning!', 'Belum ada data yang ditambahkan.', 'warning');
            return; // Stop proses simpan kalau belum ada data
        }
        // Kalau ada data, lanjut kirim ke server
        $.ajax({
            url: "{{ route('jadwalajar.store') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // untuk keamanan CSRF Laravel
                jadwals: dataArray // kirim array
            },
            success: function(response) {
                Swal.fire('Berhasil!', 'Data berhasil disimpan!', 'success')
                .then(() => {
                    window.location.href = "{{ route('jadwalajar.index') }}";
                });
            },
            error: function(xhr) {
                Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan.', 'error');
            }
        });
    }
</script>
@endpush
