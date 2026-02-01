@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height:80vh">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header text-center fw-bold bg-dark text-white">
                    🔐 Login Admin
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="/admin/login">
                        @csrf

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-dark w-100">Login Admin</button>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <small>Bukan admin? <a href="/login">Login siswa</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
