<?php
include('../koneksi.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah Unit</title>
    <style type="text/css">
        * {
            font-family: "Trebuchet MS";
        }

        h1 {
            text-transform: uppercase;
            color: salmon;
        }

        button {
            background-color: salmon;
            color: #fff;
            padding: 10px;
            text-decoration: none;
            font-size: 12px;
            border: 0px;
            margin-top: 20px;
        }

        label {
            margin-top: 10px;
            float: left;
            text-align: left;
            width: 100%;
        }

        input {
            padding: 6px;
            width: 100%;
            box-sizing: border-box;
            background: #f8f8f8;
            border: 2px solid #ccc;
            outline-color: salmon;
        }

        div {
            width: 100%;
            height: auto;
        }

        .base {
            width: 400px;
            height: auto;
            padding: 20px;
            margin-left: auto;
            margin-right: auto;
            background: #ededed;
        }
        
        .listing-buttons {
            display: flex;
            padding: 15px;
        }

        .btn {
            padding: 10px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-detail {
            background-color: salmon;
            color: white;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <center>
        <h1>Tambah Unit</h1>
        <center>
            <form method="POST" action="proses_tambah.php" enctype="multipart/form-data">
                <section class="base">
                    <div>
                        <label>Gambar</label>
                        <input type="file" name="gambar" required="" />
                    </div>
                    <div>
                        <label>Tipe Rumah</label>
                        <input type="text" name="tipe" autofocus="" required="" />
                    </div>
                    <div>
                        <label>Luas Tanah</label>
                        <input type="number" name="luas_tanah" min="0" />
                    </div>
                    <div>
                        <label>Luas Bangunan</label>
                        <input type="number" name="luas_bangunan" min="0" required="" />
                    </div>
                    <div>
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" required="" />
                    </div>
                    <div>
                        <label>Harga</label>
                        <input type="number" name="harga" min="0" required="" />
                    </div>
                    
                    <div>
                        <button type="submit">Simpan Unit</button>
                    </div>
                    <div class="listing-buttons">
                        <a href="../crud_unit.php" class="btn btn-detail"><< Kembali</a>
                    </div>
                </section>
            </form>
</body>
</html>