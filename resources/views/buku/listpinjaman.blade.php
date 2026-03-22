@extends('layouts.app')

@section('content')

{{-- AOS CSS --}}
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<div class="peminjaman-wrapper py-5">

    <div class="container">

        {{-- HEADER --}}
        <div class="text-center mb-5" data-aos="fade-down">
            <h2 class="fw-bold text-white">
                📚 Peminjaman Aktif Saya
            </h2>
            <p class="text-light opacity-75">
                Pantau status peminjaman buku Anda secara real-time
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

        </form>

        <div class="d-flex justify-content-start mb-3 d-md-none gap-1" data-aos="fade-down">

            <button class="btn btn-light layout-btn" data-layout="list">
                ☰
            </button>

            <button class="btn btn-light layout-btn" data-layout="grid2">
                ⬜⬜
            </button>

        </div>

        @if($transaksi->count() == 0)

        <div class="text-center py-5" data-aos="zoom-in">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"
                width="130"
                class="mb-4 floating">
            <h5 class="text-light opacity-75">
                Tidak ada buku yang sedang dipinjam
            </h5>
        </div>

        @else

        {{-- GRID --}}
        <div class="row layout-list g-4" id="bukuGrid">

            @include('buku.gridpinjam')

        </div>

        @endif

    </div>
</div>

<style>
        #bukuGrid .buku-item {
        transition: all .25s ease;
    }
    /* BACKGROUND */
    .peminjaman-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #141e30, #243b55);
    }

    /* CARD */
    .pinjam-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        overflow: hidden;
        transition: all .4s ease;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .3);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .pinjam-card:hover {
        transform: translateY(-12px) scale(1.03);
        box-shadow: 0 30px 60px rgba(0, 0, 0, .45);
    }

    /* IMAGE */
    .pinjam-img-wrapper {
        position: relative;
        overflow: hidden;
    }

    .pinjam-img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        transition: transform .5s ease;
    }

    .pinjam-card:hover .pinjam-img {
        transform: scale(1.12) rotate(1deg);
    }

    /* STATUS BADGE */
    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 12px;
        backdrop-filter: blur(5px);
        color: white;
    }

    .waiting {
        background: rgba(255, 193, 7, .8);
    }

    .dipinjam {
        background: rgba(13, 110, 253, .85);
    }

    .returning {
        background: rgba(0, 200, 255, .85);
    }

    /* BODY */
    .pinjam-body {
        padding: 20px;
    }

    /* BUTTON */
    .btn-action {
        border-radius: 30px;
        font-weight: 600;
        transition: all .3s ease;
    }

    .btn-action:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(255, 255, 255, .25);
    }

    .layout-btn.active {
        background: #0d6efd;
        color: white;
    }

    /* EMPTY FLOATING */
    .floating {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    /* RESPONSIVE */
    @media(max-width:768px) {
        .pinjam-img {
            height: 200px;
        }
    }
</style>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        /* ================= AOS ================= */

        AOS.init({
            duration: 500,
            once: true,
            offset: 120
        });


        /* ================= LAYOUT ================= */

        const grid = document.getElementById("bukuGrid");
        const buttons = document.querySelectorAll(".layout-btn");

        function applyLayout(layout) {

            const items = document.querySelectorAll(".buku-item");

            items.forEach(item => {

                item.classList.remove("col-12", "col-6");

                if (layout === "list") {
                    item.classList.add("col-12");
                }

                if (layout === "grid2") {
                    item.classList.add("col-6");
                }

            });

        }

        function setActiveButton(layout) {

            buttons.forEach(btn => {

                btn.classList.remove("active");

                if (btn.dataset.layout === layout) {
                    btn.classList.add("active");
                }

            });

        }

        function initLayout() {

            let savedLayout = localStorage.getItem("layoutMode") || "list";

            applyLayout(savedLayout);
            setActiveButton(savedLayout);

            buttons.forEach(btn => {

                btn.onclick = function() {

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

        searchInput.addEventListener("keyup", function() {

            clearTimeout(timeout);

            let query = this.value;

            timeout = setTimeout(() => {

                fetch(`{{ route('siswa.peminjaman') }}?search=${query}`, {
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    })
                    .then(res => res.text())
                    .then(html => {

                        grid.innerHTML = html;

                        initLayout();

                        AOS.refresh();

                    });

            }, 300);

        });

    });
</script>

@endsection