<?php
    session_start();
    include 'db_connection.php';
    $result = mysqli_query($connection, 'SELECT * FROM hotels LEFT JOIN hotel_images ON hotels.id_hotel = hotel_images.id_hotel LIMIT 2');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>CHEEZU Hotel Reservation</title>

    <style>
        .banner{
            padding:15px 0px; 
            border-top: 5px solid #9a6724ff; 
            border-bottom: 5px solid #9a6724ff;
        }
    </style>
</head>
<body style="width: 100%; margin: 0; font-family: 'Alice';">
    <div class="container-fluid">
        <div id="signature" class="row">
            <div id="navbar">
                <center>
                    <h1>CheezU</h1>
                </center>

                <a href="most_popular" style="position:absolute; right: 20px; background-color: transparent;border: 1px solid grey; padding: 10px; color: white; text-decoration: none; border-radius:5px;">
                    <span>Most Popular</span>
                </a>
            </div>
        </div>
    
        <div style="" class="row mt-5">
            <div class="mx-auto banner">
                <div class="row align-items-center text-center p-3" style="background: url('images/bamboo-background.jpg'); color: white;">
                    <div class="col-4">
                        <h2>List of most <br>liked Hotels</h2>
                    </div>
                    <div class="col-4">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis officiis suscipit veritatis iusto? Alias aperiam itaque quisquam natus, molestiae quis culpa autem sunt error, quos in, est exercitationem fugiat aut.</p>
                    </div>
                    <div class="col-4">
                        <img src="images/hotel-cozy-room.jpg" width="100%" height="200px" style="border-radius:20px">
                    </div>
                </div>
            </div>

            <div class="col-12 row mx-auto" style="background-color:white; margin-top: 20px;">
                
            </div>
        </div>

        <div id="footer" class="row">
            <p style="margin: 0; text-align: center;">
            © 2025 CheezU <br />
            All rights reserved.
            </p>
        </div>
    </div>
    
</body>
</html>
