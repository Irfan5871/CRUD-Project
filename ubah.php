<?php 
session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

//ambil data di URL
$id = $_GET["id"];
// query data mahasiswa berdasarkan id nya
$krl = query("SELECT * FROM sorumkereta WHERE id = $id")[0];

//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])) {     

    //cek apakah data berhasil di ubah atau tidak
    if (ubah ($_POST) > 0 ) {
        echo "
        <script> 
            alert('data berhasil diubah');
            document.location.href= 'index.php';
        </script>
        ";
    }
    else {
        echo "<script> 
        alert('data gagal diubah');
        document.location.href= 'index.php';
    </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data kereta</title>
</head>
<body>
    <h1>Ubah data kereta</h1>

    
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$krl["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?=$krl["gambar"]; ?>">
        <ul>
            <li>
                <label for="jenis">Jenis</label>
                <input type="text" name="jenis" id="jenis" required value="<?= $krl["jenis"]; ?>">
            </li>
            <li>
                <label for="merek">Merek</label>
                <input type="text" name="merek" id="merek" value="<?= $krl["merek"]; ?>">
            </li>
            <li>
                <label for="warna">Warna</label>
                <input type="text" name="warna" id="warna" value="<?= $krl["warna"]; ?>">
            </li>
            <li>
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" value="<?= $krl["harga"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar</label>
                <img src="image/<?= $krl['gambar']; ?>" alt="" width="40">
                <input type="file" name="gambar" id="gambar" >
            </li>
            <li> 
                <button type="submit" name="submit">Ubah Data</button>
            </li>
        </ul>
    </form>
    
    <a href="index.php">Kembali ke tab</a>
</body>
</html>
