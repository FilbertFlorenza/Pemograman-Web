<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        header("Location: hotels");
        exit;
    }
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

        .content h2,h5,p{
            color: #ffffffff;
            font-family: 'Poppins';
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
    <title>Admin Login</title>
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
        <div class="content col-12">
            <div class="row p-3 col-6 mx-auto mt-5" style="background-color:grey; border-radius:20px;">
                <center class="mt-5">
                    <h2>Please Login</h2>
                    <h5>To Continue</h5>
                </center>
                <form method="POST" enctype="multipart/form-data" action="login.php">
                    <div class="form-group row my-2">
                        <label for="username" class="form-label text-white">Username / Email</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                    </div>
                    <div class="form-group row my-2">
                        <label for="password" class="form-label text-white">Password</label>
                        <div class="col-12">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <?php
                        if(isset($_SESSION['error_msg'])):?>
                        <div class="form-group row my-2">
                            <label for="password" class="form-label text-danger"><?php echo $_SESSION['error_msg'];?></label>
                        </div>
                    <?php 
                        endif;
                    ?>
                    <div class="form-group row my-5">
                        <div class="col-lg-5 mx-auto">
                            <input type="submit" class="btn btn-dark form-control" id="login" name="login" value="Continue">
                        </div>
                    </div>
                    <!-- <button type="submit" name="login" class=" mb-2">Login</button> -->
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
