document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk tombol kirim
    const form = document.getElementById('ulasan-form');
    const popup = document.getElementById('popupModal');
    const closePopupBtn = document.getElementById('closePopup');
    const closeIcon = document.querySelector('.close');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form dari submit sebenarnya
        popup.style.display = 'block'; // Menampilkan popup
    });

    // Event listener untuk menutup popup
    closePopupBtn.addEventListener('click', function() {
        popup.style.display = 'none'; // Menyembunyikan popup
    });

    closeIcon.addEventListener('click', function() {
        popup.style.display = 'none'; // Menyembunyikan popup
    });

    // Menutup popup jika area di luar popup di-klik
    window.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.style.display = 'none'; // Menyembunyikan popup
        }
    });
});