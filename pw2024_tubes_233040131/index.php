<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

require 'function.php';

$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $table_motivasi = query("SELECT * FROM table_motivasi WHERE judul LIKE '%$search%' OR penulis LIKE '%$search%' OR isi_motivasi LIKE '%$search%'");
} else {
    $table_motivasi = query("SELECT * FROM table_motivasi");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>news</title>
    <!-- My Style -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        
        <img src="assets/img/logoo.jpeg" alt="Motivasi Sang Ripan" class="logo">
        <form method="post" action="">
            <input type="text" name="search" placeholder="Cari motivasi..." value="<?= htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
        <nav>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="#motivasi">Daftar Motivasi</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="halamanadmin.php">Halaman</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="hero">
            <img src="assets/img/sangripan.JPG" alt="Sang Ripan">
            <div class="hero-text">
                <h1>Ayo Baca Motivasi Dari Sang Ripan</h1>
                <p>Sang Ripan , S.T., M.Si.<br>Ketua Decul Indonesia</p>
            </div>
        </section>

        <div class="container">
            <div class="card">
                <h3>Motivasi Kemarin</h3>
                <p>Temukan ribuan konten pembelajaran dalam berbagai bentuk, mulai dari video, audio, artikel, games,...</p>
            </div>
            <div class="card upcoming">
                <h3>Motivasi Hari Ini</h3>
                <p>Sebuah Learning Management System (LMS) yang dikembangkan khusus untuk memfasilitasi proses...</p>
            </div>
            <div class="card upcoming">
                <h3>Motivasi Hari Besok</h3>
                <p>Hari besok adalah hari yang</p>
            </div>
        </div>
    </main>

    <section class="hero">
        <div class="hero-content">
            <h1>Ayo Baca Motivasi Dari Sang Ripan</h1>
            <p>Sang Ripan , S.T., M.Si. <br> Ketua Decul Indonesia</p>
        </div>
    </section>

    <!-- Add Search Form -->
    

    <section class="cards" id="motivasi">
        <?php if (!empty($table_motivasi)): ?>
            <?php foreach ($table_motivasi as $row) : ?>
                <div class="card">
                    <div class="img-box">
                        <img src="img/<?= htmlspecialchars($row["gambar"]); ?>" alt="">
                    </div>
                    <h2><?= htmlspecialchars($row["judul"]); ?></h2>
                    <p><?= htmlspecialchars($row["penulis"]); ?></p>
                    <p><?= htmlspecialchars($row["isi_motivasi"]); ?></p>
                    <p><?= htmlspecialchars($row["tanggal_upload"]); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No motivasi found.</p>
        <?php endif; ?>
    </section>

    <footer>
        <div class="footer-content">
            <div class="address">
                <img src="assets/img/logoo.jpeg" alt="Motivasi Sang Ripan">
                <p>Jl.Cipedes Tengah Kosan Ripan <br> Kec. Sukajadi Kota Bandung, Jawa Barat 15411</p>
            </div>
            <div class="menu">
                <h3>Menu</h3>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Daftar Motivasi</a></li>
                </ul>
            </div>
            <div class="social-media">
                <h3>Media Sosial Kami</h3>
                <ul>
                    <li><a href="https://www.instagram.com/ripanfn?igsh=MWszMWRsMW9yM3BjYQ%3D%3D&utm_source=qr">Instagram</a></li>
                </ul>
            </div>
        </div>
        <p>&copy; Copyright Motivasi Sang Ripan 2024 <br> All Rights Reserved</p>
    </footer>
</body>

</html>
