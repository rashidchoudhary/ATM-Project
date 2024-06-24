<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: FormUserLogin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "atm_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_SESSION["username"];

// Process form submission if POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $currentPin = $_POST["current_pin"];
    $newPin = $_POST["new_pin"];

    // Fetch user's current PIN
    $q = "SELECT password FROM users WHERE username='$user'";
    $result = $conn->query($q);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPin = $row["password"];

        // Verify current PIN
        if ($currentPin === $storedPin) {
            // Update PIN
            $updateQuery = "UPDATE users SET password='$newPin' WHERE username='$user'";

            if ($conn->query($updateQuery)) {
                $success = "PIN changed successfully.";
            } else {
                $error = "Error updating PIN.";
            }
        } else {
            $error = "Incorrect current PIN.";
        }
    } else {
        $error = "Error fetching user information.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('ATM.jpg!w700wp');
            background-size: cover;
        }

        .container {
            color: white;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            backdrop-filter: blur(10px);
        }

        h1 {
            color: white;
        }

        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            padding: 8px;
            margin: 5px 0;
            width: 100%;
            color: white;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.1);
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 15px 20px;
            font-size: 16px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .success {
            color: white;
            margin-top: 10px;
        }
        .btn{
            margin-left: 0px;
        }
    </style>
    <title>Change PIN</title>
</head>
<body>
    <div class="container">
        <h1>Change PIN</h1>

        <?php
        if (isset($error)) {
            echo '<div class="error">' . $error . '</div>';
        } elseif (isset($success)) {
            echo '<div class="success">' . $success . '</div>';
        }
        ?>

        <form method="post" action="">
            <label for="current_pin">Current PIN:</label>
            <input type="password" id="current_pin" name="current_pin" maxlength="4" required>
            <label for="new_pin">New PIN:</label>
            <input type="password" id="new_pin" name="new_pin" maxlength="4" required>
            <button type="submit">Change PIN</button>
            
        </form>

        <button class="btn" onclick="location.href='HomePage.php'">Go Back to Home</button>
    </div>
</body>
</html>
