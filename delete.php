<?php

include 'konfig.php';
$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM todolist WHERE id = '$id'");

header("Location: index.php");
