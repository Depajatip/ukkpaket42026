@extends('layouts.app')

@section('content')

{{-- AOS CSS --}}
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<div class="katalog-wrapper py-5">

    <div class="container">

        {{-- HEADER --}}
        <div class="text-center mb-5" data-aos="fade-down">
            <h2 class="fw-bold katalog-title">
                Koleksi Buku Perpustakaan
            </h2>
            <p class="text-light opacity-75">
                Temukan buku favoritmu dan nikmati pengalaman membaca terbaik
            </p>
        </div>

        <div class="mb-4 position-relative">

            <div class="input-group" data-aos="fade-down">

                <input type="text"
                    id="search"
                    class="form-control"
                    placeholder="Cari buku...">

            </div>

        </div>

        <div class="d-flex justify-content-start mb-3 d-md-none gap-1" data-aos="fade-down">

            <button class="btn btn-light layout-btn" data-layout="list">
                ☰
            </button>

            <button class="btn btn-light layout-btn" data-layout="grid2">
                ⬜⬜
            </button>

        </div>

        {{-- GRID --}}
        <div class="row layout-list g-4" id="bukuGrid">

            @include('buku.gridkatalog')

        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* ================= AOS ================= */

    AOS.init({
        duration: 500,
        once: true,
        offset: 120
    });


    /* ================= LAYOUT ================= */

    const grid = document.getElementById("bukuGrid");
    const buttons = document.querySelectorAll(".layout-btn");

    function applyLayout(layout){

        const items = document.querySelectorAll(".buku-item");

        items.forEach(item => {

            item.classList.remove("col-12","col-6");

            if(layout === "list"){
                item.classList.add("col-12");
            }

            if(layout === "grid2"){
                item.classList.add("col-6");
            }

        });

    }

    function setActiveButton(layout){

        buttons.forEach(btn => {

            btn.classList.remove("active");

            if(btn.dataset.layout === layout){
                btn.classList.add("active");
            }

        });

    }

    function initLayout(){

        let savedLayout = localStorage.getItem("layoutMode") || "list";

        applyLayout(savedLayout);
        setActiveButton(savedLayout);

        buttons.forEach(btn => {

            btn.onclick = function(){

                let layout = this.dataset.layout;

                applyLayout(layout);
                setActiveButton(layout);

                localStorage.setItem("layoutMode", layout);

            };

        });

    }

    initLayout();


    /* ================= LIVE SEARCH ================= */

    const searchInput = document.getElementById("search");

    let timeout = null;

    searchInput.addEventListener("keyup", function(){

        clearTimeout(timeout);

        let query = this.value;

        timeout = setTimeout(() => {

            fetch(`/buku?search=${query}`,{
                headers:{
                    "X-Requested-With":"XMLHttpRequest"
                }
            })
            .then(res => res.text())
            .then(html => {

                grid.innerHTML = html;

                /* aktifkan ulang layout setelah grid diganti */
                initLayout();

                /* refresh animasi AOS */
                AOS.refresh();

            });

        },300);

    });

});
</script>

{{-- ================= STYLE ================= --}}

<style>
    #bukuGrid .buku-item {
        transition: all .25s ease;
    }

    .katalog-wrapper {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        min-height: 100vh;
    }

    .katalog-title {
        color: #fff;
        font-size: 20px;
        letter-spacing: 1px;
    }

    /* CARD */

    .katalog-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        overflow: hidden;
        transition: all .4s ease;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .25);
        border: 1px solid rgba(255, 255, 255, .15);
    }

    .katalog-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 25px 50px rgba(0, 0, 0, .4);
    }

    /* IMAGE */

    .katalog-img-wrapper {
        position: relative;
        overflow: hidden;
    }

    .katalog-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform .5s ease;
    }

    .katalog-card:hover .katalog-img {
        transform: scale(1.15) rotate(1deg);
    }

    /* BADGE */

    .year-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.7);
        padding: 6px 12px;
        border-radius: 30px;
        color: #fff;
        font-size: 12px;
        backdrop-filter: blur(5px);
        transform: translateY(-10px);
        opacity: 0;
        transition: all .3s ease;
    }

    .katalog-card:hover .year-badge {
        transform: translateY(0);
        opacity: 1;
    }

    /* BODY */

    .katalog-body {
        padding: 20px;
        color: white;
    }

    .katalog-judul {
        font-weight: 600;
        margin-bottom: 5px;
    }

    /* STOK */

    .stok-badge {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 12px;
        margin-bottom: 10px;
        display: inline-block;
    }

    .tersedia {
        background: rgba(0, 255, 150, .2);
        color: #00ffae;
    }

    .habis {
        background: rgba(255, 0, 0, .2);
        color: #ff5c5c;
    }

    /* BUTTON */

    .btn-action {
        border-radius: 30px;
        font-weight: 600;
        transition: all .3s ease;
    }

    .btn-action:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .3);
    }

    .layout-btn.active {
        background: #0d6efd;
        color: white;
    }
</style>

@endsection