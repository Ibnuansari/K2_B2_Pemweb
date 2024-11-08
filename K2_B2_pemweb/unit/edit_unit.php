<?php
// memanggil file koneksi.php untuk membuat koneksi
require '../koneksi.php';

// mengecek apakah di url ada nilai GET id_rumah
if (isset($_GET['id_rumah'])) {
  // ambil nilai id_rumah dari url dan disimpan dalam variabel $id_rumah
  $id_rumah = ($_GET["id_rumah"]);

  // menampilkan data dari database yang mempunyai id_rumah=$id_rumah
  $query = "SELECT * FROM unit_rumah WHERE id_rumah='$id_rumah'";
  $result = mysqli_query($koneksi, $query);
  // jika data gagal diambil maka akan tampil error berikut
  if (!$result) {
    die("Query Error: " . mysqli_errno($koneksi) .
      " - " . mysqli_error($koneksi));
  }
  // mengambil data dari database
  $data = mysqli_fetch_assoc($result);
  // apabila data tidak ada pada database maka akan dijalankan perintah ini
  if (!count($data)) {
    echo "<script>alert('Data tidak ditemukan pada database');window.location='../crud_unit.php';</script>";
  }
} else {
  // apabila tidak ada data GET id_rumah pada akan di redirect ke index.php
  echo "<script>alert('Masukkan data id_rumah.');window.location='../crud_unit.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Edit Unit</title>
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
    <h1>Edit Unit <?php echo $data['tipe']; ?></h1>
    <center>
      <form method="POST" action="proses_edit.php" enctype="multipart/form-data">
        <section class="base">
          <!-- menampung nilai id_rumah produk yang akan di edit -->
          <input name="id_rumah" value="<?php echo $data['id_rumah']; ?>" hidden />
          <div>
            <label>Gambar Produk</label>
            <img src="gambar/<?php echo $data['gambar']; ?>"
              style="width: 120px;float: left;margin-bottom: 5px;">
            <input type="file" name="gambar" />
            <i style="float: left;font-size: 11px;color: red">Abaikan jika tidak merubah gambar produk</i>
          </div>
          <div>
            <label>Tipe</label>
            <input type="text" name="tipe" value="<?php echo $data['tipe']; ?>" autofocus=""
              required="" />
          </div>
          <div>
            <label>Luas Tanah</label>
            <input type="number" name="luas_tanah" min="0" value="<?php echo $data['luas_tanah']; ?>" />
          </div>
          <div>
            <label>Luas Bangunan</label>
            <input type="number" name="luas_bangunan" min="0" required="" value="<?php echo $data['luas_bangunan']; ?>" />
          </div>
          <div>
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" required="" value="<?php echo $data['deskripsi']; ?>" />
          </div>
          <div>
            <label>Harga</label>
            <input type="number" name="harga" min="0" required="" value="<?php echo $data['harga']; ?>" />
          </div>
          <div>
            <button type="submit">Simpan Perubahan</button>
          </div>
          <div class="listing-buttons">
          <a href="../crud_unit.php" class="btn btn-detail"><< Kembali</a>
        </div>
        </section>
      </form>
</body>
</html>