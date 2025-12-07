<?php 
    include '../auth.php';
    include "../../db_connection.php"; 
    $id = $_GET['id'];
    $result = mysqli_query($connection, "SELECT * FROM hotels");
    $data_room = mysqli_query($connection, "SELECT * FROM rooms WHERE id_room=$id");
    $data_room = mysqli_fetch_assoc($data_room);

    if (isset($_POST['submit'])) {
        $hotel = $_POST['hotel'];
        $room_name = $_POST['room_name'];
        $price_per_night = $_POST['price_per_night'];
        
        // Update rooms table
        $query = "UPDATE rooms SET id_hotel='$hotel' , room_name = '$room_name', price_per_night='$price_per_night' WHERE id_room=$id";
        mysqli_query($connection, $query);

        // Get all images for that room
        $query = "SELECT file_path FROM room_images WHERE id_room = $id";
        $result = mysqli_query($connection, $query);

        // Delete Old Images
        if (!empty($_FILES['room_images']['name'][0])){
            while ($row = mysqli_fetch_assoc($result)) {
                $file_url = $row['file_path'];
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
        }

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
                    $query = "INSERT INTO room_images (id_room, file_path) VALUES ('$id','$db_file_path')";
                    mysqli_query($connection, $query);
                } else {
                    echo "Error uploading file: " . $_FILES['room_images']['name'][$key] . "<br>";
                }
            }
        }

        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        #navbar{
            display: flex; 
            align-items: center; 
            justify-content: space-evenly; 
            background-color: #8f8e8e;
        }

        #signature{
            color:#ffffff;
        }
        .menu,.content{
            padding: 20px;
        }

        .list{
            color: #ffffffff;
            list-style: none;
        }

        .content h2,p{
            color: #ffffffff;
        }

        .content{
            background-color:#545454;
        }

        .menu-button{
            background-color: transparent;
            color: white;
            border: 1px solid white;
            font-size: 20px;
            width: 100%;
        }

        form input,.col-form-label{
            color: white;
        }

        #footer{
            background-color: #8f8e8e;
            padding: 30px;
        }
    </style>
    <title>Hotels</title>
</head>
<body style="width: 100%; margin: 0; font-family: 'Alice';">
    <div id="signature" class="row">
        <div id="navbar">
            <center>
            <h1>CheezU</h1>
            </center>
        </div>
    </div>
    
    <div class="vh-100" style="display: flex;">
        <div class="menu col-3" style="background-color: #686868; position: relative;">
            <center>
                <div class="d-flex flex-column gap-3">
                   <a href="http://localhost/projek_web/admin/hotels">
                        <button class="menu-button">
                            Hotel
                        </button>
                    </a>
                    <a href="http://localhost/projek_web/admin/rooms">
                        <button class="menu-button">
                            Room Types
                        </button>
                    </a>
                    <a href="http://localhost/projek_web/admin/logout.php">
                        <button class="menu-button">
                            Logout
                        </button>
                    </a>
                </div>
            </center>
            <div id="menu-logo">
                <div style="text-align: center;">
                    <h1>CheezU</h1>
                </div>
            </div>
            
        </div>
        <div class="content col-9"  >
            <div class="row p-3">
                <h2>Edit Room</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group row my-2">
                        <label for="room_name" class="col-2 col-form-label">Hotel</label>
                        <div class="col-10">
                            <select class="form-control" name="hotel">
                                <option value="" selected>Select Hotel</option>
                                <?php
                                $i = 1;
                                while($row = mysqli_fetch_assoc($result)){ ?>
                                    <option value="<?php echo $row['id_hotel'] ?>" <?php if($row['id_hotel'] == $data_room['id_hotel']) echo 'selected';?>>
                                        <?php echo $row['hotel_name'] ?>
                                    </option>
                                <?php $i++;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row my-2">
                        <label for="room_name" class="col-2 col-form-label">Room Name</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo $data_room['room_name'];?>">
                        </div>
                    </div>
                    <div class="form-group row my-2">
                        <label for="price_per_night" class="col-2 col-form-label">Price per Night</label>
                        <div class="col-10">
                            <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="<?php echo $data_room['price_per_night']?>">
                        </div>
                    </div>
                    <div class="form-group row my-2">
                        <label for="room_images" class="col-2 col-form-label">Room Images</label>
                        <div class="col-10">
                            <input type="file" class="form-control-file" id="room_images" name="room_images[]" accept="image/*" multiple>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-dark mb-2">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div id="footer">
        <p style="margin: 0; text-align: center;">
           © 2025 CheezU <br />
           All rights reserved.
        </p>
    </div>
</body>
</html>