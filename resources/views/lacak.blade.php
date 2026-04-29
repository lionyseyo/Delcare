<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('img/logo2.jpg') }}" type="image/x-icon">
  <title>Lacak Status</title>
  <link rel="stylesheet" href="css/lacak.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">
        <img src="img/logo.png" alt="Logo" class="logo-image">
      </div>
      <ul class="menu">
        <li class="menu-item">
            <a href="{{ route('dashboard') }}">
              <img src="img/home.png" alt="Dashboard Icon" class="menu-icon">
              Dashboard
            </a>
          </li>
        <li class="menu-item">
            <a href="{{ route('lacak') }}">
                <img src="img/form.png" alt="Laporan Icon" class="menu-icon">
                Laporan
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('lacak_ulasan') }}">
              <img src="img/review.png" alt="Ulasan Icon" class="menu-icon">
              Ulasan
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('guides.index') }}">
              <img src="img/panduan.png" alt="Panduan Icon" class="menu-icon">
              Panduan
            </a>
          </li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <header class="header">
        <div class="user-actions">
          <img src="img/profile.png" alt="User Avatar" class="user-avatar">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Keluar</button>
        </form>
        </div>
      </header>

      <div class="dashboard">
        <h2 class="dashboard-title">Lacak Status Laporan</h2>

<div class="container mt-5">
  
  @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered">
    <table class="data-table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Deskripsi Kerusakan</th>
            <th>Lokasi Kerusakan</th>
            <th>Ditujukan Kepada</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
         @foreach($reports as $index => $report)
            <tr>
                <td>{{ $index + 1 }}</td>
              <td>{{ $report->deskripsi_kerusakan }}</td>
              <td>{{ $report->lokasi_kerusakan }}</td>
              <td>{{ $report->ditujukan_kepada }}</td>
              <td>
                <a href="{{ route('duktek_form', ['id' => $report->id]) }}" class="btn-view">Lihat Detail</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      

</body>
</html>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script src="jss/index.js" defer></script>