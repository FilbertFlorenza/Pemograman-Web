<?php
    include '../auth.php';
    include '../../db_connection.php';
    $result = mysqli_query($connection, "SELECT * FROM hotels");
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
            <div class="row">
                <div class="col-12 p-3 d-flex justify-content-between">
                    <h2>Hotels List</h2>
                    <a href="add.php">
                        <button>Add Hotel</button>
                    </a>
                </div>
                <div class="col-12 px-3">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Hotel Name</th>
                                <th scope="col">Hotel Address</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr>
                                        <th scope=\"row\">{$i}</th>
                                        <td>{$row['hotel_name']}</td>
                                        <td>{$row['hotel_address']}</td>
                                        <td>
                                            <a href='edit.php?id={$row['id_hotel']}'>Edit</a> | 
                                            <a href='process.php?id={$row['id_hotel']}&submit_delete=1'>Delete</a>
                                        </td>
                                    </tr>";
                            $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>     
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