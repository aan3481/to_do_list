<?php
include 'konfig.php';

$title = $_POST['title'];
$status = $_POST['status'];

mysqli_query($koneksi, "INSERT INTO todolist VALUES(NULL, '$title', '$status')");

//Mengecek apakah ada nilai dengan nama jenis_kelamin yang dikirim dari form
if (isset($_POST['status'])) {

    $status = $_POST['status'];
    echo "<br>" . $status;
}


header("location: index.php");
