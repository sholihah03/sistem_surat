<aside id="sidebar" class="w-64 bg-white bg-opacity-90 shadow-md flex-col fixed inset-y-0 left-0 top-0 transform -translate-x-full transition-transform duration-200 ease-in-out md:relative md:translate-x-0 md:flex z-40">
    <nav class="flex flex-col gap-4 text-gray-700 pt-20 p-6">

        {{-- Dashboard --}}
        <a href="{{ route('dashboardRt') }}"
           class="px-4 py-2 rounded-lg font-medium transition-all duration-200
                  hover:bg-blue-100 hover:text-blue-700 hover:shadow-md
                  {{ request()->routeIs('dashboardRt') ? 'bg-blue-200 text-blue-700' : 'text-gray-700' }}">
            🏠 Dashboard
        </a>

        {{-- Verifikasi Akun (dengan anak submenu) --}}
        <div>
            <button
                class="w-full text-left px-4 py-2 rounded-lg font-medium transition-all duration-200
                       hover:bg-blue-100 hover:text-blue-700 hover:shadow-md text-gray-700"
                onclick="document.getElementById('submenu-verifikasi').classList.toggle('hidden')">
                👤 Verifikasi Akun
            </button>
            <div id="submenu-verifikasi" class="mt-1 space-y-1 {{ request()->routeIs('verifikasiAkunWarga') || request()->routeIs('historiVerifikasiAkunWarga') || request()->routeIs('historiAkunKadaluwarsa') ? '' : 'hidden' }}">
                <a href="{{ route('verifikasiAkunWarga') }}"
                   class="block pl-8 py-1.5 rounded-lg font-medium text-sm transition-all duration-200
                          hover:bg-green-100 hover:text-green-700
                          {{ request()->routeIs('verifikasiAkunWarga') ? 'bg-green-100 text-green-700' : 'text-gray-700' }}">
                    Verifikasi Akun Warga
                </a>
                <a href="{{ route('historiVerifikasiAkunWarga') }}"
                   class="block pl-8 py-1.5 rounded-lg font-medium text-sm transition-all duration-200
                          hover:bg-green-100 hover:text-green-700
                          {{ request()->routeIs('historiVerifikasiAkunWarga') ? 'bg-green-100 text-green-700' : 'text-gray-700' }}">
                    Histori Verifikasi
                </a>
                <a href="{{ route('historiAkunKadaluwarsa') }}"
                   class="block pl-8 py-1.5 rounded-lg font-medium text-sm transition-all duration-200
                          hover:bg-green-100 hover:text-green-700
                          {{ request()->routeIs('historiAkunKadaluwarsa') ? 'bg-green-100 text-green-700' : 'text-gray-700' }}">
                    Histori Akun Kadaluwarsa
                </a>
            </div>
        </div>

        {{-- Verifikasi Surat --}}
        <a href="{{ route('verifikasiSurat') }}"
            class="px-4 py-2 rounded-lg font-medium transition-all duration-200
                    hover:bg-blue-100 hover:text-blue-700 hover:shadow-md
                    {{ request()->routeIs('verifikasiSurat') ? 'bg-blue-200 text-blue-700' : 'text-gray-700' }}">
            📝 Verifikasi Surat
        </a>

        {{-- Riwayat Surat --}}
        <a href="{{ route('riwayatSuratWarga') }}"
            class="px-4 py-2 rounded-lg font-medium transition-all duration-200
                hover:bg-blue-100 hover:text-blue-700 hover:shadow-md
                {{ request()->routeIs('riwayatSuratWarga') ? 'bg-blue-200 text-blue-700' : 'text-gray-700' }}">
            📜 Riwayat Surat
        </a>

        {{-- Bank Data KK --}}
        <a href="{{ route('bankDataKk') }}"
           class="px-4 py-2 rounded-lg font-medium transition-all duration-200
                  hover:bg-blue-100 hover:text-blue-700 hover:shadow-md
                  {{ request()->routeIs('bankDataKk') ? 'bg-blue-200 text-blue-700' : 'text-gray-700' }}">
            📂 Bank Data KK
        </a>

        {{-- Logout --}}
        <a href="{{ route('logout') }}"
           class="mt-8 px-4 py-2 rounded-lg font-medium text-red-600 transition-all duration-200
                  hover:bg-red-100 hover:text-red-700 hover:shadow-md active:bg-red-200">
            🚪 Logout
        </a>

    </nav>
</aside>
