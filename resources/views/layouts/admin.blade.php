<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'KelasOnline Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

    <!-- ============ MOBILE TOPBAR ============ -->
    <div class="lg:hidden fixed inset-x-0 top-0 z-50 h-14 border-b border-slate-200 bg-white">
        <div class="flex items-center justify-between h-14 px-4">
            <button onclick="toggleSidebar()" class="text-slate-600 hover:text-indigo-600 mr-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <x-brand-logo size="sm" />
            <div class="text-right hidden sm:block">
                <button onclick="toggleUserMenu()" class="flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-indigo-600 transition">
                    <div class="w-7 h-7 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- ============ DESKTOP TOPBAR ============ -->
    <nav class="fixed inset-x-0 top-0 z-40 hidden h-16 border-b border-slate-200 bg-white lg:flex">
        <div class="flex h-16 w-full items-center px-8">
            <x-brand-logo />

            <div class="ml-10 flex items-center gap-8">
                <a href="{{ route('landing.index') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition">Lihat Website</a>
                <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 transition">Dashboard</a>
            </div>

            <div class="ml-auto flex items-center gap-4">
                <div class="hidden sm:flex flex-col items-end">
                    <p class="text-sm font-medium text-slate-900">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                </div>
                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <button onclick="toggleUserMenu()" class="text-slate-400 hover:text-indigo-600 p-1">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- ============ SIDEBAR ============ -->
    <aside id="adminSidebar" class="fixed inset-y-0 left-0 top-14 z-50 w-64 -translate-x-full bg-slate-900 text-white transition-transform duration-300 lg:top-16 lg:translate-x-0">
        <div class="flex flex-col h-full">
            <!-- Header -->
            <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800 bg-slate-950">
                <x-brand-logo dark size="sm" />
                <button onclick="toggleSidebar()" class="lg:hidden text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                @php
                    $request = request();
                    $routeName = $request->route()->getName() ?? '';
                @endphp

                @foreach ([
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route' => 'admin.categories.index', 'label' => 'Kategori', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
                    ['route' => 'admin.courses.index', 'label' => 'Kelas', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
                    ['route' => 'admin.enrollments.index', 'label' => 'Pendaftar', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ] as $item)
                    @php $isActive = str_starts_with($routeName, $item['route']); @endphp
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl
                               {{ $isActive ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/50 shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 transition-all duration-200' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{$item['icon']}}"></path></svg>
                        <span class="text-sm font-medium">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <!-- Footer -->
            <div class="p-6 border-t border-slate-800 bg-slate-950">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-xs font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <button type="submit" form="logout-form-mobile" class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-medium transition-colors">
                    <span>Logout</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </aside>

    <!-- Mobile Overlay -->
    <div class="lg:hidden fixed inset-0 bg-black/60 z-40 hidden backdrop-blur-sm" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- User Menu Dropdown (Mobile & Desktop) -->
    <div id="userMenu" class="fixed right-6 top-16 z-50 hidden w-56 rounded-xl border border-slate-200 bg-white shadow-lg">
        <div class="px-4 py-2 border-b border-slate-100">
            <p class="text-sm font-medium text-slate-900">{{ auth()->user()->name }}</p>
            <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
        </div>
        <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition">
            Profil
        </a>
        <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" class="block">
            @csrf
            <button onclick="document.getElementById('logout-form-desktop').submit()" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition">
                Logout
            </button>
        </form>
    </div>

    <!-- ============ MAIN CONTENT ============ -->
    <main class="min-h-screen pt-14 lg:ml-64 lg:pt-16">
        <div class="mx-auto max-w-[1440px] px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
            @if (session('success'))
                <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-800 shadow-sm">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-800 shadow-sm">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        function toggleUserMenu() {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('hidden');
        }

        // Close user menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('userMenu');
            const button = event.target.closest('[onclick="toggleUserMenu()"]');
            if (menu && !menu.contains(event.target) && !button) {
                menu.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
