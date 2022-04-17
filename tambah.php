<?php 
session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])) {
    //cek apakah data berhasil di tamahkan atau tidak
    if (tambah ($_POST) > 0 ) {
        echo "
        <script> 
            alert('data berhasil ditambahkan');
            document.location.href= 'index.php';
        </script>
        ";
    }
    else {
        echo "<script> 
        alert('data gagal ditambahkan');
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
    <h1>Tambah data kereta</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="jenis">Jenis</label>
                <input type="text" name="jenis" id="jenis" required>
            </li>
            <li>
                <label for="merek">Merek</label>
                <input type="text" name="merek" id="merek" required>
            </li>
            <li>
                <label for="warna">Warna</label>
                <input type="text" name="warna" id="warna" required>
            </li>
            <li>
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" required>
            </li>
            <li>
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li> 
                <button type="submit" name="submit">Kirim Data</button>
            </li>
        </ul>
    </form>
    <a href="index.php">Kembali ke tab</a>
</body>
</html>
