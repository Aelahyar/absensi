
<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    {{-- <a href="index.html"><img src="{{asset('assets/compiled/svg/logo.svg')}}" alt="Logo" srcset=""></a> --}}
                    <span style="font-size: 16px">MTs Al Anwar</span>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                        role="img" class="iconify iconify--system-uicons" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                        role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li
                    class="sidebar-item item {{ Route::is('dashboardadmin') ? 'active' : '' }} ">
                    <a href="{{ Route('dashboardadmin')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li
                    class="sidebar-item item {{ Route::is('kelasadmin*', 'semester*', 'tahunajaran*', "mapel*", 'walikelas*') ? 'active' : '' }} has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Data Umum</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item item {{ Route::is('kelasadmin*') ? 'active' : '' }} ">
                            <a href="{{ Route('kelasadmin.index') }}" class="submenu-link">Kelas</a>
                        </li>
                        <li class="submenu-item {{ Route::is('semester*') ? 'active' : '' }} ">
                            <a href="{{ Route('semester.index' )}}" class="submenu-link">Semester</a>
                        </li>
                        <li class="submenu-item {{ Route::is('tahunajaran*') ? 'active' : '' }} ">
                            <a href="{{ Route('tahunajaran.index') }}" class="submenu-link">Tahun Pelajaran</a>
                        </li>
                        <li class="submenu-item {{ Route::is('mapel*') ? 'active' : '' }} ">
                            <a href="{{ Route('mapel.index') }}" class="submenu-link">Mata Pelajaran</a>
                        </li>
                        <li class="submenu-item {{ Route::is('walikelas*') ? 'active' : '' }} ">
                            <a href="{{ Route('walikelas.index') }}" class="submenu-link">Wali Kelas</a>
                        </li>
                    </ul>
                </li>
                <li
                    class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-hexagon-fill"></i>
                        <span>Jadwal Mengajar</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item  ">
                            <a href="form-element-input.html" class="submenu-link">Tambah Jadwal</a>
                        </li>
                        <li class="submenu-item  ">
                            <a href="form-element-input-group.html" class="submenu-link">Daftar Mengajar</a>
                        </li>
                    </ul>
                </li>
                <li
                    class="sidebar-item {{ Route::is('kepsek*') ? 'active' : '' }} ">
                    <a href="{{ Route('kepsek.index') }}" class="sidebar-link">
                        <i class="bi bi-person-badge-fill"></i>
                        <span>Kepala Sekolah</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ Route::is('guru*') ? 'active' : '' }} ">
                    <a href="{{ Route('guru.index') }}" class="sidebar-link">
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Data Guru</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ Route::is('siswa*') ? 'active' : '' }} ">
                    <a href="{{ Route('siswa.index') }}" class="sidebar-link">
                        <i class="bi bi-clipboard-data-fill"></i>
                        <span>Data Siswa</span>
                    </a>
                </li>
                {{-- <li
                    class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-clipboard2-check-fill"></i>
                        <span>Rekap Absensi</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item  ">
                            <a href="form-element-input.html" class="submenu-link">VII</a>
                        </li>
                        <li class="submenu-item  ">
                            <a href="form-element-input-group.html" class="submenu-link">VIII</a>
                        </li>
                    </ul>
                </li> --}}
                <li
                    class="sidebar-item item active">
                    <a href="/logoutadmin" class='sidebar-link'>
                        <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

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
                                <p class="mb-0 text-sm text-gray-600">Administrator</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="./assets/compiled/jpg/1.jpg">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, Anwar!</h6>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                Profile</a></li>
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
                        {{-- @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif --}}

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
