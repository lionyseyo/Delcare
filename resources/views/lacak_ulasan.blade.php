<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo2.jpg') }}" type="image/x-icon">
    <title>Lacak Ulasan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/lacak_ulasan.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>

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
          <img src="img/profile.png" alt="User Avatar" class="user-avatar">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Keluar</button>
        </form>
        </div>
      </header>


      <div class="dashboard">
        <h2 class="dashboard-title">Lacak Status Laporan</h2>


    <table class="table table-bordered">
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
                        @if($report->reviews->count())
                            <a href="{{ route('isi_ulasan', ['id' => $report->id]) }}" class="btn btn-info">Lihat Ulasan</a>
                        @else
                            <em>Belum ada ulasan</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal untuk menampilkan review -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Detail Ulasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Review:</strong> <span id="reviewContent">Memuat...</span></p>
                <p><strong>Rating:</strong> <span id="reviewRating">-</span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
async function showReview(reportId) {
    try {
        const response = await fetch(/api/reports/${reportId}/review);
        const data = await response.json();

        if (data.success) {
            document.getElementById('reviewContent').innerText = data.review.review;
            document.getElementById('reviewRating').innerText = data.review.rating || '-';
        } else {
            document.getElementById('reviewContent').innerText = 'Ulasan tidak ditemukan';
            document.getElementById('reviewRating').innerText = '-';
        }

        var reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'));
        reviewModal.show();
    } catch (error) {
        console.error('Error fetching review:', error);
    }
}
</script>

</body>
</html>