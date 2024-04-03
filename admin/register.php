<?php
include 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Register</title>
    <link rel="stylesheet" href="assets/style/theme.css">
</head>
<body>
    <div class="content-login">
        <form method="post" enctype="multipart/form-data">
            <label>Username</label>
            <input type="text" class="box" name="username">
            <label>Email</label>
            <input type="text" class="box" name="email">
            <label>Password</label>
            <input type="password" class="box" name="password">
            <label for="">Profile:</label>
            <input type="file" name="profile" id="" class="box">
            <div class="wrap-btn">
                <a href="login.php" class="btn">Back To Login</a>&ensp;
                <input type="submit" class="btn" name="btn_register" value="SIGN UP">
            </div>
        </form>
    </div>
</body>
</html>