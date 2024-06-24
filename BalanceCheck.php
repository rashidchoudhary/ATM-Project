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

$q = "SELECT username, account_no, balance FROM users WHERE username='$user'";
$result = $conn->query($q);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
    $accountNo = $row["account_no"];
    $balance = $row["balance"];
} else {
    echo "Error fetching user information.";
    exit();
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
            text-align: left;
            background-color: rgba(255, 255, 255, 0.1); 
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            padding: 20px;
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            backdrop-filter: blur(10px); 
        }


        h1 {
            color: white;
        }

        p {
            font-size: 18px;
            margin-bottom: 10px;
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
    </style>
    <title>Balance Check</title>
</head>
<body>
    <div class="container">
        <h1>Your Account Information</h1>
        
        <p><strong>Username:</strong> <?php echo $username; ?></p>
        <p><strong>Account Number:</strong> <?php echo $accountNo; ?></p>
        <p><strong>Balance:</strong> $<?php echo $balance; ?></p>

        <button onclick="location.href='HomePage.php'">Go Back to Home</button>
    </div>
</body>
</html>
