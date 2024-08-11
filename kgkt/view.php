<?php
// Semak jika parameter 'id' wujud dalam URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Sambungan ke pangkalan data
    $conn = new mysqli("localhost", "root", "", "kgkt");

    // Semak sambungan
    if ($conn->connect_error) {
        die("Sambungan gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT filename, filepath FROM documents WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($filename, $filepath);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    if (file_exists($filepath)) {
        $fileType = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));

        // Tentukan sama ada fail boleh dipaparkan dalam iframe
        $displayableTypes = array("pdf", "png", "jpg", "jpeg");
        
        echo "<h2>$filename</h2>";

        if (in_array($fileType, $displayableTypes)) {
            echo "<iframe src='$filepath' width='100%' height='600px'></iframe>";
        } else {
            echo "Pratonton tidak tersedia untuk jenis fail ini. <a href='$filepath'>Muat Turun</a>";
        }
    } else {
        echo "Fail tidak ditemui.";
    }
} else {
    echo "ID dokumen tidak ditentukan.";
}
?>
<br>
<a href="list.php">Kembali ke Senarai Dokumen</a>
