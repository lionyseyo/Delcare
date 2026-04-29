document.addEventListener('DOMContentLoaded', function() {
    const statusElements = document.querySelectorAll('.status-sukses .arrow');

    statusElements.forEach(function(arrow) {
        arrow.addEventListener('click', function() {
            const reviewBox = this.parentElement.nextElementSibling;
            const isVisible = reviewBox.style.display === 'block';

            // Sembunyikan semua review-box
            document.querySelectorAll('.review-box').forEach(box => box.style.display = 'none');

            // Toggle visibility
            if (!isVisible) {
                reviewBox.style.display = 'block';
            }
        });
    });

    // Menutup review box ketika mengklik di luar
    document.addEventListener('click', function(event) {
        if (!event.target.classList.contains('arrow') && !event.target.classList.contains('review-link')) {
            document.querySelectorAll('.review-box').forEach(box => box.style.display = 'none');
        }
    });
});
