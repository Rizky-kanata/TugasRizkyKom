<?php
include 'config.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal_transaksi']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $jenis = mysqli_real_escape_string($conn, $_POST['jenis']);
    $nominal = mysqli_real_escape_string($conn, $_POST['nominal']);

    $sql = "UPDATE transaksi SET tanggal_transaksi='$tanggal', keterangan='$keterangan',
            jenis='$jenis', nominal='$nominal' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM transaksi WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Transaksi</h1>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label>Tanggal:</label>
                <input type="date" name="tanggal_transaksi" value="<?php echo $row['tanggal_transaksi']; ?>" required>
            </div>
            <div class="form-group">
                <label>Keterangan:</label>
                <input type="text" name="keterangan" value="<?php echo htmlspecialchars($row['keterangan']); ?>" required>
            </div>
            <div class="form-group">
                <label>Jenis:</label>
                <select name="jenis" required>
                    <option value="">-- Pilih --</option>
                    <option value="pemasukan" <?php if($row['jenis'] == "pemasukan") echo "selected"; ?>>Pemasukan</option>
                    <option value="pengeluaran" <?php if($row['jenis'] == "pengeluaran") echo "selected"; ?>>Pengeluaran</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nominal (Rp):</label>
                <input type="number" name="nominal" min="0" value="<?php echo $row['nominal']; ?>" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
