<aside class="fixed left-0 top-16 h-screen w-64 bg-slate-900 text-white transform -translate-x-full transition-transform duration-300 lg:translate-x-0 lg:relative lg:static lg:h-auto lg:w-64 lg:transform-none z-50" id="adminSidebar">
    <!-- Mobile close button -->
    <div class="lg:hidden p-4 border-b border-slate-800 flex justify-between items-center">
        <h3 class="font-semibold text-lg">Admin Menu</h3>
        <button onclick="closeSidebar()" class="text-slate-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <div class="p-4 space-y-2">
        <!-- Brand -->
        <div class="mb-8 flex items-center gap-2">
            <img src="{{ asset('images/logo.jpg') }}" alt="Kelas Online Logo" class="w-8 h-8 rounded-lg object-cover">
            <span class="font-bold text-xl tracking-tight">Kelas<span class="text-indigo-400">Online</span></span>
        </div>

        <!-- Navigation -->
        <nav class="space-y-1">
            @php
                $request = request();
                $routeName = $request->route()->getName() ?? '';
            @endphp

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-3 rounded-xl {{ $routeName == 'admin.dashboard' ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/50' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 transition' }} flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span>Dashboard</span>
            </a>

            <!-- Kategori -->
            <a href="{{ route('admin.categories.index') }}"
               class="block px-4 py-3 rounded-xl {{ str_starts_with($routeName, 'admin.categories') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/50' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 transition' }} flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <span>Kategori</span>
            </a>

            <!-- Kelas -->
            <a href="{{ route('admin.courses.index') }}"
               class="block px-4 py-3 rounded-xl {{ str_starts_with($routeName, 'admin.courses') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/50' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 transition' }} flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                <span>Kelas</span>
            </a>

            <!-- Pendaftar -->
            <a href="{{ route('admin.enrollments.index') }}"
               class="block px-4 py-3 rounded-xl {{ str_starts_with($routeName, 'admin.enrollments') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/50' : 'text-slate-400 hover:text-white hover:bg-slate-800/50 transition' }} flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span>Pendaftar</span>
            </a>
        </nav>

        <!-- Divider -->
        <div class="my-6 border-t border-slate-800"></div>

        <!-- User info -->
        <div class="px-4 py-3 bg-slate-800/50 rounded-xl border border-slate-700/50">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-xs font-medium">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-400">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-auto p-4 border-t border-slate-800">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="block px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/50 transition flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</aside>

<!-- Mobile overlay -->
<div class="lg:hidden fixed inset-0 bg-black/50 z-40 hidden" id="sidebarOverlay" onclick="closeSidebar()"></div>

<script>
    function closeSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (sidebar) sidebar.classList.add('-translate-x-full');
        if (overlay) overlay.classList.add('hidden');
    }

    function openSidebar() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (sidebar) sidebar.classList.remove('-translate-x-full');
        if (overlay) overlay.classList.remove('hidden');
    }
</script>
