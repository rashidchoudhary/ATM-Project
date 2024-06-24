<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login form after 3 seconds
echo '<html lang="en">
<head>
    <meta http-equiv="refresh" content="3;url=FormUserLogin.php" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url("ATM.jpg!w700wp");
            background-size: cover;
            
        }

        .container {
            text-align: center;
            backdrop-filter: blur(10px);
            border-radius: 20px;
        }

        h1 {
            color: white;
            font-size: 50px;
        }
    </style>
    <title>Logout</title>
</head>
<body>
    <div class="container">
        <h1>Thanks for using our services!</h1>
    </div>
</body>
</html>';
?>
