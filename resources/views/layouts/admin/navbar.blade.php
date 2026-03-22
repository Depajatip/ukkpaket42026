<nav class="navbar bg-white mb-4 p-3 rounded-4 shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center p-0">
        
        <div class="d-flex align-items-center">
            <button class="btn btn-light d-md-none me-3" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="d-none d-sm-block">
                <h5 class="mb-0 fw-bold text-dark">
                    <span id="greetings"></span>, {{ Auth::user()->nama_siswa}}!
                </h5>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <div class="text-end me-3 d-none d-md-block border-end pe-3">
                <small class="text-muted fw-medium d-block" id="realtime-clock" style="font-size: 1rem; letter-spacing: 0.5px;"></small>
            </div>

            <div class="d-flex align-items-center">
                <div class="text-end me-3 d-none d-lg-block">
                    <p class="mb-0 small fw-bold text-dark">{{ Auth::user()->nama_siswa }}</p>
                    <p class="mb-0 text-success small" style="font-size: 0.7rem;">
                        <i class="fas fa-circle fa-xs me-1"></i> Online
                    </p>
                </div>
                <img src="{{ asset('storage/LogoMusabaV9.png') }}"
                     class="rounded-circle border border-2 border-primary" 
                     style="width: 40px; height: 40px; object-fit: cover;">
            </div>
        </div>
    </div>
</nav>

<script>
    (function() {
        function updateClock() {
            const now = new Date();
            const hours = now.getHours();
            let greeting = "";

            // Logika Sapaan
            if (hours >= 5 && hours < 11) greeting = "Selamat Pagi";
            else if (hours >= 11 && hours < 15) greeting = "Selamat Siang";
            else if (hours >= 15 && hours < 18) greeting = "Selamat Sore";
            else greeting = "Selamat Malam";

            const options = { 
                weekday: 'long', 
                day: 'numeric',
                month: 'short',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            
            const clockElement = document.getElementById('realtime-clock');
            const greetElement = document.getElementById('greetings');

            if (greetElement) greetElement.innerText = greeting;
            if (clockElement) {
                // Format: Selasa, 17 Mar 03:00:01
                clockElement.innerText = now.toLocaleDateString('id-ID', options).replace(/\./g, ':');
            }
        }

        setInterval(updateClock, 1000);
        updateClock();
    })();
</script>