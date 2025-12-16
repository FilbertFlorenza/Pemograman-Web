<?php
    include "../auth.php";
    include "../../db_connection.php"; 
    
    function base_url(){
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
        $project_folder = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0];
        $base_url = $protocol . $_SERVER['HTTP_HOST'] . '/' . $project_folder . '/uploads/'; 

        return $base_url;
    }

    function upload_room_images($connection, $id_room){
        // Insert to room_images table
        $target_dir = "../../uploads/";

        if (!empty($_FILES['room_images']['name'])) {

            $file_name = time() . "_" . basename($_FILES['room_images']['name']);

            $target_file_path = $target_dir . $file_name;
            $db_file_path = base_url() . $file_name;

            // Upload file
            if (move_uploaded_file($_FILES['room_images']['tmp_name'], $target_file_path)) {
                // Insert to room_images table
                
                $query = "INSERT INTO room_images (id_room, file_path) VALUES ('$id_room','$db_file_path')";
                mysqli_query($connection, $query);
            } else {
                echo "Error uploading file: " . $_FILES['room_images']['name'] . "<br>";
            }
        }
        
    }

    function delete_room_images($connection, $id_room){
        // Get all images for that room
        $query = "SELECT file_path FROM room_images WHERE id_room = $id_room";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $file_url = $row['file_path'];
            $project_folder = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0];

            // Convert URL to server path
            $server_path = str_replace(
                base_url(),
                "../../uploads/",
                $file_url
            );

            // Delete file
            if (file_exists($server_path)) {
                unlink($server_path);
            }
        }
        mysqli_query($connection, "DELETE FROM room_images WHERE id_room=$id_room");
    }

    if (isset($_POST['submit_add'])) {
        $hotel = $_POST['hotel'];
        $room_name = $_POST['room_name'];
        $room_description = $_POST['room_description'];
        $price_per_night = $_POST['price_per_night'];
        
        // Insert to rooms table
        $query = "INSERT INTO rooms (id_hotel, room_name, room_description, price_per_night, status) VALUES ('$hotel','$room_name', '$room_description', '$price_per_night', 'Available')";
        mysqli_query($connection, $query);

        // Get the inserted hotel ID
        $id_room = mysqli_insert_id($connection);

        upload_room_images($connection, $id_room);

        $_SESSION['message'] = "Room added successfully!";
        $_SESSION['message_type'] = "success";
    }

    if (isset($_POST['submit_edit'])) {
        $id = $_POST['id_room'];
        $hotel = $_POST['hotel'];
        $room_name = $_POST['room_name'];
        $room_description = $_POST['room_description'];
        $price_per_night = $_POST['price_per_night'];
        
        // Update rooms table
        $query = "UPDATE rooms SET id_hotel='$hotel' , room_name = '$room_name', room_description = '$room_description', price_per_night='$price_per_night' WHERE id_room=$id";
        mysqli_query($connection, $query);

        // Delete Old Images
        if (!empty($_FILES['room_images']['name'][0])){
            delete_room_images($connection, $id);
            upload_room_images($connection, $id);
        }

        $_SESSION['message'] = "Room updated successfully!";
        $_SESSION['message_type'] = "success";
    }

    if (isset($_GET['delete'])){
        $id = $_GET['id'];
        delete_room_images($connection, $id);
        mysqli_query($connection, "DELETE FROM rooms WHERE id_room=$id");

        $_SESSION['message'] = "Room deleted successfully!";
        $_SESSION['message_type'] = "danger";
    }

    header("Location: index.php");
?>