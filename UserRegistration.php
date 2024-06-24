<?php
    $conn = new mysqli("localhost", "root", "", "atm_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Username = $_POST["Username"];
        $Password = $_POST["Password"];
        $Balance = $_POST["Balance"];
        $Account = $_POST["Account"];

        // Check if the username already exists
        $checkUsernameQuery = "SELECT * FROM users WHERE username = '$Username'";
        $result = $conn->query($checkUsernameQuery);

        if ($result->num_rows > 0) {
            // Username already exists
            echo "Username already exists.Please try with another Username";
            echo "<script>
                    setTimeout(function () {
                        window.location.href = 'FormRegistration.php'; 
                    }, 2000); 
                  </script>";
        } else {
            // Insert the new user
            $insertQuery = "INSERT INTO users (username, password, balance, account_no) VALUES ('$Username', '$Password', '$Balance', '$Account')";

            if ($conn->query($insertQuery)) {
                echo "Registration successful";
                echo "<script>
                    setTimeout(function () {
                        window.location.href = 'FormUserLogin.php'; 
                    }, 2000); 
                  </script>";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
                echo "<script>
                    setTimeout(function () {
                        window.location.href = 'FormRegistration.php'; 
                    }, 2000); 
                  </script>";
            }
        }
    }

    $conn->close();
?>
