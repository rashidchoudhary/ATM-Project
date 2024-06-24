<?php
session_start();

$conn = new mysqli("localhost", "root", "", "atm_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    $q = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $record = $conn->query($q);

    if ($record->num_rows > 0) {
        // Valid user, start a session
        $_SESSION["username"] = $user;
        echo "<script>
            setTimeout(function () {
                window.location.href = 'HomePage.php'; 
            }, 500); 
          </script>";
    } else {
        echo "Invalid Username or password.";
        echo "<script>
            setTimeout(function () {
                window.location.href = 'FormUserLogin.php'; 
            }, 2000); 
          </script>";
    }
} else {
    echo "Invalid form submission.";
}

$conn->close();
?>
