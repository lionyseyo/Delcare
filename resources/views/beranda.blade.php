<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo2.jpg') }}" type="image/x-icon">
    <title>Delcare | Beranda</title>
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    @include('navbar')
    
</head>
<body>

    <!-- Help Section -->
    <main class="main-content">
        <div class="help-section">
            <div class="help-card">
                <img src="{{ asset('img/online-registration.png') }}" alt="Pengiriman Formulir">                
                <a href="{{ route('form') }}" class="no-underline"><p>Kirim Laporan</p></a>
            </div>
            <div class="help-card">
                <img src="{{ asset('img/tracking.png') }}"  alt="Lacak Status">
                <a href="{{ route('lacak_dm') }}" class="no-underline"><p>Lacak Status</p></a>
            </div>
        </div>
    </main>

    <section class="steps-section">
        <h2>Langkah Mudah Mengirim Laporan Kerusakan</h2>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <h3>Masuk</h3>
                <p>Masuk ke dalam website Delcare menggunakan akun dan kata sandi yang sudah dibagikan sebelumnya. Pastikan memakai akun milik sendiri.</p>
            </div>
            <div class="step-card">
                <div class="step-number">2</div>
                <h3>Kirim Laporan</h3>
                <p>Pilih opsi Kirim Laporan untuk mengirimkan laporan kerusakan.</p>
            </div>
            <div class="step-card">
                <div class="step-number">3</div>
                <h3>Pengisian Laporan</h3>
                <p>Isilah laporan tersebut dengan sebenar-benarnya dan sertakan bukti kerusakan untuk mempercepat tindakan perbaikan.</p>
            </div>
            <div class="step-card">
                <div class="step-number">4</div>
                <h3>Lacak Status</h3>
                <p>Pilih opsi "Lacak Status" untuk melihat aktivitas laporan yang sudah anda kirimkan.</p>
            </div>
            <div class="step-card">
                <div class="step-number">5</div>
                <h3>Cek Status Secara Berkala</h3>
                <p>Duktek dan Maintenance akan memberikan feedback untuk laporan yang kamu kirimkan.</p>
            </div>
            <div class="step-card">
                <div class="step-number">6</div>
                <h3>Ulasan</h3>
                <p>Berikan ulasanmu dengan jujur tentang performa perbaikan yang dilakukan.</p>
            </div>
            <div class="step-card">
                <div class="step-number">7</div>
                <h3>Panduan</h3>
                <p>Lihat panduan sebagai langkah awal perbaikan. Panduan akan berisi semua kerusakan yang mampu diperbaiki secara mandiri. Namun jika tidak bisa, silahkan mengirimkan laporan.</p>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <h2>Pertanyaan Populer</h2>
        
        <!-- FAQ Item 1 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleAnswer(this)">
                <h3>Berapa lama waktu yang dibutuhkan untuk laporan saya diproses?</h3>
                <span class="icon">−</span>
            </div>
            <div class="faq-answer">
                <p>Laporan Anda akan segera ditinjau oleh tim duktek/maintenance. Waktu pemrosesan bergantung pada tingkat urgensi dan jumlah laporan yang masuk, namun Anda dapat memantau status laporan melalui akun Anda.</p>
            </div>
        </div>

        <!-- FAQ Item 2 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleAnswer(this)">
                <h3>Apa yang harus saya lakukan sebelum mengirim laporan?</h3>
                <span class="icon">+</span>
            </div>
            <div class="faq-answer">
                <p>Anda bisa membaca artikel panduan penanganan pertama yang tersedia di website. Artikel ini membantu Anda mengatasi masalah sementara sebelum tim duktek/maintenance menangani kerusakan.</p>
            </div>
        </div>

        <!-- FAQ Item 3 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleAnswer(this)">
                <h3>Bagaimana saya tahu laporan saya diterima atau ditolak?</h3>
                <span class="icon">+</span>
            </div>
            <div class="faq-answer">
                <p>Anda dapat memantaunya dibagian "Lacak Status" web Delcare. Jika laporan diterima, status akan berubah menjadi "Dalam Proses". Jika ditolak, alasan penolakan akan disertakan.</p>
            </div>
        </div>

        <!-- FAQ Item 4 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleAnswer(this)">
                <h3>Apa yang harus saya lakukan jika laporan saya ditolak?</h3>
                <span class="icon">+</span>
            </div>
            <div class="faq-answer">
                <p>Jika laporan Anda ditolak, periksa alasan penolakan yang disertakan. Anda dapat memperbarui laporan dengan informasi tambahan atau menghubungi tim duktek/maintenance melalui kontak yang tersedia untuk klarifikasi lebih lanjut.</p>
            </div>
        </div>

        <!-- FAQ Item 4 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleAnswer(this)">
                <h3>Apa yang terjadi setelah laporan saya diterima?</h3>
                <span class="icon">+</span>
            </div>
            <div class="faq-answer">
                <p>Setelah laporan Anda diterima, statusnya akan berubah menjadi "Diterima". Tim duktek/maintenance akan segera menindaklanjuti kerusakan yang dilaporkan. Anda juga dapat memantau perkembangan penyelesaian melalui akun Anda.</p>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/faq.js') }}"></script>
    @include('footer')
</body>
</html>
