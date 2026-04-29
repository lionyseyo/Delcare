<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('img/logo2.jpg') }}" type="image/x-icon">
  <title>Detail Ulasan</title>
  <link rel="stylesheet" href="{{ asset('css/isi_ulasan.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

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

      <div class="dashboard">
        <h2 class="dashboard-title">Detail Ulasan</h2>


        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> {{ $report->deskripsi_kerusakan }}</h5>
                <p><strong>Nama Pelapor:</strong> {{ $report->nama_lengkap }}</p>
                <p><strong>Tujuan Laporan:</strong> {{ $report->ditujukan_kepada }}</p>
                <p><strong>Ulasan:</strong> {{ $report->reviews->first()->review ?? 'Belum ada ulasan' }}</p>
                <p><strong>Rating:</strong> {{ $report->reviews->first()->rating ?? '-' }}</p>
            </div>
            <!-- Tombol Kembali -->
       <a href="{{ route('lacak_ulasan') }}" class="btn btn-back">Kembali</a>
        </div>
       
      </div>
    </main>
  </div>
</body>
</html>