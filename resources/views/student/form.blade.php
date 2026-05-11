{{-- MODAL TAMBAH --}}
<div x-show="openCreate" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-2xl w-full max-w-lg">

        <h2 class="text-2xl font-bold mb-4">Tambah Data Mahasiswa</h2>

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('student.store') }}" method="POST" class="space-y-4">
            @csrf

            <input type="text" name="name" placeholder="Nama"
                value="{{ old('name') }}"
                class="w-full border p-3 rounded-lg">

            <input type="email" name="email" placeholder="Email"
                value="{{ old('email') }}"
                class="w-full border p-3 rounded-lg">

            <select name="prodi" class="w-full border p-3 rounded-lg">
                <option value="">-- Pilih Prodi --</option>
                <option value="Informatika" {{ old('prodi') == 'Informatika' ? 'selected' : '' }}>Informatika</option>
                <option value="Sistem Informasi" {{ old('prodi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                <option value="Sains Data" {{ old('prodi') == 'Sains Data' ? 'selected' : '' }}>Sains Data</option>
                <option value="Bisnis Digital" {{ old('prodi') == 'Bisnis Digital' ? 'selected' : '' }}>Bisnis Digital</option>
            </select>

            <select name="angkatan" class="w-full border p-3 rounded-lg">
                <option value="">-- Pilih Angkatan --</option>
                @for($y = date('Y'); $y >= 2018; $y--)
                    <option value="{{ $y }}" {{ old('angkatan') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>

            <select name="jenis_kelamin" class="w-full border p-3 rounded-lg">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="status_lulus" value="1">
                <span class="text-sm text-gray-700">Sudah Lulus</span>
            </label>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" @click="openCreate = false"
                    class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div x-show="openEdit" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-2xl w-full max-w-lg">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Ubah Data Mahasiswa</h2>
            <button @click="openEdit = false" class="text-2xl text-gray-500">&times;</button>
        </div>

        <form :action="'/student/' + student.id" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <input type="text" name="name" x-model="student.name"
                placeholder="Nama" class="w-full border p-3 rounded-lg">

            <input type="email" name="email" x-model="student.email"
                placeholder="Email" class="w-full border p-3 rounded-lg">

            <select name="prodi" x-model="student.prodi" class="w-full border p-3 rounded-lg">
                <option value="">-- Pilih Prodi --</option>
                <option value="Informatika">Informatika</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
                <option value="Sains Data">Sains Data</option>
                <option value="Bisnis Digital">Bisnis Digital</option>
            </select>

            <select name="angkatan" x-model="student.angkatan" class="w-full border p-3 rounded-lg">
                <option value="">-- Pilih Angkatan --</option>
                @for($y = date('Y'); $y >= 2018; $y--)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>

            <select name="jenis_kelamin" x-model="student.jenis_kelamin" class="w-full border p-3 rounded-lg">
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="status_lulus" value="1"
                    x-bind:checked="student.status_lulus">
                <span class="text-sm text-gray-700">Sudah Lulus</span>
            </label>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" @click="openEdit = false"
                    class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>