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
            width: 350px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.1); /* Adjusted transparency */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); /* Increased shadow */
        }
        h2{
            color: white;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        label {
            margin-top: 15px; /* Increased margin */
            font-size: 14px;
            font-weight: bold;
            color: white;
        }

        input {
            padding: 12px; /* Increased padding */
            margin: 8px 0;
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
            padding: 14px; /* Increased padding */
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
            margin-top: 10px; /* Increased margin */
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ATM System</title>
</head>
<body>
    <div class="container">
        <form name="Login" id="Login" method="post" action="UserLogin.php">
            <h2>Login</h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" maxlength="4" required>
            <button type="submit">Login</button>
        </form>
        <button onclick="location.href='FormRegistration.php'">Register Yourself</button>
    </div>
</body>
</html>
