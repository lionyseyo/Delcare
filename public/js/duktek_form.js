function toggleRejectionReason(button) {
    // Tampilkan popup alasan penolakan
    const popup = document.querySelector('.popup-rejection');
    const overlay = document.querySelector('.overlay');

    popup.style.display = 'block';
    overlay.style.display = 'block';
}

function closePopup() {
    // Tutup popup alasan penolakan
    const popup = document.querySelector('.popup-rejection');
    const overlay = document.querySelector('.overlay');

    popup.style.display = 'none';
    overlay.style.display = 'none';
}
