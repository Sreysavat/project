<?php 
include 'function.php';
if(empty($_SESSION['user'])){

header('location:login.php');
}
$user = $_SESSION['user'];

$rs = connection()->query("SELECT * FROM `tbl_user` WHERE `id`= '$user' ");
$row = mysqli_fetch_assoc($rs);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- @theme style -->
    <link rel="stylesheet" href="assets/style/theme.css">

    <!-- @Bootstrap -->
    <link rel="stylesheet" href="assets/style/bootstrap.css">

    <!-- @script -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <!-- @tinyACE -->
    <script src="https://cdn.tiny.cloud/1/5gqcgv8u6c8ejg1eg27ziagpv8d8uricc4gc9rhkbasi2nc4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<body>
    <main class="admin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <div class="content-left">
                        <div class="wrap-top">
                            <img src="assets/Adminthumbnail/coffeelogo.jpg" alt="" width="50px" height="50px">
                            <h5>Jong Deng News</h5>
                        </div>
                        <div class="wrap-center">
                            <img src="assets/Adminthumbnail/<?php echo $row['thumbnail']; ?>" alt="" width="50px" height="50px">
                            <h6>Welcome Admin <?php echo $row['username'] ?> </h6>
                        </div>
                        <div class="wrap-bottom">
                            <ul>
                                <li class="parent">
                                    <a class="parent" href="logout.php">
                                        <span>Logout</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                </li>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>LOGO MENU</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="view-logo.php">View logo</a>
                                            <a href="add-logo.php">Add logo</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>New</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                    <a href="add-new.php">Add new</a>
                                    <a href="view-new.php">view new</a>  
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Follow</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                    <a href="add-follow.php">Add Follow</a>
                                    <a href="view-follow.php">view Follow</a>  
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>About_Us</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                    <a href="about-us.php">Add About_Us</a>
                                    <a href="view-about-us.php">view about_Us</a>  
                                        </li>
                                    </ul>
                                </li>
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Feedback</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                    <!-- <a href="admin/--article/contact.php">Add Feedback</a> -->
                                    <a href="view-feedback.php">view feedback</a>  
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>