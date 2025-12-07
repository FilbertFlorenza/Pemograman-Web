<?php
include '../auth.php';
include "../../db_connection.php";
$id = $_GET['id'];

// Get all images for that hotel
$query = "SELECT file_path FROM room_images WHERE id_room = $id";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) {

    $file_url = $row['file_path'];

    // Detect project root folder
    $project_folder = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0];

    // Convert URL to server path
    $server_path = str_replace(
        "http://{$_SERVER['HTTP_HOST']}/" . $project_folder . "/uploads/",
        "../../uploads/",
        $file_url
    );

    // Delete file
    if (file_exists($server_path)) {
        unlink($server_path);
    }
}

mysqli_query($connection, "DELETE FROM room_images WHERE id_room=$id");
mysqli_query($connection, "DELETE FROM rooms WHERE id_room=$id");
header("Location: index.php");
?>
