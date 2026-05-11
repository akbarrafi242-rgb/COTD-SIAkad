<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAkad: Sistem Informasi Akademik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

<div x-data="{
    openCreate: false,
    openEdit: false,
    student: {
        id: '',
        name: '',
        email: '',
        prodi: '',
        angkatan: '',
        jenis_kelamin: '',
        status_lulus: false
    }
}">

    <div class="max-w-6xl mx-auto py-10 px-6">

        {{-- ===== HEADER ===== --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">SIAkad</h1>
                <p class="text-gray-500 mt-1">Sistem Informasi Akademik</p>
            </div>
            <button
                @click="openCreate = true"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold transition">
                + Add Student
            </button>
        </div>

        {{-- ===== FLASH MESSAGE ===== --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- ===== CHART GRID ===== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

            {{-- Chart 1: Per Prodi --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-blue-600 text-white px-5 py-3 font-semibold text-sm">
                    Mahasiswa per Prodi
                </div>
                <div class="p-4">
                    <canvas id="chartProdi" height="200"></canvas>
                </div>
            </div>

            {{-- Chart 2: Per Angkatan --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-green-600 text-white px-5 py-3 font-semibold text-sm">
                    Mahasiswa per Angkatan
                </div>
                <div class="p-4">
                    <canvas id="chartAngkatan" height="200"></canvas>
                </div>
            </div>

            {{-- Chart 3: Lulus per Angkatan --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-yellow-500 text-white px-5 py-3 font-semibold text-sm">
                    Mahasiswa Lulus per Angkatan
                </div>
                <div class="p-4">
                    <canvas id="chartLulus" height="200"></canvas>
                </div>
            </div>

            {{-- Chart 4: Per Jenis Kelamin --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-red-500 text-white px-5 py-3 font-semibold text-sm">
                    Mahasiswa per Jenis Kelamin
                </div>
                <div class="p-4">
                    <canvas id="chartJenisKelamin" height="200"></canvas>
                </div>
            </div>

        </div>

        {{-- ===== TABEL MAHASISWA ===== --}}
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">

            {{-- Table Header --}}
            <div class="grid grid-cols-3 bg-gray-50 border-b px-6 py-4 font-semibold text-gray-600 text-sm uppercase tracking-wide">
                <div>Name</div>
                <div>Email</div>
                <div class="text-center">Action</div>
            </div>

            {{-- Rows --}}
            @forelse($students as $student)
                <div class="grid grid-cols-3 items-center px-6 py-4 border-b hover:bg-gray-50 transition">

                    <div class="font-medium text-gray-800">{{ $student->name }}</div>

                    <div class="text-gray-500 text-sm">{{ $student->email }}</div>

                    <div class="flex justify-center gap-3">

                        {{-- Ubah Data --}}
                        <button
                            @click="
                                openEdit = true;
                                student.id            = '{{ $student->id }}';
                                student.name          = '{{ addslashes($student->name) }}';
                                student.email         = '{{ $student->email }}';
                                student.prodi         = '{{ $student->prodi }}';
                                student.angkatan      = '{{ $student->angkatan }}';
                                student.jenis_kelamin = '{{ $student->jenis_kelamin }}';
                                student.status_lulus  = {{ $student->status_lulus ? 'true' : 'false' }};"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                            Ubah Data
                        </button>

                        {{-- Delete --}}
                        <form
                            action="{{ route('student.destroy', $student->id) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus mahasiswa {{ addslashes($student->name) }}?')">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                Delete
                            </button>
                        </form>

                    </div>
                </div>
            @empty
                <div class="px-6 py-10 text-center text-gray-400 text-sm">
                    Belum ada data mahasiswa.
                </div>
            @endforelse

        </div>

        {{-- Modal Form --}}
        @include('student.form')

    </div>
</div>

{{-- ===== CHART JS ===== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const prodiLabels    = @json($mahasiswaPerProdi->pluck('prodi'));
    const prodiData      = @json($mahasiswaPerProdi->pluck('total'));
    const angkatanLabels = @json($mahasiswaPerAngkatan->pluck('angkatan'));
    const angkatanData   = @json($mahasiswaPerAngkatan->pluck('total'));
    const lulusLabels    = @json($lulusPerAngkatan->pluck('angkatan'));
    const lulusData      = @json($lulusPerAngkatan->pluck('total'));
    const genderLabels   = @json($perJenisKelamin->pluck('jenis_kelamin'))
        .map(g => g === 'L' ? 'Laki-laki' : 'Perempuan');
    const genderData     = @json($perJenisKelamin->pluck('total'));

    new Chart(document.getElementById('chartProdi'), {
        type: 'bar',
        data: {
            labels: prodiLabels,
            datasets: [{
                label: 'Jumlah',
                data: prodiData,
                backgroundColor: ['#4e73df','#1cc88a','#36b9cc','#f6c23e','#e74a3b'],
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    new Chart(document.getElementById('chartAngkatan'), {
        type: 'line',
        data: {
            labels: angkatanLabels,
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: angkatanData,
                borderColor: '#1cc88a',
                backgroundColor: 'rgba(28,200,138,0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 5,
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    new Chart(document.getElementById('chartLulus'), {
        type: 'bar',
        data: {
            labels: lulusLabels,
            datasets: [{
                label: 'Lulus',
                data: lulusData,
                backgroundColor: '#f6c23e',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    new Chart(document.getElementById('chartJenisKelamin'), {
        type: 'doughnut',
        data: {
            labels: genderLabels,
            datasets: [{
                data: genderData,
                backgroundColor: ['#4e73df','#e74a3b'],
                borderWidth: 2,
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });
</script>

</body>
</html>