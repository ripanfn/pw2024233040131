<?php
require 'function.php';
$motivasi = query("SELECT * FROM table_motivasi");

if (isset($_POST['cari'])) {
    $motivasi = cari($_POST['keyword']);
}
?>

 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>
    <h1>Daftar Motivasi</h1>
    <form action="" method="post">
        <input class="search-input" type="text" name="keyword" size="40" autofocus="" placeholder="masukan keyword pencarian" autocomplete="off">
        <button class="search-button" type="submit" name="cari">Cari!</button>
    </form>

    <a href="tambah.php">Tambah Data</a>
    <a href="index.php">Beranda</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Motivasi</th>
            <th>Tanggal</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>

        <?php if(empty($motivasi)) : ?>
        <tr>
            <td colspan="4"><p style="color: yellow; font-style:italic">Data Motivasi Tidak Ditemukan</p></td>
        </tr>
        <?php endif; ?>

        <?php $i = 1; ?>
        <?php foreach ($motivasi as $row) : ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($row["judul"]); ?></td>
                <td><?php echo htmlspecialchars($row["penulis"]); ?></td>
                <td><?php echo htmlspecialchars($row["isi_motivasi"]); ?></td>
                <td><?php echo htmlspecialchars($row["tanggal_upload"]); ?></td>
                <td>
                    <?php if ($row["gambar"]) : ?>
                        <img src="img/<?php echo htmlspecialchars($row["gambar"]); ?>" width="100" alt="<?php echo htmlspecialchars($row["judul"]); ?>">
                    <?php else : ?>
                        Gambar tidak tersedia
                    <?php endif; ?>
                </td>
                <td>
                    <a href="ubah.php?id=<?php echo $row['id']; ?>">Ubah</a> |
                    <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin dihapus?');">Hapus</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>

</html>