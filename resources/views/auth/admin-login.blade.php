@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #1f1c2c, #928dab);
    min-height: 100vh;
}

.glass-admin {
    background: rgba(0,0,0,0.4);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.5);
    color: white;
}

.btn-admin {
    background: #facc15;
    border: none;
    border-radius: 12px;
    padding: 12px;
    font-weight: 600;
    transition: 0.3s;
}

.btn-admin:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
}
</style>

<div class="container d-flex align-items-center justify-content-center" style="min-height:100vh">

    <div class="col-md-5" data-aos="zoom-in">
        <div class="glass-admin">

            <h3 class="text-center mb-4 fw-bold">
                🔐 Login Admin Panel
            </h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/admin/login">
                @csrf

                <div class="mb-3">
                    <label>Email Admin</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-admin w-100">
                    Masuk Dashboard
                </button>
            </form>

            <p class="text-center mt-4 small">
                Bukan admin? <a href="/login" class="text-warning">Login siswa</a>
            </p>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init();
</script>
@endsection