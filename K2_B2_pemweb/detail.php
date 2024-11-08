<?php
// Memulai sesi dan menyertakan koneksi database 
require 'koneksi.php';
session_start();

// Mengambil ID rumah dari parameter URL
if (!isset($_GET['id_rumah'])) {
    header("Location: index.php");
    exit();
}

$id_rumah = mysqli_real_escape_string($koneksi, $_GET['id_rumah']);

// Query untuk mengambil detail rumah
$sql = "SELECT * FROM unit_rumah WHERE id_rumah = '$id_rumah'";
$result = mysqli_query($koneksi, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

$rumah = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id_rumah">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Properti - <?php echo htmlspecialchars($rumah['tipe']); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .detail-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .detail-title {
            font-size: 2rem;
            color: #333;
        }

        .detail-price {
            font-size: 1.5rem;
            color: #2c5282;
            font-weight: bold;
        }

        .detail-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .detail-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .detail-info {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .info-item {
            display: flex;
            gap: 1rem;
            align-items: center;
            padding: 1rem;
            background: #f7fafc;
            border-radius: 8px;
        }

        .info-item i {
            font-size: 1.5rem;
            color: #2c5282;
        }

        .detail-description {
            margin-top: 2rem;
            padding: 1rem;
            background: #f7fafc;
            border-radius: 8px;
        }

        .detail-features {
            margin-top: 2rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
        }

        .feature-item i {
            color: #2c5282;
        }

        .back-button {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #2c5282;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 2rem;
            transition: background 0.3s;
        }

        .back-button:hover {
            background: #1a365d;
        }

        @media (min-width: 768px) {
    .detail-container {
        padding: 2rem;
        margin: 2rem auto;
    }

    .detail-header {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .detail-content {
        grid-template-columns: 1fr 1fr;
        }
    }

        @media (max-width: 480px) {
            .detail-container {
                padding: 1rem;
                margin: 0.5rem;
            }

            .features-grid {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }

            .info-item {
                padding: 0.75rem;
            }

            .feature-item {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 768px) {
            .header_web {
                padding: 0.5rem 1rem;
            }

            .navbar .nav-links {
                flex-direction: column;
                gap: 0.5rem;
            }

            .nav-right {
                gap: 0.5rem;
            }
        }

        .footer {
            padding: 1.5rem;
            text-align: center;
        }

        .kontak-info ul {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        @media (min-width: 768px) {
            .kontak-info ul {
                flex-direction: row;
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 768px) {
            .detail-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header_web">
            <h2>ADS House</h2>
            <ul class="nav-right">
                <?php if(isset($_SESSION['logged_in'])): ?>
                    <li><a href="logout.php" id="logoutLink">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="index.php">Beranda</a></li>
                <li><a href="tentang.html">Tentang</a></li>
            </ul>
            <div class="dark-mode-toggle" id_rumah="dark-mode-toggle">
                <i id_rumah="dark-mode-icon" class="fas fa-moon"></i>
            </div>
        </nav>
    </header>

    <!-- Konten Detail -->
    <div class="detail-container">
        <div class="detail-header">
            <h1 class="detail-title"><?php echo htmlspecialchars($rumah['tipe']); ?></h1>
            <div class="detail-price">Rp <?php echo number_format($rumah['harga'], 0, ',', '.'); ?>,-</div>
        </div>

        <div class="detail-content">
            <div class="detail-image-container">
                <img src="unit/gambar/<?php echo htmlspecialchars($rumah['gambar']); ?>" alt="<?php echo htmlspecialchars($rumah['tipe']); ?>" class="detail-image">
            </div>

            <div class="detail-info">
                <div class="info-item">
                    <i class="fas fa-ruler-combined"></i>
                    <div>
                        <h3>Luas Tanah</h3>
                        <p><?php echo $rumah['luas_tanah']; ?> m²</p>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-home"></i>
                    <div>
                        <h3>Luas Bangunan</h3>
                        <p><?php echo $rumah['luas_bangunan']; ?> m²</p>
                    </div>
                </div>

                <div class="detail-description">
                    <h3>Deskripsi</h3>
                    <p><?php echo nl2br(htmlspecialchars($rumah['deskripsi'])); ?></p>
                </div>
            </div>
        </div>

        <div class="detail-features">
            <h2>Fasilitas</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-car"></i>
                    <span>Garasi 2 Mobil</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-bed"></i>
                    <span>3 Kamar Tidur</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-bath"></i>
                    <span>2 Kamar Mandi</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-bolt"></i>
                    <span>Listrik 2200 VA</span>
                </div>
            </div>
        </div>
        
        <!-- Form Input Start -->
        <div class="container-form">
            <div class="form-section">
                <h1>Hubungi Kami</h1>
                <?php if (isset($_SESSION['logged_in'])): ?>
                    <!-- Tampilan saat sudah login -->
                    <form method="post" action="pesan/form_input.php" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <input type="hidden" name="id_rumah" value="<?php echo htmlspecialchars($id_rumah); ?>">
                        <div class="form-group">
                            <input type="text" name="nama" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="ponsel" name="ponsel" min="0" placeholder="Ponsel/WA" pattern="\d{12}" title="Nomor telepon harus 12 digit angka." required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Alamat e-Mail" title="masukkan email yang valid." required>
                        </div>
                        <div class="form-group">
                            <select name="perihal" required>
                                <option value="">Perihal</option>
                                <option value="Info Rumah">Info Rumah</option>
                                <option value="Booking Rumah">Booking Rumah</option>
                                <option value="Jadwal Kunjungan">Jadwal Kunjungan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="pesan" placeholder="Ketik Pesan Anda" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="submit-btn">KIRIM</button>
                    </form>

                <?php else: ?>
                    <div class="login-required-message">
                        <p>Silakan <a href="login.php">login</a> terlebih dahulu untuk mengisi form.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Form Input End -->
    
        <a href="index.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>

    <!-- Footer -->
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
    <script>
        function validateForm() {
            // Validasi nomor telepon
            const phoneInput = document.getElementById("ponsel").value;
            const phonePattern = /^\d{12}$/; // Hanya angka dan harus 12 digit
            if (!phonePattern.test(phoneInput)) {
                alert("Nomor telepon harus 12 digit angka.");
                return false;
            }

            // Validasi email
            const emailInput = document.getElementById("email").value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Format standar email
            if (!emailPattern.test(emailInput)) {
                alert("Masukkan alamat email yang valid.");
                return false;
            }

        }
    </script>
    <script src="main.js"></script>
</body>
</html>