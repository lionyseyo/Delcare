<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo2.jpg') }}" type="image/x-icon">
    <title>Lacak Status Pengguna</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/lacak_dm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <!-- Header Section -->
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Delcare Logo" style="height: 70px;">
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
            <h1>Lacak Status</h1>
        </div>
    </header>

    <style>
        table.table-sm {
            width: 80%;
            margin: 0 auto;
        }

        table.table-sm th, table.table-sm td {
            padding: 8px 12px;
        }
    </style>
</head>

<body>
    <!-- Main content -->
    <div class="status-header-kecil">
        <p>Showing 1-10 of {{ $reports->count() }} items.</p>
    </div>

    <table class="table table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Deskripsi Kerusakan</th>
                <th>Lokasi Kerusakan</th>
                <th>Status</th>
                <th>Ulasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $index => $report)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $report->deskripsi_kerusakan }}</td>
                <td>{{ $report->lokasi_kerusakan }}</td>
                <td>
                    @if($report->status == 'completed')
                        <span class="text-success">Selesai</span>
                    @elseif($report->status == 'accepted')
                        <span class="text-success">Diterima</span>
                    @elseif($report->status == 'rejected')
                        <span class="text-danger">Ditolak</span>
                        <p><strong>Alasan:</strong> {{ $report->rejection_reason }}</p>
                    @else
                        <span class="text-warning">Dalam Proses</span>
                    @endif
                </td>
                    
                <!-- Kolom Ulasan -->
<!-- Kolom Ulasan -->
<td>
    @if($report->status == 'completed')
        @if($report->reviews->count())
            @foreach($report->reviews as $review)
                <p><strong>Ulasan:</strong> {{ $review->review }}</p>
                <p><strong>Rating:</strong> {{ $review->rating ?? 'Tidak ada rating' }}</p>

<form action="{{ route('review.delete', $review->id) }}" method="POST" style="display:inline;">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger mt-2">Delete Review</button>
</form>
                <br>
            @endforeach
        @else
            <!-- Jika review belum ada -->
            <form action="{{ route('review.store') }}" method="POST">
                @csrf
                <input type="hidden" name="report_id" value="{{ $report->id }}">
                <textarea name="review" placeholder="Masukkan ulasan Anda" required class="form-control mb-2"></textarea>
                <input type="number" name="rating" placeholder="Rating (1-5)" min="1" max="5" required class="form-control mb-2">
                <button type="submit" class="btn btn-primary mt-2">Kirim Ulasan</button>
            </form>
        @endif
    @else
        @if($report->reviews->count())
            <p><strong>Ulasan:</strong> {{ $report->reviews->first()->review }}</p>
            <p><strong>Rating:</strong> {{ $report->reviews->first()->rating ?? 'Tidak ada rating' }}</p>
        @else
            <em>-</em>
        @endif
    @endif
</td>
                            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        <a href="#" class="prev">&lt;&lt;</a>
        <a href="#" class="page active">1</a>
        <a href="#" class="page">2</a>
        <a href="#" class="next">&gt;&gt;</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="js/lacak.js" defer></script>
    <script src="js/index.js" defer></script>
    @include('footer')
</body>
</html>