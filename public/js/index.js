// Ambil elemen notifikasi dan panel
        const notifIcon = document.getElementById('notif-icon');
        const notifPanel = document.getElementById('notif-panel');
    
// Toggle tampil/simpan panel ketika ikon diklik
        notifIcon.addEventListener('click', function() {
            if (notifPanel.style.display === 'none' || notifPanel.style.display === '') {
                notifPanel.style.display = 'block';
            } else {
                notifPanel.style.display = 'none';
            }
        });
    

//show more
        document.addEventListener('DOMContentLoaded', function() {
            const showMoreLink = document.getElementById('show-more');
            const extraNotif = document.getElementById('extra-notif');
            const extraLine = document.getElementById('extra-line');  // Garis tambahan
        
            showMoreLink.addEventListener('click', function(e) {
                e.preventDefault();
                if (extraNotif.style.display === 'none' || extraNotif.style.display === '') {
                    // Tampilkan notifikasi tambahan dan garis
                    extraNotif.style.display = 'block';
                    extraLine.style.display = 'block';  // Tampilkan garis setelah notifikasi keempat
                    showMoreLink.textContent = 'Tutup Notifikasi'; // Ubah teks tombol
                } else {
                    // Sembunyikan notifikasi tambahan dan garis
                    extraNotif.style.display = 'none';
                    extraLine.style.display = 'none';  // Sembunyikan garis
                    showMoreLink.textContent = 'Lihat Semua Notifikasi'; // Ubah teks tombol kembali
                }
            });
        });    // Menutup panel notifikasi ketika user klik di luar panel
    window.addEventListener('click', function(e) {
        if (!notifPanel.contains(e.target) && !notifIcon.contains(e.target)) {
            notifPanel.style.display = 'none';
        }
    });

