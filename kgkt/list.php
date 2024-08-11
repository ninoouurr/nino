<!DOCTYPE html>
<html>
<head>
    <title>Senarai Dokumen</title>
</head>
<body>
    <h2>Senarai Dokumen yang Dimuat Naik</h2>
    <?php
    // Sambungan ke pangkalan data
    $conn = new mysqli("localhost", "root", "", "kgkt");

    // Semak sambungan
    if ($conn->connect_error) {
        die("Sambungan gagal: " . $conn->connect_error);
    }

    $sql = "SELECT id, filename, filepath, uploaded_at FROM documents ORDER BY uploaded_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Nama Fail</th><th>Tarikh Muat Naik</th><th>Tindakan</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["filename"] . "</td>";
            echo "<td>" . $row["uploaded_at"] . "</td>";
            echo "<td><a href='view.php?id=" . $row["id"] . "' target='_blank'>Lihat</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tiada dokumen tersedia.";
    }
    $conn->close();
    ?>
    <br>
    <a href="index.php">Kembali ke Halaman Muat Naik</a>
</body>
</html>
