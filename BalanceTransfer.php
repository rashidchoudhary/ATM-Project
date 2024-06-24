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
    $receiverAccount = $_POST["receiver_account"];
    $transferAmount = $_POST["transfer_amount"];

    // Fetch sender's account number
    $getSenderAccountQuery = "SELECT account_no FROM users WHERE username='$user'";
    $senderAccountResult = $conn->query($getSenderAccountQuery);

    if ($senderAccountResult->num_rows > 0) {
        $senderAccountRow = $senderAccountResult->fetch_assoc();
        $senderAccount = $senderAccountRow["account_no"];

        // Validate receiver's account number
        if ($receiverAccount === $senderAccount) {
            $error = "Cannot transfer funds to your own account.";
        } else {
            // Fetch sender's current balance
            $getSenderBalanceQuery = "SELECT balance FROM users WHERE username='$user'";
            $senderResult = $conn->query($getSenderBalanceQuery);

            if ($senderResult->num_rows > 0) {
                $senderRow = $senderResult->fetch_assoc();
                $senderBalance = $senderRow["balance"];

                // Validate transfer amount
                if (!is_numeric($transferAmount) || $transferAmount <= 0) {
                    $error = "Please enter a valid positive number for the transfer amount.";
                } elseif ($transferAmount > $senderBalance) {
                    $error = "Insufficient balance for the transfer.";
                } else {
                    // Fetch receiver's current balance
                    $getReceiverBalanceQuery = "SELECT balance FROM users WHERE account_no='$receiverAccount'";
                    $receiverResult = $conn->query($getReceiverBalanceQuery);

                    if ($receiverResult->num_rows > 0) {
                        $receiverRow = $receiverResult->fetch_assoc();
                        $receiverBalance = $receiverRow["balance"];

                        // Update balances after transfer
                        $newSenderBalance = $senderBalance - $transferAmount;
                        $newReceiverBalance = $receiverBalance + $transferAmount;

                        $updateSenderQuery = "UPDATE users SET balance=$newSenderBalance WHERE username='$user'";
                        $updateReceiverQuery = "UPDATE users SET balance=$newReceiverBalance WHERE account_no='$receiverAccount'";

                        if ($conn->query($updateSenderQuery) && $conn->query($updateReceiverQuery)) {
                            $success = "Transfer successful. Updated balance after transfer: $newSenderBalance";
                        } else {
                            $error = "Error updating balances.";
                        }
                    } else {
                        $error = "Receiver account not found.";
                    }
                }
            } else {
                $error = "Error fetching sender information.";
            }
        }
    } else {
        $error = "Error fetching sender account information.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
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

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: white;
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
            margin: 10px 0;
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
    </style>
    <title>Balance Transfer</title>
</head>
<body>
    <div class="container">
        <h1>Balance Transfer</h1>

        <?php
        if (isset($error)) {
            echo '<div class="error">' . $error . '</div>';
        } elseif (isset($success)) {
            echo '<div class="success">' . $success . '</div>';
        }
        ?>

        <form method="post" action="">
            <label for="receiver_account">Receiver's Account Number:</label>
            <input type="text" id="receiver_account" name="receiver_account" maxlength="8" required>

            <label for="transfer_amount">Enter Amount to Transfer:</label>
            <input type="number" id="transfer_amount" name="transfer_amount" required>

            <button type="submit">Transfer Balance</button>
        </form>

        <button onclick="location.href='HomePage.php'">Go Back to Home</button>
    </div>
</body>
</html>
