<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard SIAkad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4">📊 Dashboard SIAkad</h2>
    <a href="/student" class="btn btn-primary mb-4">Daftar Mahasiswa</a>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Mahasiswa per Prodi</div>
                <div class="card-body"><canvas id="chartProdi"></canvas></div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">Mahasiswa per Angkatan</div>
                <div class="card-body"><canvas id="chartAngkatan"></canvas></div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">Mahasiswa Lulus per Angkatan</div>
                <div class="card-body"><canvas id="chartLulus"></canvas></div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">Mahasiswa per Jenis Kelamin</div>
                <div class="card-body"><canvas id="chartJenisKelamin"></canvas></div>
            </div>
        </div>
    </div>
</div>

<script>
    const prodiLabels    = @json($mahasiswaPerProdi->pluck('prodi'));
    const prodiData      = @json($mahasiswaPerProdi->pluck('total'));
    const angkatanLabels = @json($mahasiswaPerAngkatan->pluck('angkatan'));
    const angkatanData   = @json($mahasiswaPerAngkatan->pluck('total'));
    const lulusLabels    = @json($lulusPerAngkatan->pluck('angkatan'));
    const lulusData      = @json($lulusPerAngkatan->pluck('total'));
    const genderLabels   = @json($perJenisKelamin->pluck('jenis_kelamin'));
    const genderData     = @json($perJenisKelamin->pluck('total'));

    new Chart(document.getElementById('chartProdi'), {
        type: 'bar',
        data: { labels: prodiLabels, datasets: [{ label: 'Jumlah', data: prodiData,
            backgroundColor: ['#4e73df','#1cc88a','#36b9cc','#f6c23e'] }] },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    new Chart(document.getElementById('chartAngkatan'), {
        type: 'line',
        data: { labels: angkatanLabels, datasets: [{ label: 'Jumlah Mahasiswa', data: angkatanData,
            borderColor: '#1cc88a', backgroundColor: 'rgba(28,200,138,0.1)', fill: true, tension: 0.4 }] },
        options: { responsive: true }
    });

    new Chart(document.getElementById('chartLulus'), {
        type: 'bar',
        data: { labels: lulusLabels, datasets: [{ label: 'Lulus', data: lulusData,
            backgroundColor: '#f6c23e' }] },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    new Chart(document.getElementById('chartJenisKelamin'), {
        type: 'doughnut',
        data: { labels: genderLabels.map(g => g === 'L' ? 'Laki-laki' : 'Perempuan'),
            datasets: [{ data: genderData, backgroundColor: ['#4e73df','#e74a3b'] }] },
        options: { responsive: true }
    });
</script>

</body>
</html>