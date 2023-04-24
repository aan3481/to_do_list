<?php

$koneksi = mysqli_connect("localhost", "root", "", "to-do-list");

if (mysqli_connect_errno()) {
    echo "Koneksi gagal" . mysqli_connect_error();
}
