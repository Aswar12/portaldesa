@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Dashboard Statistik Penduduk</h1>

    <div class="mb-5">
        <h3>Jumlah Penduduk berdasarkan Agama dan Jenis Kelamin</h3>
        <canvas id="chartAgamaJenisKelamin"></canvas>
    </div>

    <div class="mb-5">
        <h3>Jumlah Penduduk berdasarkan Usia dan Jenis Kelamin (Horizontal Bar Chart)</h3>
        <canvas id="chartUsiaJenisKelamin"></canvas>
    </div>

    <div class="mb-5">
        <h3>Jumlah Penduduk berdasarkan Pekerjaan dan Jenis Kelamin (Grouped Bar Chart)</h3>
        <canvas id="chartPekerjaanJenisKelamin"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataAgamaJenisKelamin = @json($dataAgamaJenisKelamin);
    const dataUsiaJenisKelamin = @json($dataUsiaJenisKelamin);
    const dataPekerjaanJenisKelamin = @json($dataPekerjaanJenisKelamin);

    // Colors for gender
    const colors = {
        'Laki-laki': 'rgba(54, 162, 235, 0.7)',
        'Perempuan': 'rgba(255, 99, 132, 0.7)',
        'Unknown': 'rgba(201, 203, 207, 0.7)'
    };

    // Chart for Agama and Jenis Kelamin - Grouped Bar Chart
    const ctxAgamaJenisKelamin = document.getElementById('chartAgamaJenisKelamin').getContext('2d');
    const chartAgamaJenisKelamin = new Chart(ctxAgamaJenisKelamin, {
        type: 'bar',
        data: {
            labels: dataAgamaJenisKelamin.labels,
            datasets: dataAgamaJenisKelamin.datasets.map(ds => ({
                label: ds.label,
                data: ds.data,
                backgroundColor: colors[ds.label] || colors['Unknown']
            }))
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Penduduk berdasarkan Agama dan Jenis Kelamin' }
            },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Jumlah' } },
                x: { title: { display: true, text: 'Agama' } }
            }
        }
    });

    // Chart for Usia and Jenis Kelamin - Horizontal Bar Chart
    const ctxUsiaJenisKelamin = document.getElementById('chartUsiaJenisKelamin').getContext('2d');

    const usiaLabels = dataUsiaJenisKelamin.labels;

    const datasetsUsia = dataUsiaJenisKelamin.datasets.map(ds => ({
        label: ds.label,
        data: ds.data.map(val => Math.round(val)),
        backgroundColor: colors[ds.label] || colors['Unknown']
    }));

    const chartUsiaJenisKelamin = new Chart(ctxUsiaJenisKelamin, {
        type: 'bar',
        data: {
            labels: usiaLabels,
            datasets: datasetsUsia
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Jumlah Penduduk berdasarkan Usia dan Jenis Kelamin' }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: { display: true, text: 'Jumlah' }
                },
                y: {
                    title: { display: true, text: 'Kelompok Usia' }
                }
            }
        }
    });

    // Chart for Pekerjaan and Jenis Kelamin - Grouped Bar Chart
    const ctxPekerjaanJenisKelamin = document.getElementById('chartPekerjaanJenisKelamin').getContext('2d');

    const pekerjaanLabels = dataPekerjaanJenisKelamin.labels;

    const datasetsPekerjaan = dataPekerjaanJenisKelamin.datasets.map(ds => ({
        label: ds.label,
        data: ds.data.map(val => Math.round(val)),
        backgroundColor: colors[ds.label] || colors['Unknown']
    }));

    const chartPekerjaanJenisKelamin = new Chart(ctxPekerjaanJenisKelamin, {
        type: 'bar',
        data: {
            labels: pekerjaanLabels,
            datasets: datasetsPekerjaan
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Penduduk berdasarkan Pekerjaan dan Jenis Kelamin' }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Jumlah' }
                },
                x: {
                    title: { display: true, text: 'Jenis Pekerjaan' }
                }
            }
        }
    });
</script>
@endsection
