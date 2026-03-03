@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
        min-height: 100vh;
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px;
    }

    .btn-modern {
        background: #facc15;
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    .password-toggle {
        cursor: pointer;
    }
</style>

<div class="container login-wrapper">
    <div class="row w-100 align-items-center">

        <div class="col-md-6 text-center d-none d-md-block" data-aos="fade-right">
            <img src="{{ asset('storage/LogoMusabaV9.png') }}"
                alt="Login Illustration"
                class="img-fluid login-image">
        </div>

        <!-- Login Form -->
        <div class="col-md-6" data-aos="fade-left">
            <div class="glass-card">

                <h3 class="text-center mb-4 fw-bold">
                    📚 Login Perpustakaan
                </h3>

                @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control" required>
                    </div>

                    <div class="mb-3 position-relative">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        <span class="position-absolute end-0 pb-5 translate-middle-y me-3 password-toggle" onclick="togglePassword()">👁</span>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input">
                        <label class="form-check-label">Remember Me</label>
                    </div>

                    <button class="btn btn-modern w-100">
                        Login Sekarang
                    </button>
                </form>

                <p class="text-center mt-4 small">
                    Akun diberikan oleh admin perpustakaan
                </p>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init();

    function togglePassword() {
        let password = document.getElementById("password");
        password.type = password.type === "password" ? "text" : "password";
    }
</script>
@endsection