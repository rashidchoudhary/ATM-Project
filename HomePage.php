<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: FormUserLogin.html"); // Redirect to login page if not logged in
    exit();
}

// Retrieve the username from the session
$user = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #333333;
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
    text-align: center;
    background-color: rgba(255, 255, 255, 0.1); 
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); 
    padding: 20px;
    position: relative; 
    max-width: 700px; 
    width: 100%; 
    margin: 0 auto; 
    backdrop-filter: blur(10px); 
}

        h1 {
            color: white;
        }

        .buttons {
            display: flex;
            /* flex-wrap: wrap; */
            justify-content: space-between;
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
            width: calc(50% - 15px); /* Set width based on half of container width minus margin */
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
    <title>Welcome to ATM System</title>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $user; ?>!</h1>

        <div class="buttons">
            <button onclick="location.href='BalanceCheck.php'">Balance Check</button>
            <button onclick="location.href='CashWithdraw.php'">Cash Withdraw</button>
        </div>
        <div class="buttons">
            <button onclick="location.href='ChangePin.php'">Change PIN</button>
            <button onclick="location.href='BalanceTransfer.php'">Balance Transfer</button>
        </div>

        <button onclick="location.href='Logout.php'">Logout</button>
    </div>
</body>
</html>


