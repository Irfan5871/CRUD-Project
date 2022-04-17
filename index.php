<?php
session_start();
 if( !isset($_SESSION["login"]) ) {
     header("Location: login.php");
     exit;
 } 
require "functions.php";
$krt = query ("SELECT * FROM sorumkereta ");

if( isset($_POST["cari"]) ) {
    $krt = cari($_POST["keyword"]);    
}
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .loader {
            width : 96px;
            position: absolute;
            top : 106px;
            left: 140px;
            z-index: -1;
            display : none;
        }
        @media print {
            .logout, .tambah, .form-cari, .aksi {
                display: none;
            }
           
            
        }
    </style>

</head>
<body>
    <a href="logout.php" class="logout">Logout</a> | <a href="cetak.php" target="_blank">cetak</a>
    <h1>Sorum Kereta</h1>
    <a href="tambah.php" class="tambah">Tambah data kereta</a>
    <br><br>
    
    <form action="" method="post" class="form-cari">
    <input type="text" name="keyword" autofocus="" placeholder="Masukkan keyword pencarian" autocomplete="off" id="keyword">
    <button type="submit" name="cari" id="tombol-cari">Cari</button>
    <img src="image/loading-slow-internet.gif" class="loader">

    </form>

    <div id="container">
    <table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th class="aksi">Aksi</th>
        <th>Gambar</th>
        <th>Jenis</th>
        <th>Merek</th>
        <th>Warna</th>
        <th>Harga</th>

    </tr> 
    <?php $i = 1; ?>
    <?php foreach ($krt as $kereta) : ?>
    <tr>
        <td><?= $i;?></td>
        <td class="aksi">
            <a href="ubah.php?id=<?= $kereta["id"] ?>">Ubah</a> |  
            <a href="hapus.php?id=<?= $kereta["id"]; ?>" onclick="return confirm('yakin?'); ">Hapus </a>
        </td>
        <td><img src="image/<?= $kereta["gambar"] ?>" width="100px" ></td>
        <td><?= $kereta["jenis"] ?></td>
        <td><?= $kereta["merek"] ?></td>
        <td><?= $kereta["warna"] ?> </td>
        <td><?= $kereta["harga"] ?></td>
        
</tr>
<?php $i++; ?>
    <?php endforeach; ?>

    </table>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
