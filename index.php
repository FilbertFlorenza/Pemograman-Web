<?php
    session_start();
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
</head>
<body style="width: 100%; margin: 0; font-family: 'Alice';">
    <div class="container-fluid">
        <div id="signature" class="row">
            <div id="navbar">
                <center>
                    <a href="index.php">
                        <h1>CheezU</h1>
                    </a>
                </center>

            </div>
        </div>
    
        <div style="padding:20px;" class="row">
            <div class="col-12 row mx-auto hero-banner">
                <div class="col-12">
                    <h1>Heart of Japan
                    </h1>
                    <a href="hotels">
                        <button style="background-color:#e4e2e2ff; border-radius: 10px; padding: 10px; color: grey;">Explore Now</button>
                    </a>
                </div>
                <div style="margin-top: 50px; color: grey;">
                    <a href="hotels.php">
                        <button class="col-3 mx-1" style="color:white; padding: 20px; background-color: grey; border-radius:10px;">
                            Search Hotel
                        </button>
                    </a>
                </div>
            </div>

            <div class="col-12 row mx-auto" style="background-color:white; margin-top: 20px;">
                <div class="content col-7" style="background-color:white; color: black;">
                    <h1>Welcome To Cheezu Hotel </h1>
                    <p style="color:grey;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec enim erat, efficitur at elementum vel, mattis eget risus. Sed condimentum odio sed mattis tempor. Vivamus sed justo dolor. Pellentesque dignissim lobortis lorem vel dictum. Morbi tincidunt eu felis ut ultricies. Etiam pharetra tellus in sapien feugiat, vitae bibendum nibh gravida. Praesent ultricies a eros et eleifend. Mauris sagittis volutpat purus. Fusce ipsum est, pellentesque vel tellus hendrerit, lacinia dapibus lectus. Sed porttitor eu massa ut convallis. Curabitur scelerisque nulla ac orci tempus, non aliquam ante feugiat.
                        <br>
                        <br>
                        Proin sodales a ante vel lobortis. Mauris vel nunc sit amet velit volutpat interdum at a eros. Mauris fringilla fermentum tincidunt. Proin placerat dignissim nulla quis molestie. Etiam quis mi faucibus nisl ullamcorper tristique ut vel nisi. Sed faucibus justo nec urna pharetra dapibus. Morbi scelerisque ex et pulvinar dictum. Donec et augue dolor. Duis sed molestie ex, fermentum venenatis purus.
                    </p>
                </div>
                <div class="col-5" >
                    <img src="images/hotelbackground.jpg" width="100%" style="border-radius:20px">
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
</html>
