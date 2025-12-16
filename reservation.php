<?php
    session_start();
    include 'db_connection.php';
    if(isset($_POST['submit'])){
        $hotel_id = $_POST['hotel_id'];
        $guest_name = $_POST['name'];
        $check_in_date = $_POST['check_in_date'];
        $check_out_date = $_POST['check_out_date'];
        $total = 0;

        $insert_query = "INSERT INTO reservations (id_hotel, guest_name, total_price, check_in_date, check_out_date) VALUES ('$hotel_id','$guest_name', '$total', '$check_in_date', '$check_out_date')";
        mysqli_query($connection, $insert_query);

        $id_reservation = mysqli_insert_id($connection);

        $room_result = mysqli_query($connection, "SELECT * FROM rooms WHERE id_hotel={$hotel_id}");
        while($row = mysqli_fetch_assoc($room_result)){
            $id_room = $row['id_room'];
            $quantity = (int)$_POST['quantity_'.$id_room];
            $total += $row['price_per_night'] * $quantity;

            if($quantity > 0){
                $insert_query = "INSERT INTO reservation_rooms (id_reservation, id_room, quantity) VALUES ('$id_reservation', '$id_room','$quantity')";
                mysqli_query($connection, $insert_query);
            }
        }

        $update_query = "UPDATE reservations SET total_price={$total} WHERE id_reservation='{$id_reservation}'";
        mysqli_query($connection, $update_query);
    }else{
        header('Location: ../');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ec04c27a7f.js" crossorigin="anonymous"></script>
    <title>CHEEZU Hotel Reservation</title>

    <style>
        .banner{
            padding:15px 0px; 
            border-top: 3px solid #9a6724ff; 
            border-bottom: 3px solid #9a6724ff;
        }

        .reservation-card {
            max-width: 700px;
            margin: 3rem auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }
    </style>
</head>
<body style="width: 100%; margin: 0; font-family: 'Alice';">
    <div class="container-fluid">
        <div id="signature" class="row">
            <div id="navbar">
                <center>
                    <a href="index.php">
                        <img src="http://localhost/Pemograman-Web/images/logo.png" height="60px">
                    </a>
                </center>
            </div>
        </div>
    
        <div style="" class="row mt-5">
            <div class="mx-auto banner">
                <div class="row align-items-center text-center p-3" style="background: url('images/bamboo-background.jpg'); color: white;">
                    <div class="col-12">
                       <h1>
                        My Reservation
                       </h1>
                    </div>
                </div>
            </div>

            <div class="col-12 row mx-auto" style="background-color:white; margin-top: 20px;">
                <div class="col-6 mx-auto text-center reservation-card">
                    <h5>
                        Check-in Date: <?=$check_in_date?>
                    </h5>
                    <h5>
                        Check-out Date: <?=$check_out_date?>
                    </h5>
                    <h3>
                        Total Price: <?=$total?>
                    </h3>
                    <h4>
                        Thanks for your reservation, we hope you will come back again!
                    </h4>
                    <div class="text-center mt-4">
                        <a href="index.php" class="btn btn-secondary btn-lg">
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
            <div class="mx-auto banner">
                <div class="row align-items-center text-center p-3" style="background: url('images/bamboo-background.jpg'); color: white;">
                    <div class="col-12">
                      
                    </div>
                </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
    const myCarouselElement = document.querySelector('#hotelImages');
    const carousel = new bootstrap.Carousel(myCarouselElement);
</script>
</html>
