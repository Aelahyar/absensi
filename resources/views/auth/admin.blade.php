@extends('auth.login')
@section('content')
    <form method="POST" action="/admin/login" class="login100-form validate-form">
        @csrf
        <span class="login100-form-title p-b-30">
            <img src="{{ asset('assets/img/mts.png') }}" width="150">
        </span>
        <span class="login100-form-title p-b-26">
            MTs AL-ANWAR JOMBANG
        </span>

        {{-- @php
            $messagewarning =Session::get('warning');
        @endphp
        @if (Session::get('warning'))
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="zmdi zmdi-alert-circle me-2" style="font-size: 1.5rem;"></i>
            <div class="col">
                {{ Session::get('warning') }}
            </div>
        </div>
        @endif --}}
        <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="username" required>
            <span class="focus-input100" data-placeholder="Username"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password">
            <span class="btn-show-pass">
                <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="password" required>
            <span class="focus-input100" data-placeholder="Password"></span>
        </div>

        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">
                    Login
                </button>
            </div>
        </div>
    </form>

    {{-- @if(session('success'))
    <script>
        setTimeout(() => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        }, 100);
    </script>
    @endif --}}
    @if (session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000 // Durasi tampilan SweetAlert dalam milidetik
        });
    </script>
    @endif

    @if(session('warning'))
    <script>
        setTimeout(() => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: '{{ session('warning') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        }, 100);
    </script>
    @endif


@endsection
