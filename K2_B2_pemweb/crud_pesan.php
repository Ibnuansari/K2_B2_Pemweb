<?php
include('koneksi.php');
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Pesan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <style type="text/css">
        * {
            font-family: "Trebuchet MS";
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            padding-top: 60px;
            margin: 0;
        }
        
        /* Navbar Styles */
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

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            padding: 0 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table thead {
            background-color: #FFA500;
        }

        table th {
            background-color: #FFA500;
            color: black;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        /* Button Styles */
        .a1, .a2 {
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            font-size: 14px;
            border-radius: 4px;
            display: inline-block;
            margin: 2px;
        }

        .a1 { background-color: #007bff; }
        .a2 { background-color: #dc3545; }

        /* Search Form Styles */
        .search-form {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 20px;
            flex-wrap: wrap;
        }

        .search-form input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 300px;
            max-width: 100%;
        }

        .search-form button {
            padding: 10px 20px;
            background-color: #FFA500;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            table thead {
                display: none;
            }

            table, table tbody, table tr, table td {
                display: block;
                width: 100%;
            }

            table tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                background-color: #fff;
            }

            table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                border-bottom: 1px solid #eee;
            }

            table td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
                color: #000;
            }

            .navbar-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background-color: #333;
                flex-direction: column;
            }

            .navbar-links.active {
                display: flex;
            }

            .hamburger {
                display: flex;
                flex-direction: column;
                cursor: pointer;
            }

            .hamburger div {
                width: 25px;
                height: 3px;
                background-color: white;
                margin: 3px 0;
                transition: 0.4s;
            }

            .hamburger.active .line1 {
                transform: rotate(-45deg) translate(-5px, 6px);
            }

            .hamburger.active .line2 {
                opacity: 0;
            }

            .hamburger.active .line3 {
                transform: rotate(45deg) translate(-5px, -6px);
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
            <a href="crud_pesan.php">Home</a>
            <a href="crud_unit.php">Lihat Unit</a>
            <a href="crud_Pesan.php">Lihat Pesan</a>
            <a href="logout.php" id="logoutLink">Logout</a>
        </div>
    </nav>

    <center><h1>Data Pesan</h1></center>

    <form class="search-form" action="" method="GET">
        <input type="text" name="query" placeholder="Cari nama..." value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>" required>
        <button type="submit">Cari</button>
        <?php if(isset($_GET['query']) && $_GET['query'] != ""): ?>
            <a href="crud_pesan.php"><button type="button">Tampilkan Semua</button></a>
        <?php endif; ?>
    </form>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No hp/Wa</th>
                    <th>Email</th>
                    <th>Perihal</th>
                    <th>Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['query']) && !empty($_GET['query'])) {
                    $search = mysqli_real_escape_string($koneksi, $_GET['query']);
                    $sql = "SELECT * FROM pesan WHERE nama LIKE '%$search%' ORDER BY id ASC";
                } else {
                    $sql = "SELECT * FROM pesan ORDER BY id ASC";
                }
                
                $result = mysqli_query($koneksi, $sql);
                if(!$result){
                    die ("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                }

                $no = 1;
                while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td data-label="No"><?php echo $no; ?></td> 
                    <td data-label="Nama"><?php echo $row['nama']; ?></td>
                    <td data-label="No hp/Wa"><?php echo $row['ponsel']; ?></td>
                    <td data-label="Email"><?php echo $row['email']; ?></td>
                    <td data-label="Perihal"><?php echo $row['perihal']; ?></td>
                    <td data-label="Pesan"><?php echo substr($row['pesan'], 0, 150); ?></td>
                    <td data-label="Aksi">
                        <a class="a1" href="pesan/edit_pesan.php?id=<?php echo $row['id']; ?>">&#128393; Edit</a> 
                        <a class="a2" href="pesan/proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">&#128465; Hapus</a>
                    </td>
                </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hamburger = document.querySelector('.hamburger');
            const navLinks = document.querySelector('.navbar-links');
            const logoutLink = document.getElementById('logoutLink');

            hamburger.addEventListener('click', function () {
                this.classList.toggle('active');
                navLinks.classList.toggle('active');
            });

            logoutLink.addEventListener('click', function (event) {
                event.preventDefault();
                if (confirm('Apakah Anda yakin ingin logout?')) {
                    window.location.href = 'logout.php';
                }
            });
        });
    </script>
</body>
</html>