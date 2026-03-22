@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
        min-height: 100vh;
        overflow: hidden;
    }

    /* wrapper */
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 15px;
    }

    /* glass card */
    .glass-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        color: white;
        width: 100%;
    }

    /* input */
    .form-control {
        border-radius: 12px;
        padding: 12px;
    }

    /* button */
    .btn-modern {
        background: #facc15;
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
    }

    /* password icon */
    .password-toggle {
        cursor: pointer;
    }

    /* logo */
    .login-image {
        max-width: 260px;
        width: 100%;
    }

    /* mobile */
    @media (max-width:768px) {

        /* Mengurangi padding wrapper agar konten lebih naik */
        .login-wrapper {
            padding-top: 100px;
            /* Lebih kecil dari sebelumnya */
            align-items: flex-start;
        }

        .login-image {
            max-width: 180px;
            /* Sedikit lebih kecil agar tidak makan tempat */
            margin-top: -20px;
            /* Menarik logo sedikit ke atas */
            margin-bottom: 10px !important;
            /* Mengurangi jarak bawah logo */
        }

        .glass-card {
            padding: 25px;
            margin-bottom: 20px;
        }
    }
</style>


<div class="container-fluid login-wrapper">

    <div class="row justify-content-center w-100">

        <div class="col-12 text-center mb-4" data-aos="fade-down">
            <img src="{{ asset('storage/LogoMusabaV9.png') }}"
                class="login-image"
                alt="logo">
        </div>

        <div class="col-11 col-sm-8 col-md-5 col-lg-4" data-aos="fade-up">

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
                        <input type="text"
                            name="nis"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>

                        <div class="position-relative">
                            <input type="password"
                                id="password"
                                name="password"
                                class="form-control pe-5"
                                required>

                            <span class="position-absolute top-50 end-0 translate-middle-y me-3 password-toggle"
                                onclick="togglePassword()">👁</span>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox"
                            name="remember"
                            class="form-check-input">
                        <label class="form-check-label">
                            Remember Me
                        </label>
                    </div>

                    <!-- BUTTON -->
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
    AOS.init({
        duration: 800
    });

    function togglePassword() {
        let password = document.getElementById("password");
        password.type = password.type === "password" ? "text" : "password";
    }
</script>

@endsection