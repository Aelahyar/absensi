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
        {{-- <div class="card">
            <div class="card-header">
                <h4 class="card-title">About Vertical Navbar</h4>
            </div>
            <div class="card-body">
                <p>Vertical Navbar is a layout option that you can use with Mazer. </p>

                <p>In case you want the navbar to be sticky on top while scrolling, add <code>.navbar-fixed</code> class alongside with <code>.layout-navbar</code> class.</p>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Profile Visit</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-profile-visit"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Sekolah</h4>
                    </div>
                    <div class="card-content pb-4">
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="col">
                                <ion-icon name="people-outline"></ion-icon>
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">Total Siswa</h5>
                                <h6 class="text-muted mb-0">@imdean</h6>
                            </div>
                        </div>
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="col">
                                <ion-icon name="person-outline"></ion-icon>
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">Total Guru</h5>
                                <h6 class="text-muted mb-0">@dodoljohn</h6>
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
