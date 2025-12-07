<?php
    if (isset($_POST['submit_add'])) {
        $hotel = $_POST['hotel'];
        $room_name = $_POST['room_name'];
        $price_per_night = $_POST['price_per_night'];
        
        // Insert to rooms table
        $query = "INSERT INTO rooms (id_hotel, room_name, price_per_night, status) VALUES ('$hotel','$room_name', '$price_per_night', 'Available')";
        mysqli_query($connection, $query);

        // Get the inserted hotel ID
        $id_room = mysqli_insert_id($connection);

        // Insert to room_images table
        $target_dir = "../../uploads/";
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
        $project_folder = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'))[0];
        $base_url = $protocol . $_SERVER['HTTP_HOST'] . '/' . $project_folder . '/uploads/'; 

        foreach ($_FILES['room_images']['name'] as $key => $value) {
            if (!empty($_FILES['room_images']['name'][$key])) {

                $file_name = time() . "_" . basename($_FILES['room_images']['name'][$key]);

                $target_file_path = $target_dir . $file_name;
                $db_file_path = $base_url . $file_name;

                $file_type = strtolower(pathinfo($target_file_path, PATHINFO_EXTENSION));

                // Upload file
                if (move_uploaded_file($_FILES['room_images']['tmp_name'][$key], $target_file_path)) {
                    // Insert to room_images table
                    $query = "INSERT INTO room_images (id_room, file_path) VALUES ('$id_room','$db_file_path')";
                    mysqli_query($connection, $query);
                } else {
                    echo "Error uploading file: " . $_FILES['room_images']['name'][$key] . "<br>";
                }
            }
        }

        header("Location: index.php");
    }
?>