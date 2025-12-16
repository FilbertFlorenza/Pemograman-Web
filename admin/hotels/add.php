<?php 
    include '../auth.php';
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
                   <a href="http://localhost/Pemograman-Web/admin/hotels">
                        <button class="menu-button">
                            Hotel
                        </button>
                    </a>
                    <a href="http://localhost/Pemograman-Web/admin/rooms">
                        <button class="menu-button">
                            Room Types
                        </button>
                    </a>
                    <a href="http://localhost/Pemograman-Web/admin/reservations">
                        <button class="menu-button">
                            Reservations
                        </button>
                    </a>
                    <a href="http://localhost/Pemograman-Web/admin/logout.php">
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
                <h2>Add Hotel</h2>
                <form method="POST" enctype="multipart/form-data" action="process.php">
                    <div class="row my-2">
                        <label for="hotel_name" class="col-2 col-form-label">Hotel Name</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="hotel_name" name="hotel_name" placeholder="Your Hotel Name">
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="hotel_address" class="col-2 col-form-label">Hotel Address</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="hotel_address" name="hotel_address" placeholder="Your Hotel Address">
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="hotel_description" class="col-2 col-form-label">Hotel Description</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="hotel_description" name="hotel_description" placeholder="Your Hotel Description">
                        </div>
                    </div>
                    <div class="row my-2">
                        <label for="hotel_description" class="col-2 col-form-label">Hotel Images</label>
                        <div class="col-10">
                            <input type="file" class="form-control-file" id="hotel_images" name="hotel_images[]" accept="image/*" multiple>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="http://localhost/Pemograman-Web/admin/hotels">
                            <span class="btn btn-secondary mb-2">Back</span>
                        </a>
                        <button type="submit" name="submit_add" class="btn btn-dark mb-2">Submit</button>
                    </div>
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
