<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo2.jpg') }}" type="image/x-icon">
    <title>Edit Panduan</title>
    <link rel="stylesheet" href="{{ asset('css/guide/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <aside class="sidebar">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Delcare Logo" style="height: 50px;"> <!-- Ganti dengan path logo Anda -->
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

    <div class="form-container">
        <form action="{{ route('guides.update', $guide->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1 class="form-title">Edit Panduan</h1>
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $guide->title }}" required>
            </div>

            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                @if ($guide->thumbnail)
                    <img src="{{ asset('storage/' . $guide->thumbnail) }}" alt="Thumbnail" class="img-thumbnail mt-2" width="100">
                @endif
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" required>{{ $guide->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="content">Konten</label>
                <textarea name="content" id="content" class="form-control" required>{{ $guide->content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui Panduan</button>
            </form>
        </div>
    </main>
</body>
</html>