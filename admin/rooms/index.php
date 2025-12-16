<?php
    include '../auth.php';
    include '../../db_connection.php';
    $query = "SELECT rooms.*, hotels.hotel_name, SUM(reservation_rooms.quantity) as total_reservations FROM rooms 
    JOIN hotels ON rooms.id_hotel = hotels.id_hotel 
    LEFT JOIN reservation_rooms on rooms.id_room = reservation_rooms.id_room
    GROUP BY rooms.id_room";
    $result = mysqli_query($connection, $query);
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
    <title>Rooms</title>
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
            <div class="row">
                <div class="col-12 p-3 d-flex justify-content-between">
                    <h2>Room Type List</h2>
                    <a href="add.php">
                        <button>Add Room</button>
                    </a>
                </div>
                <div class="col-12 px-3">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Hotel Name</th>
                                <th scope="col">Room Type Name</th>
                                <th scope="col">Price Per Night</th>
                                <th scope="col">Total Reservations</th>
                                <th scope="col">Status</th>
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
                                        <td>{$row['room_name']}</td>
                                        <td>{$row['price_per_night']}</td>
                                        <td>{$row['total_reservations']}</td>
                                        <td>{$row['status']}</td>
                                        <td>
                                            <a href='edit.php?id={$row['id_room']}'>Edit</a> | 
                                            <a href='crud.php?id={$row['id_room']}&delete=1'>Delete</a>
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
    <?php if (!empty($_SESSION['message'])): ?>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;">
        <div class="toast align-items-center text-bg-<?= $_SESSION['message_type'] ?? 'primary' ?> border-0"
            role="alert"
            aria-live="assertive"
            aria-atomic="true">

            <div class="d-flex">
                <div class="toast-body">
                    <?= htmlspecialchars($_SESSION['message']) ?>
                </div>
                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"
                        aria-label="Close">
                </button>
            </div>
        </div>
    </div>
    <?php 
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
    endif; ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toastEl = document.querySelector('.toast');
        if (toastEl) {
            const toast = new bootstrap.Toast(toastEl, {
                delay: 3000
            });
            toast.show();
        }
    });
</script>
</html>