
<?php
session_start();
include '../db_connection.php'; // koneksi database

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query user
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek jika user ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // COCOKKAN PASSWORD TANPA HASH
        if ($password === $user['password']) {

            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: hotels");
            exit;

        } else {
            $_SESSION['error_msg'] = "Wrong Password";
            header("Location: ./");
        }
    } else {
        $_SESSION['error_msg'] = "User not found";
        header("Location: ./");
    }
}
?>
