<?php
    session_start();
    include 'db_connection.php';
    if(isset($_GET['hotel'])){
        $result = mysqli_query($connection, "SELECT * FROM hotels WHERE hotel_name LIKE '%{$_GET['hotel']}%'");
    }else{
        $result = mysqli_query($connection, 'SELECT * FROM hotels');
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

        .hotel h1{
            font-family: poppins;

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
    
        <div style="" class="bar row mt-5">
            <h1 class="text-center" style="font-size:40 px;">Available Hotels</h1>
            <div class="mx-auto banner">
                <div class="row align-items-center text-center p-3" style="background: url('images/bamboo-background.jpg'); color: white;">
                    <div class="col-12">
                        <form method="get">
                            <div class="input-group justify-content-center">
                                <div class="form-outline">
                                    <input type="search" name="hotel" id="hotel" class="form-control" placeholder="Search"/>
                                </div>
                                <button type="submit" class="btn btn-secondary" data-mdb-ripple-init>
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 row mx-auto" style="background-color:white; margin-top: 20px;">
                <?php
                    while($row = mysqli_fetch_assoc($result)){ 
                            $image_query = mysqli_query($connection, "SELECT * FROM hotel_images WHERE id_hotel={$row['id_hotel']} LIMIT 1");
                            $image_row = mysqli_fetch_assoc($image_query);
                        ?>
                        <div class="hotel row my-3 align-items-center text-center">
                            <div class="col-3">
                                <img src="<?php echo $image_row['file_path']?>" alt="" height="200px" width="100%" style="border:2px solid black; border-radius: 15px;">
                            </div>
                            <div class="col-7 overflow-hidden">
                                <div>
                                    <h1><?php echo $row['hotel_name']?></h1>
                                </div>
                                <div>
                                    <p><?php echo $row['hotel_description'] ?></p>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="<?php echo 'http://localhost/Pemograman-Web/hotel_detail.php?id=' . $row['id_hotel']?>">
                                    <button style="background-color: grey; color: white; padding: 10px; border-radius:15px;">
                                        Book Now
                                    </button>
                                </a>
                            </div>
                        </div>
                        
                        <hr>
                       
                <?php    
                    }
                ?>
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
