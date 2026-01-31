@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Dashboard Admin</h2>
    <p>Halo, {{ auth()->user()->name }}</p>
    <p>Role: {{ auth()->user()->role }}</p>
</div>
@endsection
