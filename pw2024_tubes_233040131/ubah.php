<?php
require 'function.php';

$id = $_GET["id"];
$mhs = query("SELECT * FROM table_motivasi WHERE id = $id")[0];

if (isset($_POST["ubah"])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('data berhasil diubah!');
                document.location.href = 'halamanadmin.php';
              </script>";
    } else {
        echo "<script>
                alert('data gagal diubah!');
                document.location.href = 'halamanadmin.php';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ubah Data Mahasiswa</title>
    <style>
        ul li {
            list-style: none;
        }
    </style>
</head>
<body>
    <h1>Ubah Data Motivasi</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $mhs["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?php echo $mhs["gambar"]; ?>">
        <ul>
            <li>
                <label for="judul">Judul : </label>
                <input type="text" name="judul" id="judul" value="<?php echo $mhs["judul"]; ?>">
            </li>
            <li>
                <label for="penulis">Penulis : </label>
                <input type="text" name="penulis" id="penulis" value="<?php echo $mhs["penulis"]; ?>">
            </li>
            <li>
                <label for="isi_motivasi">Motivasi : </label>
                <input type="text" name="isi_motivasi" id="isi_motivasi" value="<?php echo $mhs["isi_motivasi"]; ?>">
            </li>
            <li>
                <label for="tanggal_upload">Tanggal : </label>
                <input type="text" name="tanggal_upload" id="tanggal_upload" value="<?php echo $mhs["tanggal_upload"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="ubah">Ubah Data!</button>
            </li>
        </ul>
    </form>
</body>
</html>
