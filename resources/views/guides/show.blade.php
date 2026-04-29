<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $guide->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/guide/show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
    <div class="header-content">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Delcare Logo" style="height: 50px;"> <!-- Ganti dengan path logo Anda -->
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
            @if(Auth::check())
                <span class="user-name">{{ Auth::user()->name }}</span>
            @endif
        </div>
    </div>
    <div class="title-section">
        <h1>Panduan</h1>
    </div>
</header>

<main>
    <section class="content-section">
        <div class="container">
            <h1>{{ $guide->title }}</h1>
            <img src="{{ asset('storage/' . $guide->thumbnail) }}" class="img-fluid mb-4" alt="{{ $guide->title }}">
            <p>{{ $guide->content }}</p>
            <a href="{{ route('panduan') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </section>
</main>
    @include('footer')
    </body>
    </html>