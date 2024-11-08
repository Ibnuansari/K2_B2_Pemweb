<?php
// crud_unit.php
include('koneksi.php');
session_start();

// Mengecek apakah pengguna sudah login dan memiliki peran 'admi
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

// untuk menangani pencarian live search melalui AJAX
if(isset($_GET['live_search'])) {
    $search = mysqli_real_escape_string($koneksi, $_GET['live_search']);

    // Query pencarian berdasarkan kata kunci
    $query = "SELECT * FROM unit_rumah 
            WHERE tipe LIKE '%$search%' 
            OR luas_tanah LIKE '%$search%'
            OR luas_bangunan LIKE '%$search%'
            OR deskripsi LIKE '%$search%'
            OR harga LIKE '%$search%'
            ORDER BY id_rumah ASC";
    
    $result = mysqli_query($koneksi, $query);
    
    // Jika data ditemukan, buat baris HTML untuk menampilkan hasilnya
    if(mysqli_num_rows($result) > 0) {
        $output = '';
        $no = 1;
        while($row = mysqli_fetch_assoc($result)) {
            $output .= '
            <tr>
                <td>'.$no.'</td>
                <td style="text-align: center;"><img src="unit/gambar/'.htmlspecialchars($row['gambar']).'" style="width: 120px;"></td>
                <td>'.htmlspecialchars($row['tipe']).'</td>
                <td>'.htmlspecialchars($row['luas_tanah']).' m²</td>
                <td>'.htmlspecialchars($row['luas_bangunan']).' m²</td>
                <td>'.htmlspecialchars(substr($row['deskripsi'], 0, 20)).'...</td>
                <td>Rp '.number_format($row['harga'], 0, ',', '.').'</td>
                <td>
                    <a class="a1" href="unit/edit_unit.php?id_rumah='.$row['id_rumah'].'">&#128393; Edit</a>
                    <a class="a2" href="unit/proses_hapus.php?id_rumah='.$row['id_rumah'].'" onclick="return confirm(\'Anda yakin akan menghapus data ini?\')">&#128465; Hapus</a>
                </td>
            </tr>';
            $no++;
        }
        echo $output;
    } else {
        echo '<tr><td colspan="8" style="text-align: center;">Tidak ada data yang ditemukan</td></tr>';
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Unit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            font-family: "Trebuchet MS";
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            padding-top: 60px;
        }

        .navbar {
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            z-index: 1000;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar-brand {
            font-size: 1.5em;
            font-weight: bold;
        }

        .navbar-links {
            display: flex;
        }

        .hamburger {
            display: none;
            cursor: pointer;
            padding: 10px;
            flex-direction: column;
        }

        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 5px 0;
            transition: all 0.3s ease;
        }

        @media screen and (max-width: 768px) {
            .hamburger {
                display: flex;
            }
            .navbar-links {
                display: none;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 60px;
                left: 0;
                background-color: #333;
            }

            .navbar-links.active {
                display: flex;
            }

            .navbar-links a {
                padding: 15px;
                width: 100%;
                text-align: center;
            }
        }

        .navbar .hamburger.active .line1 {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .navbar .hamburger.active .line2 {
            opacity: 0;
        }

        .navbar .hamburger.active .line3 {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        h1 {
            text-transform: uppercase;
            color: #FFA500;
            margin: 20px 0;
        }

        table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            width: 70%;
            margin: 10px auto 10px auto;
        }

        table thead th {
            background-color: #FFA500;
            border: solid 1px black;
            color: white;
            padding: 10px;
            text-align: left;
        }

        table tbody td {
            border: solid 1px black;
            color: #333;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
        }

        .action-button {
            background-color: #FFA500;
            color: #fff;
            padding: 10px;
            text-decoration: none;
            font-size: 12px;
            display: inline-block;
            margin: 10px 0;
        }

        .a1 {
            background-color: blue;
            color: white;
            padding: 10px;
            text-decoration: none;
            font-size: 12px;
        }

        .a2 {
            background-color: red;
            color: white;
            padding: 10px;
            text-decoration: none;
            font-size: 12px;
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            position: relative;
        }

        .search-container input[type="text"] {
            width: 300px;
            padding: 10px;
            font-size: 14px;
            border: 2px solid #FFA500;
            border-radius: 4px;
            outline: none;
        }

        .search-container input[type="text"]:focus {
            border-color: #ff8c00;
            box-shadow: 0 0 5px rgba(255, 140, 0, 0.3);
        }

        .loading-indicator {
            display: none;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .highlight {
            background-color: #fff3cd;
            transition: background-color 0.3s;
        }

        @media screen and (max-width: 768px) {
            table {
                width: 90%;
                font-size: 14px;
            }

            table thead {
                display: none;
            }

            table tbody td {
                display: block;
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            table tbody td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }

            .a1, .a2 {
                display: block;
                margin: 5px 0;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="navbar-brand">ADS House</a>
        <div class="hamburger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <div class="navbar-links">
            <a href="crud_unit.php">Home</a>
            <a href="crud_unit.php">Lihat Unit</a>
            <a href="crud_pesan.php">Lihat Pesan</a>
            <a href="logout.php" id="logoutLink">Logout</a>
        </div>
    </nav>

    <center>
        <h1>Data Unit</h1>
    </center>
    <center>
        <a href="unit/tambah_unit.php" class="action-button">+ &nbsp; Tambah Unit</a>
    </center>
    
    <div class="search-container">
        <input type="text" id="live-search" placeholder="Cari rumah... (ketik untuk mencari)">
        <span class="loading-indicator">Mencari...</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Tipe Rumah</th>
                <th>Luas Tanah</th>
                <th>Luas Bangunan</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="search-results">
            <?php
            $query = "SELECT * FROM unit_rumah ORDER BY id_rumah ASC";
            $result = mysqli_query($koneksi, $query);
            
            if(mysqli_num_rows($result) > 0) {
                $no = 1;
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td data-label="No"><?php echo $no; ?></td>
                        <td data-label="Gambar" style="text-align: center;">
                            <img src="unit/gambar/<?php echo htmlspecialchars($row['gambar']); ?>" style="width: 120px;">
                        </td>
                        <td data-label="Tipe Rumah"><?php echo htmlspecialchars($row['tipe']); ?></td>
                        <td data-label="Luas Tanah"><?php echo htmlspecialchars($row['luas_tanah']); ?> m²</td>
                        <td data-label="Luas Bangunan"><?php echo htmlspecialchars($row['luas_bangunan']); ?> m²</td>
                        <td data-label="Deskripsi"><?php echo htmlspecialchars(substr($row['deskripsi'], 0, 20)); ?>...</td>
                        <td data-label="Harga">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td data-label="Action">
                            <a class="a1" href="unit/edit_unit.php?id_rumah=<?php echo $row['id_rumah']; ?>">&#128393; Edit</a>
                            <a class="a2" href="unit/proses_hapus.php?id_rumah=<?php echo $row['id_rumah']; ?>" 
                                onclick="return confirm('Anda yakin akan menghapus data ini?')">&#128465; Hapus</a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                }
            } else {
                ?>
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variabel DOM untuk elemen-elemen halaman
            const searchInput = document.getElementById('live-search');
            const searchResults = document.getElementById('search-results');
            const loadingIndicator = document.querySelector('.loading-indicator');
            let searchTimeout;

            // Fungsi pencarian dengan debounce
            function performSearch() {
                const searchText = searchInput.value;
                
                if (loadingIndicator) {
                    loadingIndicator.style.display = 'block';
                }

                // Create and configure XHR request
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `crud_unit.php?live_search=${encodeURIComponent(searchText)}`, true);

                xhr.onload = function() {

                    // Ketika pencarian berhasil
                    if (xhr.status === 200) {
                        if (searchResults) {
                            searchResults.innerHTML = xhr.responseText;
                            
                            // Add highlight effect
                            const rows = searchResults.getElementsByTagName('tr');
                            Array.from(rows).forEach(row => {
                                row.classList.add('highlight');
                                setTimeout(() => {
                                    row.classList.remove('highlight');
                                }, 300);
                            });
                        }
                    } else {
                        searchResults.innerHTML = '<tr><td colspan="8" style="text-align: center;">Terjadi kesalahan saat mencari data</td></tr>';
                    }
                    
                    if (loadingIndicator) {
                        loadingIndicator.style.display = 'none';
                    }
                };
                
                // Ketika terjadi error
                xhr.onerror = function() {
                    searchResults.innerHTML = '<tr><td colspan="8" style="text-align: center;">Terjadi kesalahan saat mencari data</td></tr>';
                    if (loadingIndicator) {
                        loadingIndicator.style.display = 'none';
                    }
                };

                xhr.send();
            }

            // Event listener untuk input pencarian
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(performSearch, 300); // 300ms delay
                });
            }

            // Event untuk menu responsif
            const hamburger = document.querySelector('.hamburger');
            const navbarLinks = document.querySelector('.navbar-links');

            if (hamburger) {
                hamburger.addEventListener('click', function() {
                    this.classList.toggle('active');
                    if (navbarLinks) {
                        navbarLinks.classList.toggle('active');
                    }
                });
            }

            // Konfirmasi Logout
            const logoutLink = document.getElementById('logoutLink');
            if (logoutLink) {
                logoutLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    const userConfirmed = confirm("Apakah Anda yakin ingin logout?");
                    if (userConfirmed) {
                        window.location.href = 'logout.php';
                    }
                });
            }
        });
    </script>
</body>
</html>