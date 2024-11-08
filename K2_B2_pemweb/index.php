<?php
// Include koneksi ke database
require 'koneksi.php';

session_start();

// Query untuk mengambil data rumah
$sql = "SELECT * FROM unit_rumah";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADS House</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Header Start -->
    <header>
        <div class="header_web">
            <h2>ADS House</h2>

            <!-- Login dan Logout di sebelah kanan header -->
            <ul class="nav-right">
                <?php if (isset($_SESSION['logged_in'])): ?>
                    <li><a href="logout.php" id="logoutLink">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" id="login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- navbar start -->
        <nav class="navbar">
            <!-- Navbar di sebelah kiri -->
            <ul class="nav-links">
                <li><a href="index.php">Beranda</a></li>
                <li><a href="tentang.html" id="tentang-link">Tentang</a></li>
            </ul>

            <!-- Dark mode di sebelah kanan navbar -->
            <div class="dark-mode-toggle" id="dark-mode-toggle">
                <i id="dark-mode-icon" class="fas fa-moon" style="font-size: 20px;"></i>
            </div>
        </nav>
        <!-- navbar end -->
    </header>
    <!-- Header End -->


    <!-- Content start -->
    <div class="main-content">

        <!-- Sidebar start -->
        <aside class="sidebar">
            <h2>4 Alasan membeli</h2><br>
            <div class="isisidebar">
                <img src="aset/logo1.webp" alt="logo1">
                <div>
                    <h4>Bangunan Berkualitas</h4>
                    <p>Arsitek dan material berkualitas</p>
                </div>
            </div>
            <div class="isisidebar">
                <img src="aset/logo2.webp" alt="logo2">
                <span>
                    <h4>Desain Minimalis</h4>
                    <p>Exterior dan interior minimalis</p>
                </span>
            </div>
            <div class="isisidebar">
                <img src="aset/logo3.png" alt="logo3">
                <span>
                    <h4>Jalan 2 mobil</h4>
                    <p>Tersedia garasi disetiap rumah</p>
                </span>
            </div>
            <div class="isisidebar">
                <img src="aset/logo4.png" alt="logo4">
                <span>
                    <h4>Lokasi Strategis</h4>
                    <p>Dekat ke stadion dan tol</p>
                </span>
        </aside>
        <!-- Sidebar end -->

        <main class="content">
            <!-- Glass container start -->
            <div class="glass container">
                <h2>ADS House</h2>
                <p>
                    Miliki rumah impian dengan lokasi strategis, lingkungan asri,
                    dan desain modern yang elegan. Dekat dengan fasilitas umum seperti sekolah, pusat perbelanjaan,
                    dan layanan kesehatan, perumahan ini menawarkan kenyamanan dan keamanan dengan sistem keamanan 24
                    jam.
                    Dengan harga terjangkau dan cicilan ringan, ini adalah kesempatan sempurna untuk memiliki hunian
                    ideal bagi keluarga Anda.
                    Hubungi kami sekarang untuk mendapatkan penawaran spesial dan promo menarik, hanya untuk unit
                    terbatas!
                </p>
            </div>
            <!-- Glass container end -->
        </main>
    </div>
    <!-- Content end -->

    <!-- Box unit start -->
    <div class="box terjual">
        <div class="angka">130</div>
        <div class="label">Unit Terjual</div>
    </div>
    <div class="box tersedia">
        <div class="angka">70</div>
        <div class="label">Unit Tersedia</div>
    </div>
    <!-- Box unit end -->

    <!-- Header produk Start -->
    <br>
    <div class="judul">
        <h2 align="center"><u>Tipe Rumah</u></h2>
    </div><br>
    <!-- Header produk end -->

    <!-- list produk start -->
    <div class="listings-container">
        <?php
        // Menyertakan koneksi
        require 'koneksi.php';

        // Query untuk mengambil data dari tabel listing
        $sql = "SELECT * FROM unit_rumah";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            // Loop untuk menampilkan setiap data sebagai listing-card
            while ($row = $result->fetch_assoc()) {
                $gambar = htmlspecialchars($row['gambar']); // Escape untuk keamanan
                $tipe = htmlspecialchars($row['tipe']); // Escape untuk keamanan
                $luas_tanah = $row['luas_tanah'];
                $luas_bangunan = $row['luas_bangunan'];
                $deskripsi = $row['deskripsi'];
                $harga = number_format($row['harga'], 0, ',', '.');

                echo '
                <div class="listing-card">
                    <img src="unit/gambar/' . $gambar . '" alt="' . $tipe . '" class="listing-image">
                    <div class="listing-details">
                        <h2 class="listing-title" align="center">' . $tipe . '</h2><br>
                        <p class="listing-location">Luas Tanah: ' . $luas_tanah . 'm²</p>
                        <p class="listing-location">Luas Bangunan: ' . $luas_bangunan . 'm²</p>
                        <p class="listing-price">Rp ' . $harga . ',-</p>
                    </div>
                    <div class="listing-buttons">
                        <a href="detail.php?id_rumah=' . $row['id_rumah'] . '" class="btn btn-detail">Lihat Detail »</a>
                    </div>
                </div>';
            }
        } else {
            echo "Tidak ada data";
        }
        ?>
    </div>
    <!-- list produk end -->

    <!-- Header show more start -->
    <br>
    <div class="judul">
        <h2 align="center"><u>Show More</u></h2>
    </div><br>
    <!-- Header show more end -->

    <!-- Footer start -->
    <footer class="footer">

        <div class="kontak-info">
            <h3>Tentang Kami</h3>
            <ul>
                <li><i class="fa-brands fa-whatsapp"></i> +62 823-5814-7308</li>
                <li><i class="fa-brands fa-facebook"></i> ADS House</li>
                <li><i class="fa-brands fa-instagram"></i> @ads_house</li>
                <li><i class="fa-regular fa-envelope"></i> ads_house@gmail.com</li>
            </ul>
        </div>
        <p>&copy; ADS House</p>
    </footer>
    <!-- Footer end -->

    <!-- script js start -->
    <script>
        // logout
        document.getElementById('logoutLink').addEventListener('click', function(event) {
            event.preventDefault(); 


            const userConfirmed = confirm("Apakah Anda yakin ingin logout?");
            if (userConfirmed) {
                
                document.location.href = 'logout.php';
            } else {
                
            }
        });
    </script>
    <script src="main.js"></script>
    <!-- Script js end -->
</body>
</html>