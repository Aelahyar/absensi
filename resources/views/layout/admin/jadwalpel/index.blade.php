@extends('admin.home')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboardadmin">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Jadwal</li>
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
                                    Data Jadwal Pelajaran
                                    <button type="button" onclick="redirectToPage()"
                                        class="btn btn-outline-success rounded-pill">
                                        <strong>Add Data</strong>
                                    </button>
                                </div>
                            </h5>
                        </div>

                        {{-- Card Body --}}
                        <div class="card-body" style="overflow: auto;">
                            <div class="table-responsive">
                                <table id="table1" class="display table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Guru</th>
                                            <th class="text-center">Mata Pelajaran</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">TP/Semester</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jadwalajar as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $item->guru->nama_guru ?? '-' }}</td>
                                                <td class="text-center">{{ $item->mapel->mapel ?? '-' }}</td>
                                                <td class="text-center">{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                                <td class="text-center">{{ $item->id_semester }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-1">
                                                        {{-- Tombol Edit --}}
                                                        <a href="{{ route('jadwalajar.edit', $item->id_mengajar) }}"
                                                            class="btn btn-link" title="Edit Task"
                                                            data-original-title="Edit Task">
                                                            <i class="bi bi-pencil-square text-success"></i>
                                                        </a>
                                                        {{-- Tombol Delete --}}
                                                        <form id="deleteForm{{ $item->id_mengajar }}" action="{{ route('jadwalajar.destroy', $item->id_mengajar) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link p-0" onclick="confirmDelete({{ $item->id_mengajar }})">
                                                                <i class="bi bi-trash3 text-danger fs-5"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data Jadwal Pelajaran belum Tersedia.
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
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
<script>
    function redirectToPage() {
        window.location.href = "{{ route('jadwalajar.create') }}";
    }
    function confirmDelete(id_mengajar) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id_mengajar).submit();
            }
        });
    }
</script>
@endpush
