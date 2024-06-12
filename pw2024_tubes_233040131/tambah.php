<?php
require 'function.php';

if (isset($_POST['submit'])) {
    if(tambah($_POST) > 0) {
        echo "<script>
            alert('data berhasil ditambahkan!');
            document.location.href = 'halamanadmin.php';
            </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Motivasi</title>
    <link rel="stylesheet" href="assets/css/tambah.css">
</head>

<body>
    <h1>Tambah Data Motivasi</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="judul">judul :</label>
                <input type="text" name="judul" id="judul" required>
            </li>
            <li>
                <label for="penulis">penulis :</label>
                <input type="text" name="penulis" id="penulis" required>
            </li>
            <li>
                <label for="isi_motivasi">motivasi :</label>
                <input type="text" name="isi_motivasi" id="isi_motivasi" required>
            </li>
            <li>
                <label for="tanggal_upload">tanggal : :</label>
                <input type="text" name="tanggal_upload" id="tanggal_upload" required>
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="file" name="gambar" id="gambar" accept="image/*" required>
            </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>

        </ul>
    </form>



</body>

</html>