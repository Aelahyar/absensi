@extends('admin.home')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Administrator</h3>
                <p class="text-subtitle text-muted">Selamat Datang {{ Auth::guard('admin')->user()->nama_lengkap}} | Aplikasi Absensi Siswa</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4>Profile Visit</h4>
                    </div> --}}
                    <div class="card-body">
                        <center>
                            <img src="{{ asset('assets/img/mts.png')}}" alt="MTs" width="150">
                            <br>
                            <br>
                            <h5>MTs AL ANWAR JOMBANG</h5>
                            <span>
                                Jl. Raya Cangkringrandu Perak Jombang, CANGKRINGRANDU, Kec. Perak, Kab. Jombang, Jawa Timur
                            </span>
                            <br>
                            <p>Email : mtsinsanikreasi@gmail.com Telp.081234567890</p>
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Aplikasi Absensi</h4>
                    </div>
                    <div class="card-body">
                    <p>Selamat datang {{ Auth::guard('admin')->user()->name }} di Aplikasi absensi siswa ini, Semoga harimu menyenangkan.</p>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <strong>Data Guru</strong>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Total guru ada {{$guru}}</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <strong>Data Siswa</strong>
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Total siswa ada {{$siswa}}</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    <strong>About</strong>
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Aplikasi Absensi Sekolah Al Anwar merupakan sistem informasi yang dirancang untuk mempermudah proses pencatatan kehadiran siswa secara digital. Dengan fitur yang intuitif dan efisien, aplikasi ini membantu guru dan staf sekolah dalam merekap data kehadiran, memantau absensi harian, serta menghasilkan laporan secara otomatis.
                                Aplikasi ini mendukung transparansi dan akurasi data, serta menjadi langkah nyata Sekolah Al Anwar dalam mengadopsi teknologi untuk meningkatkan kualitas administrasi pendidikan.</div>
                            </div>
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
    @if(session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    </script>
    @endif
@endpush
