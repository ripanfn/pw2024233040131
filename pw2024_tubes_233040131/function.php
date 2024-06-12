<?php
$koneksi = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040131");

// read
function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// registrasi
function register($data) {
    global $koneksi;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    $password2 = mysqli_real_escape_string($koneksi, $data['password2']);

    // cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar');
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak benar!');
            </script>";
        return false;
    }

    // enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($koneksi, "INSERT INTO user VALUES(null, '$username', '$password')");

    return mysqli_affected_rows($koneksi);
}

// ambil data dari tiap elemen dalam form
function tambah($data) {
    global $koneksi;

    $judul = htmlspecialchars($data["judul"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $motivasi = htmlspecialchars($data["isi_motivasi"]);
    $tanggal = htmlspecialchars($data["tanggal_upload"]);
    
    // Proses upload gambar
    $gambar = uploadGambar();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO table_motivasi
              VALUES
              (null, '$judul', '$penulis', '$motivasi', '$tanggal', '$gambar')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function uploadGambar() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // Cek ekstensi gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    // Cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 5000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    // Generate nama baru untuk gambar
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.' . $ekstensiGambar;

    // Pindahkan file ke folder img
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM table_motivasi WHERE id=$id");
    return mysqli_affected_rows($koneksi);
}

function ubah($data) {
    global $koneksi;

    $id = $data["id"];
    $judul = htmlspecialchars($data["judul"] ?? '');
    $penulis = htmlspecialchars($data["penulis"] ?? '');
    $isi_motivasi = htmlspecialchars($data["isi_motivasi"] ?? '');
    $tanggal_upload = htmlspecialchars($data["tanggal_upload"] ?? '');
    $gambarLama = htmlspecialchars($data["gambarLama"] ?? '');

    // Cek apakah user upload gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadGambar();
        if (!$gambar) {
            return false;
        }
    }

    $query = "UPDATE table_motivasi SET
              judul = '$judul',
              penulis = '$penulis',
              isi_motivasi = '$isi_motivasi',
              tanggal_upload = '$tanggal_upload',
              gambar = '$gambar'
              WHERE id = $id";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function cari($keyword) {
    $query = "SELECT * FROM table_motivasi
                WHERE
                judul LIKE '%$keyword%' OR
                penulis LIKE '%$keyword%' OR
                isi_motivasi LIKE '%$keyword%' OR
                tanggal_upload LIKE '%$keyword%'                
                ";
    return query($query);
}
?>
