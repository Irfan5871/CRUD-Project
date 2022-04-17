<?php
//koneksi ke database 
$conn = mysqli_connect("localhost","root", "","phpdasar");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $keretas = [];
    while($kereta = mysqli_fetch_assoc($result) ) {
        $keretas[] = $kereta;
    }
    return $keretas;
}

function tambah($data) {
    global $conn;

    $jenis = htmlspecialchars( $data["jenis"]);
    $merek = htmlspecialchars( $data["merek"]);
    $warna = htmlspecialchars( $data["warna"]);
    $harga = htmlspecialchars( $data["harga"]);
    
    //upload gambar 
    $gambar = upload();
    if ( !$gambar ) {
        return false;
    }


    $query = "INSERT INTO sorumkereta VALUES ('', '$jenis', '$merek', '$warna', '$harga', '$gambar' ) ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    if ($error === 4 ) {
        echo "<script> 
                alert('pilih gambar terlebih dahulu');
            </script>";
            return false;
    }
    // cek apakah yang di upload gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $eksetensiGambar = explode('.', $namaFile);
    $eksetensiGambar = strtolower(end($eksetensiGambar));
    if( !in_array($eksetensiGambar, $ekstensiGambarValid) ) {
        echo " <script>
            alert('yang anda upload bukan gambar');
        </script>
        
        ";
        return false;
    }
    //cek apakah ukurannya terlalu besar
    if( $ukuranFile > 1000000) {
        echo " <script>
        alert('ukuran gambar terlalu besar');
    </script>
    
    ";
    return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $eksetensiGambar;
    move_uploaded_file($tmpName, 'image/' . $namaFile);
    return $namaFile;
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM sorumkereta WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    $id = $data["id"];
    $jenis = htmlspecialchars( $data["jenis"]);
    $merek = htmlspecialchars( $data["merek"]);
    $warna = htmlspecialchars( $data["warna"]);
    $harga = htmlspecialchars( $data["harga"]);
    $gambarLama = htmlspecialchars( $data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak 
    if($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }




    $query = "UPDATE sorumkereta SET jenis = '$jenis', merek = '$merek', warna = '$warna', harga = '$harga', gambar = '$gambar' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM sorumkereta
                    WHERE 
             jenis  LIKE '%$keyword%' OR
             merek LIKE '%$keyword%' OR
             warna LIKE '%$keyword%' OR
             harga LIKE '%$keyword%'  ";
        return query($query);
}

function registrasi($data) {
    global $conn;

    $username = strtolower( stripslashes( $data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if( mysqli_fetch_assoc($result)) {
        echo "<script> 
                alert('username sudah terdaftar');
                </script>";
                return false;
    }

    //cek konfirmasi password
    if( $password !== $password2) {
        echo " <script>
                alert('Konfirmasi password tidak sesuai');
            </script>
        ";
        return false;
    }
//enkripsi password
$password = password_hash($password, PASSWORD_DEFAULT);


// tambahkan user baru ke data base
mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
return mysqli_affected_rows($conn);
}

?> 