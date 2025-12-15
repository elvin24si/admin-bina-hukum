@extends('layouts.admin.app')
@section('title', 'Dashboard')

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Load Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">

            <!-- Gender Chart -->
            <div class="col-xl-4 col-md-6">
                <div class="bg-light rounded p-4 h-100 d-flex flex-column">
                    <h6 class="mb-3 text-center">Warga Berdasarkan Jenis Kelamin</h6>
                    <div class="chart-container flex-grow-1">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Religion Chart -->
            <div class="col-xl-4 col-md-6">
                <div class="bg-light rounded p-4 h-100 d-flex flex-column">
                    <h6 class="mb-3 text-center">Warga Berdasarkan Agama</h6>
                    <div class="chart-container flex-grow-1">
                        <canvas id="religionChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Status Chart -->
            <div class="col-xl-4 col-md-6">
                <div class="bg-light rounded p-4 h-100 d-flex flex-column">
                    <h6 class="mb-3 text-center">Dokumen Hukum Berdasarkan Status</h6>
                    <div class="chart-container flex-grow-1">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- ======================================================== -->
    <!--               DOKUMEN HUKUM TABLE (PAGINATED)            -->
    <!-- ======================================================== -->

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Dokumen Hukum</h6>
            </div>

            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">Nomor</th>
                            <th class="border-0">Judul</th>
                            <th class="border-0">Jenis</th>
                            <th class="border-0">Kategori</th>
                            <th class="border-0">Tanggal</th>
                            <th class="border-0">Status</th>
                            <th class="border-0 rounded-end">Ringkasan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dataDokumenHukum as $item)
                            <tr>
                                <td>{{ $item->nomor }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->jenis?->nama_jenis ?? '-' }}</td>
                                <td>{{ $item->kategori?->nama ?? '-' }}</td>
                                <td>{{ $item->tanggal ? date('d M Y', strtotime($item->tanggal)) : '-' }}</td>

                                <td>
                                    @php
                                        $colors = [
                                            'Aktif' => '#0cb200',
                                            'Tidak Aktif' => '#d40000',
                                            'Draft' => '#5221f3',
                                            'Revisi' => '#d4ca00',
                                        ];
                                    @endphp

                                    <span class="badge rounded-pill px-3 py-2 text-white"
                                        style="background-color: {{ $colors[$item->status] ?? '#777' }};">
                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#ringkasanModal{{ $item->dokumen_id }}">
                                        Lihat
                                    </button>

                                    <div class="modal fade" id="ringkasanModal{{ $item->dokumen_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Ringkasan Dokumen</h5>
                                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    {{ $item->ringkasan ?? 'Tidak ada ringkasan.' }}
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

                <div class="mt-3">
                    {{ $dataDokumenHukum->links('pagination::bootstrap-5') }}
                </div>

            </div>

        </div>
    </div>




    <!-- ============================= -->
    <!--        CHART JAVASCRIPT      -->
    <!-- ============================= -->

    <script>
        /* -------- WARGA: GENDER -------- */
        new Chart(document.getElementById("genderChart"), {
            type: "pie",
            data: {
                labels: {!! json_encode($genderCounts->keys()) !!},
                datasets: [{
                    data: {!! json_encode($genderCounts->values()) !!}
                }]
            }
        });

        /* -------- WARGA: RELIGION -------- */
        new Chart(document.getElementById("religionChart"), {
            type: "bar",
            data: {
                labels: {!! json_encode($religionCounts->keys()) !!},
                datasets: [{
                    label: "Jumlah",
                    data: {!! json_encode($religionCounts->values()) !!}
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        /* -------- DOKUMEN HUKUM: STATUS -------- */
        new Chart(document.getElementById("statusChart"), {
            type: "doughnut",
            data: {
                labels: {!! json_encode($statusCounts->keys()) !!},
                datasets: [{
                    data: {!! json_encode($statusCounts->values()) !!}
                }]
            }
        });
    </script>

@endsection
