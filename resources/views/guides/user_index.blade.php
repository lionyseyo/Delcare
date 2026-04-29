<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo2.jpg') }}" type="image/x-icon">
    <title>Panduan Pengguna</title>
    <link rel="stylesheet" href="{{ asset('css/guide/user_index.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<!-- Header Section -->
<header class="header">
    <div class="header-content">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Delcare Logo" style="height: 70px;"> <!-- Ganti dengan path logo Anda -->
        </div>
        <nav class="nav">
            <a href="{{ route('beranda') }}" class="{{ request()->is('beranda') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('panduan') }}" class="{{ request()->is('panduan') ? 'active' : '' }}">Panduan</a>
        </nav>
        <div class="auth-buttons">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>
            <i class="fa fa-user profile-icon"></i>
            <!-- Tampilkan nama pengguna yang sedang login -->
            @if(Auth::check())
                <span class="user-name">{{ Auth::user()->name }}</span>
            @endif
        </div>
    </div>
    <!-- Title Section within the Header for a seamless look -->
    <div class="title-section">
        <h1>Panduan</h1>
    </div>
</header>

<main>
    <section class="guide-list">
        @forelse ($guides as $guide)
        <div class="guide-item">
            <img src="{{ asset('storage/' . $guide->thumbnail) }}" alt="{{ $guide->title }}" class="guide-thumbnail">
            <div class="guide-info">
                <h2>{{ $guide->title }}</h2>
                <p>{{ $guide->description }}</p>
                <a href="{{ route('guides.show', $guide->id) }}" class="btn btn-primary">Baca Selengkapnya</a>
            </div>
        </div>
        @empty
        <p class="no-guides">Tidak ada panduan yang tersedia.</p>
        @endforelse
    </section>
</main>
    @include('footer')
    </body>
    </html>