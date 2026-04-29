<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('img/logo2.jpg') }}" type="image/x-icon">
  <title>Daftar Panduan</title>
  <link rel="stylesheet" href="css/guide/index.css">
  <link rel="stylesheet" href="css/dashboard.css">
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
    <h2 class="dashboard-title">Panduan</h2>

    <div class="add-guide">
        <a href="{{ route('guides.create') }}" class="btn btn-primary">Tambah Panduan</a>
    </div>

    <div class="guide-table">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($guides as $index => $guide)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $guide->title }}</td>
                    <td>{{ $guide->description }}</td>
                    <td>
                      <!-- Tombol Edit -->
                      <a href="{{ route('guides.edit', $guide->id) }}" class="btn btn-warning">Edit</a>
                      <!-- Tombol Hapus -->
                        <form action="{{ route('guides.destroy', $guide->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Belum ada panduan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
