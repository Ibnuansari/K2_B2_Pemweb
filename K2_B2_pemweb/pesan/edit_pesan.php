<?php
  // memanggil file koneksi.php untuk membuat koneksi
  include '../koneksi.php';

  // mengecek apakah di url ada nilai GET id
  if (isset($_GET['id'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id = ($_GET["id"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM pesan WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    
    // jika data gagal diambil maka akan tampil error berikut
    if(!$result){
      die ("Query Error: ".mysqli_errno($koneksi).
        " - ".mysqli_error($koneksi));
    }
    
    // mengambil data dari database
    $data = mysqli_fetch_assoc($result);
      // apabila data tidak ada pada database maka akan dijalankan perintah ini
      if (!count($data)) {
        echo "<script>alert('Data tidak ditemukan pada database');window.location='../crud_pesan.php';</script>";
      }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='../crud_pesan.php';</script>";
  }         
  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Edit Pesan</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      
      h1 {
        text-transform: uppercase;
        color: #FFA500;
      }
      
      button {
        background-color: #FFA500;
        color: white;
        padding: 10px;
        text-decoration: none;
        font-size: 12px;
        border-radius: 4px;
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
        outline-color: #ffc107;
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
        background-color: #FFA500;
        color: white;
        margin-right: 10px;
      }
    </style>
  </head>
  <body>
      <center>
        <h1>Edit Pesan <?php echo $data['nama']; ?></h1>
      <center>
      <form method="POST" action="proses_edit.php" enctype="multipart/form-data" >
      <section class="base">
        <!-- menampung nilai id produk yang akan di edit -->
        <input name="id" value="<?php echo $data['id']; ?>"  hidden />
        <div>
          <label>Nama</label>
          <input type="text" name="nama" value="<?php echo $data['nama']; ?>" autofocus="" required="" />
        </div>
        <div>
          <label>Ponsel</label>
          <input type="tel" name="ponsel" required="" value="<?php echo $data['ponsel']; ?>"/>
        </div>
        <div>
          <label>email</label>
          <input type="email" name="email" value="<?php echo $data['email']; ?>" />
        </div>
        <label>Perihal</label>
        <div class="form-group" align="left">
            <select name="perihal" required>
                <option value="">Perihal</option>
                <option value="Info Rumah" <?php echo ($data['perihal'] == 'Info Rumah') ? 'selected' : ''; ?>>Info Rumah</option>
                <option value="Booking Rumah" <?php echo ($data['perihal'] == 'Booking Rumah') ? 'selected' : ''; ?>>Booking Rumah</option>
                <option value="Jadwal Kunjungan" <?php echo ($data['perihal'] == 'Jadwal Kunjungan') ? 'selected' : ''; ?>>Jadwal Kunjungan</option>
            </select>
        </div>
        <div>
          <label>Pesan</label>
          <input type="text" name="pesan" value="<?php echo $data['pesan']; ?>" />
        </div>
        <div>
          <button type="submit">Simpan Perubahan</button>
        </div>

        <div class="listing-buttons">
          <a href="../crud_pesan.php" class="btn btn-detail"><< Kembali</a>
        </div>
        </section>
      </form>   
  </body>
</html>