@extends('rt.dashboardRt')

@section('content')
<div class="container mx-auto p-4 mb-6 pt-20">
    <h1 class="text-2xl font-bold mb-2">Profil RT</h1>
    <p class="text-gray-600 text-lg mb-6">Halaman ini menampilkan data profil RT dan memungkinkan Anda untuk memperbarui informasi serta mengunggah tanda tangan digital.
        <br>Anda <strong class="text-red-500">wajib</strong> mengunggah scan tanda tangan digital jika belum melakukannya agar proses administrasi dapat berjalan lancar.
    </p>

    <div class="md:flex md:space-x-6 space-y-6 md:space-y-0 items-stretch">
        <!-- Card Profil -->
        <div class="bg-white shadow-lg rounded-2xl p-6 md:w-1/2 h-full">
            <h1 class="text-2xl font-bold mb-4 text-gray-800">Edit Profile RT</h1>
            @if (session('dataSuccess'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('dataSuccess') }}
                </div>
            @endif

            @if (session('uploadSuccess'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('uploadSuccess') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="md:flex items-center space-y-6 md:space-y-0 md:space-x-10">
                <!-- Foto Profil + Upload -->
                <div class="flex-shrink-0 mx-auto md:mx-0 text-center">
                    <img id="previewImage" src="{{ $rt->profile_rt ? asset('storage/profile_rt/' . $rt->profile_rt) : asset('images/profile.png') }}"
                        alt="Foto Profil"
                        class="w-32 h-32 rounded-full object-cover border-4 border-indigo-500 mx-auto mb-3">

                    <!-- Tombol Edit Profil -->
                    <button type="button"
                            id="editButton"
                            class="mt-2 px-4 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
                        Edit Profil
                    </button>

                    <!-- Input file disembunyikan -->
                    <input type="file" id="imageInput" name="profile_rt" accept="image/*" class="hidden">

                    <!-- Form simpan profil -->
                    <form action="{{ route('uploadProfileRt') }}" method="POST" enctype="multipart/form-data" class="mt-4 hidden" id="uploadForm">
                        @csrf
                        <div class="flex justify-center space-x-4">
                            <button type="button" id="cancelButton"
                                    class="px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                Batal
                            </button>
                            <button type="submit"
                                    class="px-4 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Informasi RT -->
                <div class="flex-1">
                    <div class="flex flex-col items-center">
                        <!-- Kontainer data -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full max-w-4xl">
                            <!-- Kolom kiri: span 2 kolom -->
                            <div class="sm:col-span-2 space-y-4">
                                <!-- Nama Lengkap -->
                                <div>
                                    <h2 class="text-sm text-gray-500">Nama Lengkap</h2>
                                    <p class="text-lg font-semibold text-gray-800">{{ $rt->nama_lengkap_rt }}</p>
                                </div>

                                <!-- No HP -->
                                <div>
                                    <h2 class="text-sm text-gray-500">No. HP</h2>
                                    <p class="text-lg font-semibold text-gray-800">{{ $rt->no_hp_rt }}</p>
                                </div>

                                <!-- Email -->
                                <div class="overflow-hidden">
                                    <h2 class="text-sm text-gray-500">Email</h2>
                                    <p class="text-100 font-semibold text-gray-800 " title="{{ $rt->email_rt }}">
                                        {{ $rt->email_rt }}
                                    </p>
                                </div>
                            </div>

                            <!-- Kolom kanan: Nomor RT -->
                            <div class="space-y-4">
                                <div>
                                    <h2 class="text-sm text-gray-500">Nomor RT</h2>
                                    <p class="text-lg font-semibold text-gray-800">RT {{ $rt->no_rt }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Edit Profil (tengah) -->
                        <div class="mt-6">
                            <button onclick="openModal()"
                                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                                Edit Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Upload TTD -->
        <div class="bg-white shadow-lg rounded-2xl p-6 md:w-1/2 h-full">
            <h1 class="text-2xl font-bold mb-4 text-center text-gray-800">Upload Scan Tanda Tangan</h1>
            <p class="text-lg text-gray-700">
                Harap unggah scan tanda tangan digital dengan ketentuan berikut:
                <ul class="list-disc list-inside mt-2">
                    <li>Latar belakang (background) gambar sebaiknya berwarna putih atau terang agar proses transparansi berjalan optimal.</li>
                    <li>Kejernihan tanda tangan harus jelas dan tidak blur agar hasil digitalisasi tampak rapi.</li>
                    <li>Format gambar yang diterima adalah JPG, JPEG, atau PNG dengan ukuran maksimal sesuai batas server.</li>
                    <li>Pastikan tanda tangan tidak terpotong dan memenuhi area gambar agar hasil transparan sempurna.</li>
                    <li>Gambar akan diproses untuk menghilangkan latar belakang putih menjadi transparan agar bisa digunakan di dokumen digital.</li>
                </ul>
            </p>


            @if (session('ttdSuccess'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('ttdSuccess') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Jika tanda tangan belum ada -->
            @if (empty($rt->ttd_digital) && empty($rt->ttd_digital_bersih))
                <form action="{{ route('scanTtdRtUpload') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div>
                        <label for="scan_ttd" class="block text-sm font-semibold text-gray-800 mb-1">Pilih Gambar Scan Tanda Tangan</label>
                        <input type="file" name="ttd_digital" accept="image/*" required
                            class="block w-full text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded-lg cursor-pointer p-2">
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all">
                            Upload
                        </button>
                    </div>
                </form>
            @else
            <!-- Jika tanda tangan sudah ada, tampilkan gambar dan tombol Edit -->
            <div class="mt-4">
                <table class="min-w-full table-auto border border-gray-300 border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border border-gray-300">Tanda Tangan Scan</th>
                            <th class="px-4 py-2 border border-gray-300">Tanda Tangan Bersih</th>
                            <th class="px-4 py-2 border border-gray-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 border border-gray-300 text-center">
                                <img src="{{ Storage::url($rt->ttd_digital) }}"
                                    alt="Tanda Tangan Scan"
                                    class="w-20 h-20 object-cover mx-auto cursor-pointer transition-transform duration-200 hover:scale-105"
                                    onclick="showImageModal('{{ Storage::url($rt->ttd_digital) }}')">
                            </td>
                            <td class="px-4 py-2 border border-gray-300 text-center">
                                <img src="{{ Storage::url($rt->ttd_digital_bersih) }}"
                                    alt="Tanda Tangan Bersih"
                                    class="w-20 h-20 object-cover mx-auto cursor-pointer transition-transform duration-200 hover:scale-105"
                                    onclick="showImageModal('{{ Storage::url($rt->ttd_digital_bersih) }}')">
                            </td>
                            <td class="px-4 py-2 border border-gray-300 text-center">
                                <button type="button" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600" onclick="openModalTtd()">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden h-full w-full overflow-hidden">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative box-border">
            <!-- Tombol Close -->
            <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>

            <h2 class="text-xl font-bold mb-4">Edit Data</h2>

            <form action="{{ route('updateDataRt') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- No HP -->
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium">Nomer WhatsApp</label>
                    <div class="flex">
                        <!-- Prefix "62" tidak bisa diedit -->
                        <span class="inline-flex items-center px-3 rounded-l border border-r-0 border-gray-300 bg-gray-100 text-gray-600 select-none">62</span>
                        <!-- Input nomor hp tanpa "62" -->
                        <input
                            type="text"
                            name="no_hp_rt"
                            id="no_hp_rt"
                            class="flex-1 border border-gray-300 rounded-r px-3 py-2"
                            placeholder="Masukkan nomor setelah 62"
                            required
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            maxlength="11"
                            value="{{ Str::startsWith($rt->no_hp_rt, '62') ? substr($rt->no_hp_rt, 2) : $rt->no_hp_rt }}"
                        >
                    </div>
                    <small class="text-gray-500">Nomor harus diawali dengan 62 (otomatis), hanya masukkan nomor setelah kode negara.</small>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-600 mb-1" for="email_rt">Email</label>
                    <input type="email" name="email_rt" id="email_rt"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-indigo-500"
                        value="{{ $rt->email_rt }}">
                </div>

                <!-- Submit -->
                <div class="text-center mt-6">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal tampilan gambar -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
        <span class="absolute top-4 right-6 text-white text-3xl cursor-pointer" onclick="closeImageModal()">&times;</span>
        <img id="modalImage" src="" alt="Preview" class="max-w-sm max-h-50 border-4 border-white rounded-lg shadow-lg">
    </div>

    <!-- Modal untuk Upload Tanda Tangan -->
    <div id="editTtdModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <!-- Tombol Close Modal -->
            <button onclick="closeModalTtd()" class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>

            <h2 class="text-xl font-bold mb-4">Edit Tanda Tangan</h2>

            <form action="{{ route('scanTtdRtUpload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Pilih Gambar Tanda Tangan -->
                <div class="mb-4">
                    <label for="scan_ttd" class="block text-sm font-medium text-gray-700 mb-1">Pilih Gambar Scan Tanda Tangan</label>
                    <input type="file" name="ttd_digital" accept="image/*" required
                        class="block w-full text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded-lg cursor-pointer p-2">
                </div>

                <div class="text-center mt-6">
                    <button type="submit" class="bg-indigo-600 text-white py-2 px-6 rounded-lg hover:bg-indigo-700">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const editBtn = document.getElementById('editButton');
    const imageInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');
    const uploadForm = document.getElementById('uploadForm');
    const cancelBtn = document.getElementById('cancelButton');

    // Saat tombol "Edit Profil" diklik, buka input file
    editBtn.addEventListener('click', function () {
        imageInput.click();
    });

    // Saat file dipilih
    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            // Tampilkan preview gambar
            previewImage.src = URL.createObjectURL(file);

            // Sembunyikan tombol edit, tampilkan form
            editBtn.classList.add('hidden');
            uploadForm.classList.remove('hidden');

            // Tambahkan input file ke form (agar bisa dikirim)
            if (uploadForm.querySelector('input[type="file"]')) {
                uploadForm.removeChild(uploadForm.querySelector('input[type="file"]'));
            }
            const newInput = document.createElement('input');
            newInput.type = 'file';
            newInput.name = 'profile_rt';
            newInput.files = event.target.files;
            newInput.classList.add('hidden');
            uploadForm.appendChild(newInput);
        }
    });

    // Saat klik batal
    cancelBtn.addEventListener('click', function () {
        // Reset preview gambar
        previewImage.src = "{{ $rt->profile_rt ? asset('storage/profile_rt/' . $rt->profile_rt) : asset('images/profile.png') }}";

        // Reset input file
        imageInput.value = '';

        // Tampilkan kembali tombol edit, sembunyikan form
        editBtn.classList.remove('hidden');
        uploadForm.classList.add('hidden');
    });

    function openModal() {
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openModalTtd() {
        document.getElementById('editTtdModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModalTtd() {
        document.getElementById('editTtdModal').classList.add('hidden');
    }

    function showImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>
@endsection
