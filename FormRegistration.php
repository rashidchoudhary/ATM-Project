<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('ATM.jpg!w700wp');
            background-size: cover;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.1); 
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3); 
            padding: 40px;
            width: 400px;
            max-width: 80%;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        label {
            margin-top: 10px;
            font-size: 14px;
            font-weight: bold;
            color: white;
        }

        input {
            padding: 10px;
            margin: 8px 0;
            width: 100%;
            color: white;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.1);
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            background-color: #28a745;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #228B22;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ATM System</title>
</head>
<body>
    <div class="container">
        <form name="Registration" id="Registration" method="post" action="UserRegistration.php">
            <h2 style="color: #28a745;">Register User</h2>
            <label for="Username">Username:</label>
            <input type="text" id="Username" name="Username" required>
            <label for="Password">Password (4 digits):</label>
            <input type="password" id="Password" name="Password" maxlength="4" required>
            <label for="Balance">Enter initial balance:</label>
            <input type="number" id="Balance" name="Balance" required>
            <label for="Account">Select an Account No (8 digits):</label>
            <input type="text" id="Account" name="Account" maxlength="8" required>
            <input class="btn" type="submit" value="Register User">
        </form>
        <button class="btn" onclick="location.href='FormUserLogin.php'">Login</button>
    </div>
</body>
</html>
