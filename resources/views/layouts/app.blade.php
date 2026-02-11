<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body style="background-color: #F2F7FF;">

<div class="flex min-h-screen">
    
    @include('layouts.sidebar')
    <div class="flex-1 flex flex-col min-w-0">
        @include('layouts.header')
        <main class="flex-1">
            @if(session('success'))
                <div id="alert-success" class="mx-4 lg:mx-6 mt-4 mb-4 flex items-center gap-3 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <svg class="w-5 h-5 text-green-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium text-green-800">{{ session('success') }}</span>
                    <button onclick="closeAlert('alert-success')" class="ml-auto text-green-600 hover:text-green-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div id="alert-error" class="mx-4 lg:mx-6 mt-4 mb-4 flex items-center gap-3 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <svg class="w-5 h-5 text-red-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium text-red-800">{{ session('error') }}</span>
                    <button onclick="closeAlert('alert-error')" class="ml-auto text-red-600 hover:text-red-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            @endif

            <div class="p-4 lg:p-6">
                @yield('content')
            </div>
        </main>
    </div>

</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('sidebar-backdrop');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const closeSidebarButton = document.getElementById('close-sidebar');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        backdrop.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
        document.body.style.overflow = '';
    }

    mobileMenuButton?.addEventListener('click', openSidebar);
    closeSidebarButton?.addEventListener('click', closeSidebar);
    backdrop?.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
            closeSidebar();
        }
    });

    const sidebarLinks = sidebar?.querySelectorAll('a');
    sidebarLinks?.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                closeSidebar();
            }
        });
    });

    function closeAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }
    }

    setTimeout(() => {
        const alerts = document.querySelectorAll('[id^="alert-"]');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 300ms';
            closeAlert(alert.id);
        });
    }, 5000);
</script>

</body>
</html>