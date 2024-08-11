<!DOCTYPE html>
<html>
<head>
    <title>Muat Naik Dokumen</title>
</head>
<body>
    <h2>Muat Naik Dokumen</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Pilih dokumen untuk dimuat naik:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br><br>
        <input type="submit" value="Muat Naik Dokumen" name="submit">
    </form>
    <br>
    <a href="list.php">Lihat Dokumen yang Dimuat Naik</a>
</body>
</html>
