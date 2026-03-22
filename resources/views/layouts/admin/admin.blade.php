<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Admin Perpustakaan</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { background: #f5f7fb; font-family: 'Segoe UI', sans-serif; overflow-x: hidden; }
        
        /* Sidebar Desktop */
        .sidebar {
            width: 260px;
            background: #111827;
            min-height: 100vh;
            position: fixed;
            transition: all 0.3s;
            z-index: 1045;
        }

        /* Content Area */
        .content {
            margin-left: 260px;
            padding: 20px;
            transition: all 0.3s;
        }

        /* Penyesuaian Layar Kecil (HP) */
        @media (max-width: 768px) {
            .sidebar { margin-left: -260px; }
            .sidebar.show { margin-left: 0; }
            .content { margin-left: 0; }
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 10px;
            transition: 0.2s;
        }

        .sidebar a:hover, .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .card { border: none; border-radius: 14px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
        .stat-card { padding: 25px; }
    </style>
</head>
<body>

    @include('layouts.admin.sidebar')

    <div class="content">
        @include('layouts.admin.navbar')
        
        <main class="container-fluid">
            @yield('content')
        </main>
        @include('layouts.admin.footer')
    </div>

    <!-- Script Toggle Sidebar untuk Mobile -->
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
</body>
</html>
