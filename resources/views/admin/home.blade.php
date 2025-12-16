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
                        <p><span id="year"></span> &copy; Theta</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://www.instagram.com/theta_dev">Theta</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>document.getElementById("year").textContent = new Date().getFullYear();</script>
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
        // $(document).ready(function() {
        //     // Menambahkan gaya CSS langsung di dalam JavaScript
        //     var style = document.createElement('style');
        //     style.innerHTML = `
        //     th {
        //         white-space: nowrap;
        //         text-align: center;
        //         background-color: #435ebe;
        //         color:white;
        //     }

        //     td {
        //         white-space: nowrap;
        //         text-align: center;
        //     }

        //     table.dataTable {
        //         border-collapse: collapse;
        //         border-spacing: 0;
        //         border-radius: 10px; /* Menambahkan tepi yang membulat */
        //         box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); /* Menambahkan bayangan */
        //     }`;
        //     document.head.appendChild(style);
        //     $('#table1').DataTable({
        //         // ajax: 'scripts/server_processing.php',
        //         dom: '<"row"<"col-md-2"l><"col-md-6"B><"col-md-4"f>>tip',
        //         buttons: [
        //             'csv', 'excel', 'print', 'copy'
        //         ],
        //         // processing: true,
        //         paging: true,
        //         scrollCollapse: true,
        //         scrollX: true,
        //         scrollY: '100vh',
        //         fixedHeader: true,
        //         // serverSide: true
        //         columnDefs: [{
        //             "targets": '_all',
        //             "className": 'nowrap'
        //         }]
        //     });
        // });
                $(document).ready(function() {    // Tambahkan CSS custom untuk DataTables
            var style = document.createElement('style');
            style.innerHTML = `
                th {
                    white-space: nowrap;
                    text-align: center;
                    background-color: #435ebe;
                    color: white;
                }

                td {
                    white-space: nowrap;
                    text-align: center;
                }

                table.dataTable {
                    border-collapse: collapse;
                    border-spacing: 0;
                    border-radius: 10px; /* Membulatkan tepi tabel */
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); /* Tambahkan bayangan */
                }
            `;
            document.head.appendChild(style);

            var pageTitle = $('#judul-halaman').text();

            var table = $('#table1').DataTable({
                dom: '<"row"<"col-md-2"l><"col-md-6"B><"col-md-4"f>>tip',
                buttons: [
                    { extend: 'copy', title: pageTitle },
                    { extend: 'csv', title: pageTitle },
                    { extend: 'excel', title: pageTitle },
                    {
                        extend: 'print',
                        title: pageTitle,
                        messageTop: function () {
                            return 'Dicetak pada: ' + new Date().toLocaleDateString();
                        }
                    }
                ],
                paging: true,
                scrollCollapse: true,
                scrollX: true,
                scrollY: '100vh',
                fixedHeader: true,
                columnDefs: [{
                    "targets": '_all',
                    "className": 'nowrap'
                }]
            });

            // Buat nomor urut dinamis di kolom pertama
            table.on('order.dt search.dt', function () {
                let i = 1;
                table.cells(null, 0, { search: 'applied', order: 'applied' })
                    .every(function (cell) {
                        this.data(i++);
                    });
            }).draw();
        });

    </script>
    @stack('scripts')

    <script>
        function _0x3be2(_0x12a478,_0x5a236d){var _0x5532d0=_0x5532();return _0x3be2=function(_0x3be2e1,_0x1070c9){_0x3be2e1=_0x3be2e1-0x18f;var _0x5054ae=_0x5532d0[_0x3be2e1];return _0x5054ae;},_0x3be2(_0x12a478,_0x5a236d);}function _0x5532(){var _0x228ce2=['231tjUIaP','ctrlKey','charCodeAt','912618FJpSLi','50856LFLVzT','onkeydown','493563tCYAeo','4Wmfukd','660768RHEhaK','keyCode','shiftKey','1034035zgEWSD','201276aKSVRs','1951542SBhygu'];_0x5532=function(){return _0x228ce2;};return _0x5532();}var _0x2088cf=_0x3be2;(function(_0x31cfc0,_0x82b308){var _0x5e6ca5=_0x3be2,_0x1116db=_0x31cfc0();while(!![]){try{var _0x3aca73=-parseInt(_0x5e6ca5(0x195))/0x1+parseInt(_0x5e6ca5(0x191))/0x2+-parseInt(_0x5e6ca5(0x18f))/0x3+parseInt(_0x5e6ca5(0x190))/0x4*(parseInt(_0x5e6ca5(0x194))/0x5)+parseInt(_0x5e6ca5(0x196))/0x6+parseInt(_0x5e6ca5(0x197))/0x7*(-parseInt(_0x5e6ca5(0x19b))/0x8)+-parseInt(_0x5e6ca5(0x19a))/0x9;if(_0x3aca73===_0x82b308)break;else _0x1116db['push'](_0x1116db['shift']());}catch(_0x36f996){_0x1116db['push'](_0x1116db['shift']());}}}(_0x5532,0x2d47c),document[_0x2088cf(0x19c)]=function(_0x1cd9ba){var _0x2faad3=_0x2088cf;if(event['keyCode']==0x7b)return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba[_0x2faad3(0x192)]=='E'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba['shiftKey']&&_0x1cd9ba[_0x2faad3(0x192)]=='I'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba[_0x2faad3(0x193)]&&_0x1cd9ba['keyCode']=='J'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba['keyCode']=='U'['charCodeAt'](0x0))return![];if(_0x1cd9ba['ctrlKey']&&_0x1cd9ba[_0x2faad3(0x192)]=='S'['charCodeAt'](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba['keyCode']=='H'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba['ctrlKey']&&_0x1cd9ba[_0x2faad3(0x192)]=='A'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba[_0x2faad3(0x192)]=='F'[_0x2faad3(0x199)](0x0))return![];if(_0x1cd9ba[_0x2faad3(0x198)]&&_0x1cd9ba['keyCode']=='E'[_0x2faad3(0x199)](0x0))return![];});
    </script>
    <script type="text/javascript">
        var _0x8c9ed9=_0x5171;function _0x5171(_0x154f79,_0x5519f9){var _0x29adf5=_0x29ad();return _0x5171=function(_0x51717b,_0x28f8e4){_0x51717b=_0x51717b-0x175;var _0x952154=_0x29adf5[_0x51717b];return _0x952154;},_0x5171(_0x154f79,_0x5519f9);}(function(_0x4e0b7f,_0x35fd5c){var _0x2d1d74=_0x5171,_0x4e4922=_0x4e0b7f();while(!![]){try{var _0x4ec52a=-parseInt(_0x2d1d74(0x17e))/0x1+-parseInt(_0x2d1d74(0x17f))/0x2+-parseInt(_0x2d1d74(0x178))/0x3*(parseInt(_0x2d1d74(0x176))/0x4)+parseInt(_0x2d1d74(0x179))/0x5+parseInt(_0x2d1d74(0x184))/0x6*(-parseInt(_0x2d1d74(0x189))/0x7)+-parseInt(_0x2d1d74(0x17a))/0x8*(parseInt(_0x2d1d74(0x181))/0x9)+parseInt(_0x2d1d74(0x17c))/0xa;if(_0x4ec52a===_0x35fd5c)break;else _0x4e4922['push'](_0x4e4922['shift']());}catch(_0x270bd9){_0x4e4922['push'](_0x4e4922['shift']());}}}(_0x29ad,0xc2ce5));var message=_0x8c9ed9(0x185);function clickdsb(){var _0x31df7f=_0x8c9ed9;if(event[_0x31df7f(0x17b)]==0x2)return alert(message),![];}function clickbsb(_0x56c098){var _0x2da426=_0x8c9ed9;if(document[_0x2da426(0x182)]||document['getElementById']&&!document[_0x2da426(0x175)]){if(_0x56c098['which']==0x2||_0x56c098[_0x2da426(0x17d)]==0x3)return alert(message),![];}}function _0x29ad(){var _0x185c96=['captureEvents','501788oSwIJu','all','4REUGeB','onmousedown','1136823GNTgFM','86700RbosTL','87880OIPzot','button','37002260KxZbSj','which','244418BRIIYa','1455646nNYtiQ','MOUSEDOWN','639zlnhem','layers','getElementById','66SVoTuz','Function\x20Disabled!','oncontextmenu','alert(message);return\x20false'];_0x29ad=function(){return _0x185c96;};return _0x29ad();}if(document['layers'])document[_0x8c9ed9(0x188)](Event[_0x8c9ed9(0x180)]),document[_0x8c9ed9(0x177)]=clickbsb;else document['all']&&!document[_0x8c9ed9(0x183)]&&(document[_0x8c9ed9(0x177)]=clickdsb);document[_0x8c9ed9(0x186)]=new Function(_0x8c9ed9(0x187));
    </script>
</body>
</html>
