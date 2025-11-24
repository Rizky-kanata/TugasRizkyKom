<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal_transaksi']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $jenis = mysqli_real_escape_string($conn, $_POST['jenis']);
    $nominal = mysqli_real_escape_string($conn, $_POST['nominal']);

    $sql = "INSERT INTO transaksi (tanggal_transaksi, keterangan, jenis, nominal)
            VALUES ('$tanggal', '$keterangan', '$jenis', '$nominal')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Transaksi</h1>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label>Tanggal:</label>
                <input type="date" name="tanggal_transaksi" required>
            </div>
            <div class="form-group">
                <label>Keterangan:</label>
                <input type="text" name="keterangan" required>
            </div>
            <div class="form-group">
                <label>Jenis:</label>
                <select name="jenis" required>
                    <option value="">-- Pilih --</option>
                    <option value="pemasukan">Pemasukan</option>
                    <option value="pengeluaran">Pengeluaran</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nominal (Rp):</label>
                <input type="number" name="nominal" min="0" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
