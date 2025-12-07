<?php
    $host = "localhost";
    $user = "root";  // default laragon
    $pass = "";      // default kosong
    $db   = "hotel_reservation";
    $port = 3306;

    $connection = mysqli_connect($host, $user, $pass, $db);

    if (!$connection) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>
