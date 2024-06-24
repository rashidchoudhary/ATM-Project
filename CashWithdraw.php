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

// Fetch user's current balance
$q = "SELECT balance FROM users WHERE username='$user'";
$result = $conn->query($q);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentBalance = $row["balance"];
} else {
    echo "Error fetching user information.";
    exit();
}

// Process withdrawal if form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $withdrawalAmount = $_POST["amount"];

    if (!is_numeric($withdrawalAmount) || $withdrawalAmount <= 0) {
        $error = "Please enter a valid positive number.";
    } elseif ($withdrawalAmount > $currentBalance) {
        $error = "Insufficient balance.";
    } else {
        // Update balance after withdrawal
        $newBalance = $currentBalance - $withdrawalAmount;
        $updateQuery = "UPDATE users SET balance=$newBalance WHERE username='$user'";

        if ($conn->query($updateQuery)) {
            $success = "Withdrawal successful. Updated balance: $newBalance";
            $currentBalance = $newBalance; // Update current balance for display
        } else {
            $error = "Error updating balance.";
        }
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
            max-width: 450px;
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
    <title>Cash Withdrawal</title>
</head>
<body>
    <div class="container">
        <h1>Cash Withdrawal</h1>
        
        <p><strong>Current Balance:</strong> $<?php echo $currentBalance; ?></p>

        <?php
        if (isset($error)) {
            echo '<div class="error">' . $error . '</div>';
        } elseif (isset($success)) {
            echo '<div class="success">' . $success . '</div>';
        }
        ?>

        <form method="post" action="">
            <label for="amount">Enter Amount to Withdraw:</label>
            <input type="number" id="amount" name="amount" required>
            <button type="submit">Withdraw</button>
        </form>

        <button class="btn" onclick="location.href='HomePage.php'">Go Back to Home</button>
    </div>
</body>
</html>
