<?php
    include "../auth.php";
    include "../../db_connection.php"; 

    if (isset($_POST['submit_add'])) {
        add_hotel($connection, $_POST);
    }
    
    if (isset($_POST['submit_edit'])) {
        edit_hotel($connection, $_POST);
    }

    if (isset($_GET['submit_delete'])){
        delete_hotel($connection, $_GET);
    }

    function add_hotel($connection, $data){
        $hotel_name = $data['hotel_name'];
        $hotel_address = $data['hotel_address'];
        $hotel_description = $data['hotel_description'];

        // Insert to hotels table
        $queryInsert = "INSERT INTO hotels (hotel_name, hotel_address, hotel_description) VALUES ('$hotel_name','$hotel_address', '$hotel_description')";
        mysqli_query($connection, $queryInsert);

        // Get the inserted hotel ID
        $id_hotel = mysqli_insert_id($connection);

        upload_hotel_images($connection, $id_hotel, $_FILES);
    }

    function edit_hotel($connection, $data){
        $hotel_id = $data['hotel_id'];
        $hotel_name = $data['hotel_name'];
        $hotel_address = $data['hotel_address'];
        $hotel_description = $data['hotel_description'];

        // Update hotels table
        $query = "UPDATE hotels SET hotel_name='$hotel_name', hotel_address='$hotel_address', hotel_description='$hotel_description' WHERE id_hotel=$hotel_id";
        mysqli_query($connection, $query);

        // Delete Old Images
        if (!empty($_FILES['hotel_images']['name'][0])){
            delete_hotel_images($connection, $hotel_id);
        }

        upload_hotel_images($connection, $hotel_id, $_FILES);
    }

    function delete_hotel($connection, $data){
        $id = $data['id'];

        delete_hotel_images($connection, $id);
        mysqli_query($connection, "DELETE FROM rooms WHERE id_hotel=$id");
        mysqli_query($connection, "DELETE FROM hotel_images WHERE id_hotel=$id");
        mysqli_query($connection, "DELETE FROM hotels WHERE id_hotel=$id");
    }

    function upload_hotel_images($connection, $id_hotel, $data){
        // Insert to hotel_images table
        $target_dir = "../../uploads/";

        foreach ($data['hotel_images']['name'] as $key => $value) {
            if (!empty($data['hotel_images']['name'][$key])) {

                $file_name = basename($data['hotel_images']['name'][$key]);

                $target_file_path = $target_dir . $file_name;
                $db_file_path = 'http://localhost/Pemograman-Web' . '/uploads/' . $file_name;

                // Upload file
                if (move_uploaded_file($data['hotel_images']['tmp_name'][$key], $target_file_path)) {
                    // Insert to hotel_images table
                    $query = "INSERT INTO hotel_images (id_hotel, file_path) VALUES ('$id_hotel','$db_file_path')";
                    mysqli_query($connection, $query);
                } else {
                    echo "Error uploading file: " . $data['hotel_images']['name'][$key] . "<br>";
                }
            }
        }
    }

    function delete_hotel_images($connection, $id_hotel){
        // Get all images for that hotel
        $query = "SELECT file_path FROM hotel_images WHERE id_hotel = $id_hotel";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {

            $file_url = $row['file_path'];

            // Detect project root folder
            $project_folder = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0];

            // Convert URL to server path
            $server_path = str_replace(
                "http://localhost/Pemograman-Web/uploads",
                "../../uploads/",
                $file_url
            );

            // Delete file
            if (file_exists($server_path)) {
                unlink($server_path);
            }
        }

        mysqli_query($connection, "DELETE FROM hotel_images WHERE id_hotel=$id_hotel");
    }

    header("Location: index.php");
?>