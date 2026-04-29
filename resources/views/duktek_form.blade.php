<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo2.jpg') }}" type="image/x-icon">
    <title>Daftar Laporan Kerusakan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/duktek_form.css') }}">
</head>

<body>
    <div class="container">
      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="logo">
          <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-image">
        </div>
        <ul class="menu">
          <li class="menu-item">
              <a href="{{ route('dashboard') }}">
                <img src="{{ asset('img/home.png') }}" alt="Dashboard Icon" class="menu-icon">
                Dashboard
              </a>
            </li>
          <li class="menu-item">
              <a href="{{ route('lacak') }}">
                  <img src="{{ asset('img/form.png') }}" alt="Laporan Icon" class="menu-icon">
                  Laporan
              </a>
          </li>
          <li class="menu-item">
              <a href="{{ route('lacak_ulasan') }}">
                <img src="{{ asset('img/review.png') }}" alt="Ulasan Icon" class="menu-icon">
                Ulasan
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('guides.index') }}">
                <img src="{{ asset('img/panduan.png') }}" alt="Panduan Icon" class="menu-icon">
                Panduan
              </a>
            </li>
        </ul>
      </aside>
  
    <!-- Main Content -->
    <main class="main-content">
      <header class="header">
        <div class="user-actions">
          <img src="{{ asset('img/profile.png') }}" alt="User Avatar" class="user-avatar">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Keluar</button>
        </form>
        </div>
      </header>
  
    <div class="container mt-5">
        <h2>Laporan Kerusakan</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @foreach($reports as $report)
            <div class="card mb-3">
                <div class="card-body">
                    <!-- Nama Lengkap -->
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Nama Lengkap</strong></div>
                        <div class="col-md-9">{{ $report->nama_lengkap }}</div>
                    </div>

                    <!-- Nomor Handphone -->
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Nomor Handphone</strong></div>
                        <div class="col-md-9">{{ $report->nomor_handphone }}</div>
                    </div>

                    <!-- Program Studi -->
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Program Studi</strong></div>
                        <div class="col-md-9">{{ $report->program_studi }}</div>
                    </div>

                    <!-- Lokasi Kerusakan -->
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Lokasi Kerusakan</strong></div>
                        <div class="col-md-9">{{ $report->lokasi_kerusakan }}</div>
                    </div>

                    <!-- Deskripsi Kerusakan -->
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Deskripsi Kerusakan</strong></div>
                        <div class="col-md-9">{{ $report->deskripsi_kerusakan }}</div>
                    </div>

                    <!-- Foto Kerusakan -->
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Foto Bukti</strong></div>
                        <div class="col-md-9">
                            @if($report->foto_kerusakan)
                                <img src="{{ asset('uploads/' . $report->foto_kerusakan) }}" alt="Foto Kerusakan" width="200">
                            @else
                                Tidak ada foto
                            @endif
                        </div>
                    </div>

                    <!-- Ditujukan Kepada -->
                    <div class="row mb-3">
                        <div class="col-md-3"><strong>Ditujukan Kepada</strong></div>
                        <div class="col-md-9">{{ $report->ditujukan_kepada }}</div>
                    </div>

                    @if($report->status === 'pending')
                    <!-- Tampilkan tombol Terima dan Tolak -->
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <!-- Tombol Terima -->
                            <form action="{{ route('report.accept', $report->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Terima</button>
                            </form>
                            <!-- Tombol Tolak -->
                            <form action="{{ route('report.reject', $report->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <div class="mb-3">
                                    <label for="rejection_reason" class="form-label">Alasan Penolakan</label>
                                    <input type="text" class="form-control" name="rejection_reason" required>
                                </div>
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </form>
                        </div>
                    </div>
                    @elseif($report->status === 'accepted')
                        <!-- Tombol Selesai -->
                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <form action="{{ route('report.complete', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Selesai</button>
                                </form>
                            </div>
                        </div>
                    @elseif($report->status === 'completed')
                        <div class="alert alert-info">
                            Laporan ini telah <strong>diselesaikan</strong>.
                        </div>
                    @elseif($report->status === 'rejected')
                        <!-- Laporan ditolak -->
                        <div class="alert alert-danger">
                            Laporan ini telah <strong>ditolak</strong>.
                            <p><strong>Alasan Penolakan:</strong> {{ $report->rejection_reason }}</p>
                        </div>
                    @endif
<!-- Tombol Kembali -->
<a href="{{ route('lacak_ulasan') }}" class="btn btn-back">Kembali</a>
                </div>
            </div>
        @endforeach
    </div>   
</div>
    <script src="{{ asset('js/duktek_form.js') }}"></script>
</body>
</html>