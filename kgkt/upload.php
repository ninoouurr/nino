<?php
// Direktori sasaran untuk menyimpan fail yang dimuat naik
$target_dir = "uploads/";

// Cipta direktori 'uploads' jika belum wujud
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Senarai jenis fail yang dibenarkan
$allowedTypes = array("pdf", "docx", "png", "jpg", "jpeg");

// Semak jenis fail
if (!in_array($fileType, $allowedTypes)) {
    echo "Maaf, hanya fail PDF, DOCX, PNG, JPG, dan JPEG dibenarkan.";
    $uploadOk = 0;
}

// Semak jika fail sedia untuk dimuat naik
if ($uploadOk == 1) {
    // Penamaan fail unik untuk mengelakkan konflik
    $newFileName = uniqid() . '.' . $fileType;
    $finalPath = $target_dir . $newFileName;

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $finalPath)) {
        echo "Fail ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " berjaya dimuat naik.";
        
        // Sambungan ke pangkalan data
        $conn = new mysqli("localhost", "root", "", "kgkt");

        // Semak sambungan
        if ($conn->connect_error) {
            die("Sambungan gagal: " . $conn->connect_error);
        }

        // Masukkan maklumat fail ke dalam pangkalan data
        $stmt = $conn->prepare("INSERT INTO documents (filename, filepath) VALUES (?, ?)");
        $stmt->bind_param("ss", $newFileName, $finalPath);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        echo "<br><a href='index.php'>Muat Naik Lagi</a>";
        echo "<br><a href='list.php'>Lihat Senarai Dokumen</a>";
    } else {
        echo "Maaf, terdapat ralat semasa memuat naik fail anda.";
    }
}
?>
