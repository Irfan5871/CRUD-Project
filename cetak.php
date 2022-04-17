<?php

require_once __DIR__ . '/vendor/autoload.php';

require "functions.php";
$krt = query ("SELECT * FROM sorumkereta ");

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <h1>Sorum Kereta </h1>
    <table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Gambar</th>
        <th>Jenis</th>
        <th>Merek</th>
        <th>Warna</th>
        <th>Harga</th>

    </tr>';
    $i = 1;
    foreach ( $krt as $kereta ) {
        $html .= '<tr>
            <td>'. $i++ .'</td>
            <td><img src="image/'. $kereta["gambar"] .'" width="100px" ></td>
            <td>'. $kereta["jenis"] .'</td>
            <td>'. $kereta["merek"] .'</td>
            <td>'. $kereta["warna"] .'</td>
            <td>'. $kereta["harga"] .'</td>
        </tr>';
    }
    
 $html .= '</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('daftar-sorumkereta.pdf', 'I');

?>
