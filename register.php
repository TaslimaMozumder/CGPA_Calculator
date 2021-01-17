<?php include_once('assets/php/database.php');
    if(isset($_SESSION['login_id'])) {
        header('location: index.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <div class="center">
        <form action="" method="post">
            <p>Register Form</p>
            <input type="text" name="register_id" placeholder="Enter ID" required><br><br>
            <input type="text" name="register_name" placeholder="Enter name" required><br><br>
            <input type="password" name="register_password" placeholder="Enter password" required><br><br>
            <button name="register_submit">Sign Up</button><br><br>
            <button><a href="login.php">Login</a></button>
        </form>

        <?php
            if(isset($_POST['register_submit'])) {
                $register_id = $_POST['register_id'];
                $register_name = $_POST['register_name'];
                $register_password = $_POST['register_password'];

               
                $search = "SELECT * FROM users WHERE login_id = '$register_id'";
                $account = mysqli_query($conn, $search);
        
                if(mysqli_num_rows($account) > 0) {
                    echo "Account already exist";
                } else {
                    $sql = "INSERT INTO users (login_id, name, password) VALUES('$register_id', '$register_name', '$register_password')";
                    
                    if(mysqli_query($conn, $sql)) {
                        header('location: index.php');
                    } else {
                        echo "Registration Failed";
                    }
                }
            }
        ?>
    </div>
</body>
</html>