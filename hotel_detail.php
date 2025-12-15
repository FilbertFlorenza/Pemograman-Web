<?php
    session_start();
    include 'db_connection.php';
    if(isset($_GET['id'])){
        $result = mysqli_query($connection, "SELECT * FROM hotels WHERE id_hotel={$_GET['id']}");
        $row = mysqli_fetch_assoc($result);

        $room_result = mysqli_query($connection, "SELECT * FROM rooms WHERE id_hotel={$_GET['id']}");
    }else{
        header('Location: hotels.php');
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
            border-top: 5px solid #9a6724ff; 
            border-bottom: 5px solid #9a6724ff;
        }

        .carousel{
            border: 2px solid black;
            border-radius: 15px;
        }

        .carousel-item img{
            height: 400px;
            width: 100%;
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
            <h1 class="text-center">Booking</h1>
            <div class="mx-auto banner">
                <div class="row align-items-center text-center p-3" style="background: url('images/bamboo-background.jpg'); color: white;">
                    <div class="col-12">
                       <h1>
                        <?=$row['hotel_name']?>
                       </h1>
                    </div>
                </div>
            </div>

            <form action="reservation.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hotel_id" value="<?=$row['id_hotel']?>" />
                <div class="col-12 row mx-auto" style="background-color:white; margin-top: 20px;">
                    
                    <?php
                        $image_query = mysqli_query($connection, "SELECT * FROM hotel_images WHERE id_hotel={$row['id_hotel']}");
                    ?>
                    <div class="row">
                        <div id="hotelImages" class="col-6 carousel slide mx-auto">
                            <div class="carousel-inner">
                                <?php
                                    $active = 'active';
                                    while($row = mysqli_fetch_assoc($image_query)){ ?>
                                        <div class="carousel-item <?php echo $active?>">
                                            <img src="<?php echo $row['file_path']?>" class="d-block w-100" alt="hotel_image">
                                        </div>
                                <?php 
                                    $active = '';
                                    }
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#hotelImages" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#hotelImages" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <hr class="mt-3">
                    <div class="col-8">
                        <?php
                            while($row = mysqli_fetch_assoc($room_result)){ 
                                    $image_query = mysqli_query($connection, "SELECT * FROM room_images WHERE id_room={$row['id_room']} LIMIT 1");
                                    $image_row = mysqli_fetch_assoc($image_query);
                                ?>
                                <div class="row my-3 align-items-center">
                                    <div class="col-4">
                                        <img src="<?php echo $image_row['file_path']?>" alt="" height="200px" width="100%" style="border:2px solid black; border-radius: 15px;">
                                    </div>
                                    <div class="col-6 overflow-hidden">
                                        <div>
                                            <h1><?php echo $row['room_name']?></h1>
                                        </div>
                                        <div class="text-end">
                                            <p>Price per Night: ¥ <?=$row['price_per_night']?></p>
                                        </div>
                                        <div>
                                            <p><?php echo $row['room_description'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="<?='quantity_'.$row['id_room']?>">
                                    </div>
                                </div>
                                <hr>
                        <?php    
                            }
                        ?>
                    </div>
                    <div class="col-4 p-3">
                        <div class="d-flex flex-column align-items-center p-3" style="border: 2px solid black; border-radius: 15px;">
                            <label for="basic-url">Check in Date</label>
                            <div class="input-group mb-3">
                                <input type="date" name="check_in_date" class="form-control" id="basic-url" aria-describedby="basic-addon3" required>
                            </div>

                            <label for="basic-url">Check out Date</label>
                            <div class="input-group mb-3">
                                    <input type="date" name="check_out_date" class="form-control" id="basic-url" aria-describedby="basic-addon3" required>
                            </div>

                            <label for="basic-url">Your Name</label>
                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" id="basic-url" aria-describedby="basic-addon3" required>
                            </div>

                            <div class="input-group mb-3">
                                <button type="submit" name="submit" class="btn btn-dark mb-2 mx-auto">Continue</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
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
