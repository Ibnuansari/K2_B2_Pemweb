// Dark mode toggle
const toggleSwitch = document.getElementById('dark-mode-toggle');
const icon = document.getElementById('dark-mode-icon');

// Cek preferensi dark mode pengguna saat halaman dimuat
if (localStorage.getItem('darkMode') === 'enabled') {
    document.body.classList.add('dark-mode');
    icon.classList.remove('fa-moon');
    icon.classList.add('fa-sun'); // Ubah ke ikon matahari
} else {
    icon.classList.remove('fa-sun');
    icon.classList.add('fa-moon'); // Ubah ke ikon bulan
}

// Fungsi untuk mengganti mode dan menyimpan preferensi pengguna
toggleSwitch.addEventListener('click', function() {
    document.body.classList.toggle('dark-mode');

    // Periksa jika dark mode aktif dan simpan preferensi
    if (document.body.classList.contains('dark-mode')) {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun'); 
        localStorage.setItem('darkMode', 'enabled');
    } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon'); 
        localStorage.setItem('darkMode', 'disabled');
    }
});

// hamburger menu
const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navLinks.classList.toggle("active");
});

// Close menu when clicking a link
document.querySelectorAll(".nav-links a").forEach(n => n.addEventListener("click", () => {
    hamburger.classList.remove("active");
    navLinks.classList.remove("active");
}));

// Konfirmasi link Tentang
document.getElementById('tentang-link').addEventListener('click', function(event) {
    event.preventDefault();
    var popupconfirm = confirm("Apakah Anda ingin masuk ke halaman Tentang?");
    if (popupconfirm === true) {
        window.location.href = "tentang.html";
    }
});


// searching
document.addEventListener('DOMContentLoaded', function() {
    const inputPencarian = document.getElementById('inputPencarian');
    const infoHasil = document.getElementById('hasilPencarian');
    let penundaanPencarian;
    
    function lakukanPencarian() {
        const kataKunci = inputPencarian.value.toLowerCase().trim();
        const semuaListing = document.querySelectorAll('.listing-card');
        let jumlahHasil = 0;
        
        semuaListing.forEach(listing => {
            const judul = listing.querySelector('.listing-title').textContent.toLowerCase();
            const detail = listing.querySelector('.listing-details').textContent.toLowerCase();
            const harga = listing.querySelector('.listing-price').textContent.toLowerCase();
            
            if (judul.includes(kataKunci) || 
                detail.includes(kataKunci) || 
                harga.includes(kataKunci)) {
                listing.classList.remove('tersembunyi');
                jumlahHasil++;
            } else {
                listing.classList.add('tersembunyi');
            }
        });
        
        // Perbarui informasi hasil pencarian
        if (kataKunci === '') {
            infoHasil.textContent = '';
        } else if (jumlahHasil === 0) {
            infoHasil.textContent = 'Tidak ditemukan hasil yang sesuai';
        } else {
            infoHasil.textContent = `Ditemukan ${jumlahHasil} rumah`;
        }
    }
    
    inputPencarian.addEventListener('input', function() {
        // Tunda pencarian untuk mengoptimalkan kinerja
        clearTimeout(penundaanPencarian);
        penundaanPencarian = setTimeout(lakukanPencarian, 300);
    });
    
    // Tambahkan event listener untuk tombol hapus pencarian
    inputPencarian.addEventListener('keyup', function(e) {
        if (e.key === 'Escape') {
            this.value = '';
            lakukanPencarian();
        }
    });
});