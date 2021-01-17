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
    <title>Login</title>
</head>
<body>
    <div class="center">
        <form action="" method="post">
            <p>Login Form</p>
            <input type="text" name="login_id" placeholder="Enter ID" required><br><br>
            <input type="password" name="login_password" placeholder="Enter password" required><br><br>
            <button name="login_submit">Login</button><br><br>
            <button><a href="register.php">Register new Account</a></button>
        </form>

        <?php
            if(isset($_POST['login_submit'])) {
                $login_id = $_POST['login_id'];
                $password = $_POST['login_password'];

                $sql = "SELECT id, login_id, name, password FROM users WHERE login_id = '$login_id'";
                $result = mysqli_query($conn, $sql);
        
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($password == $row["password"]) {
                            $user_id = $row["id"];
                            $user_login_id = $row["login_id"];
                            $user_name = $row["name"];
                    
                            $_SESSION['id'] = $user_id;
                            $_SESSION['login_id'] = $user_login_id;
                            $_SESSION['name'] = $user_name;

                            header('location: ./');
                        } else {
                            echo "Incorrect Password";
                        }
                    }
                } else {
                     echo "Account doesn't exist";
                }
            }
        ?>
    </div>
</body>
</html>