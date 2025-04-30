<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Presensi</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset( 'assets/compiled/css/app.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'assets/compiled/css/app-dark.css' ) }}">
    <link rel="stylesheet" href="{{ asset( 'assets/compiled/css/iconly.css' ) }}">
    {{-- SweetAlert --}}
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('assets/extensions/select2/css/select2.css') }}">
    {{-- DataTable --}}
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables/css/buttons.dataTables.min.css') }}">
</head>
<body>
    <script src="{{ asset( 'assets/static/js/initTheme.js' ) }}"></script>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand navbar-light navbar-top">
                <div class="container-fluid">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-lg-0">

                        </ul>
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">
                                    <div class="user-name text-end me-3">
                                        <h6 class="mb-0 text-gray-600">{{ Auth::guard('admin')->user()->nama_lengkap}}</h6>
                                        <p class="mb-0 text-sm text-gray-600">{{ Auth::guard('admin')->user()->username}}</p>
                                    </div>
                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <img src="{{ asset('assets/compiled/jpg/1.jpg') }}" alt="Avatar">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                <li>
                                    <h6 class="dropdown-header">Hello, {{ Auth::guard('admin')->user()->nama_lengkap}}!</h6>
                                </li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#MyProfile">
                                    <i class="icon-mid bi bi-person me-2"></i> My Profile</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#gantiPassword">
                                        <i class="icon-mid bi bi-gear me-2"></i> Settings
                                    </a>
                                </li>
                                        <hr class="dropdown-divider">
                                <li><a class="dropdown-item" href="/logoutadmin"><i
                                            class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Modal My Profile -->
            <div class="modal fade" id="MyProfile" tabindex="-1" aria-labelledby="gantiPass" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content shadow">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="gantiPass">My Profil</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row align-items-center">
                                <!-- Avatar -->
                                <div class="col-4 text-center">
                                    <img src="{{ asset('assets/compiled/jpg/1.jpg') }}" alt="Avatar" class="rounded-circle img-fluid" style="width: 100px; height: 100px; object-fit: cover;">
                                </div>

                                <!-- Info Profil -->
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" placeholder="{{ Auth::guard('admin')->user()->nama_lengkap }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" placeholder="{{ Auth::guard('admin')->user()->username }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Ganti Password -->
            <div class="modal fade" id="gantiPassword" tabindex="-1" role="dialog" aria-labelledby="gantiPass" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('update.password') }}">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Update Akun</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group mb-3">
                                    <label>Nama Lengkap</label>
                                    <input name="nama_lengkap" type="text" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Username</label>
                                    <input name="username" type="text" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Password Lama</label>
                                    <input name="pass" type="password" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Password Baru</label>
                                    <input name="pass1" type="password" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Konfirmasi Password Baru</label>
                                    <input name="pass1_confirmation" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </header>
        <!-- App Bottom Menu -->
        @include('admin.bottom')
        <!-- * App Bottom Menu -->

        <div id="main" class='layout-navbar navbar-fixed'>
            <div id="main-content">
                    <!-- App Capsule -->
                    <div id="appCapsule">
                        @yield('content')
                    </div>
                    <!-- * App Capsule -->
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2025 &copy; Big Family</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Big Family</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{asset('assets/extensions/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('assets/static/js/components/dark.js')}}"></script>
    <script src="{{asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script src="{{asset('assets/compiled/js/app.js')}}"></script>

    <!-- Need: Apexcharts -->
    <script src="{{asset('assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/static/js/pages/dashboard.js')}}"></script>
    {{-- SweetAlert --}}
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/sweetalert2.js') }}"></script>
    {{-- DataTable --}}
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
    <!-- DataTables FixedHeader JS -->
    <script src="{{ asset('assets/js/dataTables.fixedHeader.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000 // Durasi tampilan SweetAlert dalam milidetik
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Oops!',
                text: '{{ session('error') }}',
                icon: 'error',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500
            });
        @endif

            // DataTables
            $(document).ready(function() {
            // Menambahkan gaya CSS langsung di dalam JavaScript
            var style = document.createElement('style');
            style.innerHTML = `
            th {
                white-space: nowrap;
                text-align: center;
                background-color: #435ebe;
                color:white;
            }

            td {
                white-space: nowrap;
                text-align: center;
            }

            table.dataTable {
                border-collapse: collapse;
                border-spacing: 0;
                border-radius: 10px; /* Menambahkan tepi yang membulat */
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); /* Menambahkan bayangan */
            }`;
            document.head.appendChild(style);
            $('#table1').DataTable({
                // ajax: 'scripts/server_processing.php',
                dom: '<"row"<"col-md-2"l><"col-md-6"B><"col-md-4"f>>tip',
                buttons: [
                    'csv', 'excel', 'print', 'copy'
                ],
                // processing: true,
                paging: true,
                scrollCollapse: true,
                scrollX: true,
                scrollY: '100vh',
                fixedHeader: true,
                // serverSide: true
                columnDefs: [{
                    "targets": '_all',
                    "className": 'nowrap'
                }]
            });
        });

    </script>
    @stack('scripts')
</body>
</html>
