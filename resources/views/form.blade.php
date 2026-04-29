<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{ asset('img/logo2.jpg') }}" type="image/x-icon">
        <title>Kirim Laporan Kerusakan</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
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
        <h1>Laporan Kerusakan</h1>
    </div>
</header>

<!-- Main content -->
<main class="container">
    <div class="container">
    <h2>Tuliskan Kendalamu</h2>
    <form action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <div class="form-group">
            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" placeholder="Masukkan nama lengkapmu" required>
        </div>
        <div class="form-group">
            <label for="nomorHandphone" class="form-label">Nomor Handphone</label>
            <input type="text" class="form-control" id="nomorHandphone" name="nomor_handphone" placeholder="Masukkan nomor handphone" required>
        </div>
        <div class="form-group">
            <label for="programStudi" class="form-label">Program Studi</label>
            <select class="form-select" id="programStudi" name="program_studi" required>
                <option value="" disabled selected>Pilih program studi</option>
                <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                <option value="S1 Informatika">S1 Informatika</option>
                <option value="S1 Tenik Elektro">S1 Tenik Elektro</option>
                <option value="S1 Teknik Bioproses">S1 Teknik Bioproses</option>
                <option value="S1 Manajemen Rekayasa">S1 Manajemen Rekayasa</option>
                <option value="S1 Teknik Metalurgi">S1 Teknik Metalurgi</option>
                <option value="D3 Teknik Komputer">D3 Teknik Komputer</option>
                <option value="D3 Teknologi Informasi">D3 Teknologi Informasi</option>
                <option value="D4 Teknologi Rekayasa Perangkat Lunak">D4 Teknologi Rekayasa Perangkat Lunak</option>
            </select>
        </div>
        <div class="form-group">
            <label for="lokasiKerusakan" class="form-label">Lokasi Kerusakan</label>
            <input type="text" class="form-control" id="lokasiKerusakan" name="lokasi_kerusakan" placeholder="Masukkan lokasi kerusakan" required>
        </div>
        <div class="form-group">
            <label for="deskripsiKerusakan" class="form-label">Deskripsi Kerusakan</label>
            <textarea class="form-control" id="deskripsiKerusakan" name="deskripsi_kerusakan" rows="3" placeholder="Bagian ini harap isi dengan jelas dan detail bentuk kerusakan yang ditemukan." required></textarea>
        </div>
        <div class="form-group">
            <label for="ditujukanKepada" class="form-label">Ditujukan Kepada</label>
            <select class="form-control" id="ditujukanKepada" name="ditujukan_kepada" required>
                <option value="" disabled selected>Pilih tujuan laporan</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Duktek">Duktek</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fotoKerusakan" class="form-label">Unggah Foto Bukti Kerusakan</label>
            <input class="form-control" type="file" id="fotoKerusakan" name="foto_kerusakan">
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
    
    <script>
        function validateForm() {
            const fields = [
                { id: "namaLengkap", message: "Nama lengkap wajib diisi!" },
                { id: "nomorHandphone", message: "Nomor handphone wajib diisi!" },
                { id: "programStudi", message: "Program studi wajib dipilih!" },
                { id: "lokasiKerusakan", message: "Lokasi kerusakan wajib diisi!" },
                { id: "deskripsiKerusakan", message: "Deskripsi kerusakan wajib diisi!" },
                { id: "ditujukanKepada", message: "Tujuan laporan wajib dipilih!" },
            ];
    
            for (const field of fields) {
                const element = document.getElementById(field.id);
                if (!element.value) {
                    alert(field.message);
                    element.focus();
                    return false;
                }
            }
    
            return true;
        }
    </script>
    
</main>

@include('footer')
</body>
</html>