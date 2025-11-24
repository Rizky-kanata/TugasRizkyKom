<?php
include 'config.php';

// Query untuk mengambil semua data
$sql = "SELECT * FROM transaksi ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Keuangan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Manajemen Keuangan: Pengeluaran & Pemasukan</h1>
        
        <div class="header-actions">
            <a href="create.php" class="btn btn-primary">+ Tambah Transaksi</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th>Nominal (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . date('d/m/Y', strtotime($row['tanggal_transaksi'])) . "</td>";
                        echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                        echo "<td>" . htmlspecialchars(ucfirst($row['jenis'])) . "</td>";
                        echo "<td>" . number_format($row['nominal'], 0, ',', '.') . "</td>";
                        echo "<td class='action-buttons'>
                                <a href='edit.php?id=" . $row['id'] . "' class='btn btn-edit'>Edit</a>
                                <a href='delete.php?id=" . $row['id'] . "' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
