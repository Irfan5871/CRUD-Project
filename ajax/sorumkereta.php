<?php
require '../functions.php';

$keyword = $_GET['keyword'];
$query = "SELECT * FROM sorumkereta
                    WHERE 
             jenis  LIKE '%$keyword%' OR
             merek LIKE '%$keyword%' OR
             warna LIKE '%$keyword%' OR
             harga LIKE '%$keyword%'  ";
        
$krt = query($query);

?>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Aksi</th>
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
        <td>
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