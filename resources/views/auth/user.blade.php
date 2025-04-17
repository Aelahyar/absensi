@extends('auth.login')
@section('content')
    <form action="/login" method="POST">
        @csrf
        <span class="login100-form-title p-b-30">
            <img src="{{ asset('assets/img/mts.png') }}" width="150">
        </span>
        <span class="login100-form-title p-b-14">
            MTs AL-ANWAR JOMBANG
        </span>

        @php
            $messagewarning =Session::get('warning');
        @endphp
        @if (Session::get('warning'))
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="zmdi zmdi-alert-circle me-2" style="font-size: 1.5rem;"></i>
            <div class="col">
                {{ Session::get('warning') }}
            </div>
        </div>
        @endif

        <div class="wrap-input100 validate-input">
            <input class="input100" type="email" name="email" required>
            <span class="focus-input100" data-placeholder="Email address"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="password">
            <span class="btn-show-pass">
                <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="password" required>
            <span class="focus-input100" data-placeholder="Password"></span>
        </div>
        <br>

        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button type="submit" class="login100-form-btn">
                    Log in
                </button>
            </div>
        </div>
    </form>
@endsection
