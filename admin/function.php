<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
session_start();
function connection(){
    $connection = new mysqli('localhost','root','','project');
    return $connection;
}
    function register(){
        if(isset($_POST['btn_register'])){
            // echo 123;
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $profile = $_FILES['profile']['name'];
            if(!empty($username) && !empty($email) && !empty($password) && !empty($profile)){
                $profile= date('dmy-his').'_'.$profile;
                $path ='assets/Adminthumbnail/'.$profile;
                move_uploaded_file($_FILES['profile']['tmp_name'],$path);
                $password = md5($password);

                $sql = "INSERT INTO `tbl_user`(`username`, `email`, `password`, `thumbnail`) VALUES ('$username', '$email', '$password','$profile')";

                $rs = connection()->query($sql);
                if($rs){
                    header('location:login.php');
                    echo '
                    <script>
                    $(document).ready(function(){
                        swal({
                        title: "Done  For(>_<)",
                        text: "Account register!",
                        icon: "success",
                        button: "Done",
                            });
                            
                            });
                        </script>
                    ';
                }
            }
            else{
                echo'
                 <script>
                    $(document).ready(function(){
                        swal({
                        title: "Somthing went wrong!",
                        text: "Register fale!",
                        icon: "warning",
                        button: "Done",
                            });
                            
                            });
                        </script>
                ';
            }
        }
    }
register();
function login(){

    if(isset($_POST['btn_login'])){
        $name_email = $_POST['name_email'];
        $password = $_POST['password'];
        if(!empty($name_email) && !empty($password)){
        $password= md5($password);
        $sql = "SELECT * FROM `tbl_user` WHERE(`username` = '$name_email'OR `email`='$name_email') AND `password` = '$password'";
        $rs = connection()->query($sql);
        $row = mysqli_fetch_assoc($rs);
        if($row){
            $_SESSION['user'] = $row['id'];
            header('location:index.php');
        }
        else{
            echo '
            <script>
            $(document).ready(function(){
                swal({
                title: "error",
                text: "username or email or password are incorrect",
                icon: "error",
                button: "Done",
                    });
                    
                    });
                </script>
            ';
        }
        }
        else{
            echo'
            <script>
            $(document).ready(function(){
                swal({
                title: "Error",
                text: "please input all fill",
                icon: "error",
                button: "Done",
                    });
                    
                    });
                </script>
            ';
        }
    }
}
login();

function logout(){
    if(isset($_POST['btn_logout'])){
        unset($_SESSION['user']);
    }
}
logout();

function addlogo(){
    if(isset($_POST['btn-add-logo'])){
        $status = $_POST['status'];
        $thumbnail = $_FILES['thumbnail']['name'];

        if(!empty($status) && !empty($thumbnail)){
            $thumbnail = rand(1, 99999).'_'.$thumbnail;
            $path = 'assets/Adminthumbnail/'.$thumbnail;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);

            $sql = "INSERT INTO `tbl_logo`(`thumbnail`, `status`) VALUES ('$thumbnail','$status')";
            $rs =connection()->query($sql);


        }
    }
}
addlogo();

function getlogo(){
    $sql = "SELECT * FROM `tbl_logo` ORDER BY `id` DESC";

    $rs = connection()->query($sql);

    while ($row = mysqli_fetch_assoc($rs)){
        echo '
        <tr>
        <td>'.$row['status'].'</td>
        <td><img src="assets/Adminthumbnail/'.$row['thumbnail'].'" width="100" ></td>
        <td>'.$row['created_at'].'</td>
        <td width="150px">
            <a href="update-logo.php?id='.$row['id'].'" class="btn btn-primary">Update</a>
            <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Remove
            </button>
        </td>
    </tr>
        ';
    }
}

function updatelogo(){
    if(isset($_POST['btn-update-logo'])){
        $param_id = $_GET['id'];
        $status = $_POST['status'];
        $thumbnail = $_FILES['thumbnail']['name'];
        if(empty($thumbnail)){
            $thumbnail =$_POST['old_thumbnail'];
        }else{
            $thumbnail = rand(1, 99999).'_'.$thumbnail;
            $path = 'assets/Adminthumbnail/'.$thumbnail;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);
        }
        if(!empty($status) && !empty($thumbnail)){
            $sql = "UPDATE `tbl_logo` SET `thumbnail` = '$thumbnail' ,`status` ='$status' WHERE `id` ='$param_id'";
            $rs = connection()->query($sql);
            if($rs){
                echo'
                <script>
                $(document).ready(function(){
                    swal({
                    title: "Done",
                    text: " Update success!",
                    icon: "success",
                    button: "Done",
                        });
                        
                        });
                    </script>
                ';
            }
        }
        else{
            echo '
            <script>
            $(document).ready(function(){
                swal({
                title: "Error",
                text: "logo update not success!",
                icon: "error",
                button: "Done",
                    });
                    
                    });
                </script>
            ';
        }
    }
}
updatelogo();

function deletelogo(){
    if(isset($_POST['btn-delete-logo'])){
        $remove_id = $_POST['remove_id'];

        $sql = "DELETE FROM `tbl_logo` WHERE `id`='$remove_id'";

        $rs = connection()->query($sql);
        if($rs){
            echo'
            <script>
                $(document).ready(function(){
                    swal({
                    title: "Done",
                    text: " Delete success!",
                    icon: "success",
                    button: "Done",
                        });
                        
                        });
                    </script>
            ';
        }
    }
}
deletelogo();

function addNews(){
    if(isset($_POST['btn-add-news'])){
        $title = $_POST['title'];
        $newsType = $_POST['newsType'];
        $category = $_POST['category'];
        $thumbnail = $_FILES['thumbnail']['name'];
        $banner = $_FILES['banner']['name'];
        $description = $_POST['description'];

        if(!empty($thumbnail) && !empty($title) && !empty($newsType) 
        && !empty($category) && !empty($banner) && !empty($description)){

            $thumbnail = rand(1,99999).'-'.$thumbnail;
            $path = 'assets/image/'.$thumbnail;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);

            $banner = rand(1,99999).'-'.$banner;
            $path = 'assets/image/'.$banner;
            move_uploaded_file($_FILES['banner']['tmp_name'],$path);

            $userID = $_SESSION['user'];

            $sql ="INSERT INTO `tbl_new`(`title`, `description`, `banner`,`thumbnail`,`news_type`, `category`, `viewer`, `user_id`)
             VALUES 
            ('$title','$description','$banner','$thumbnail','$newsType','$category','0','$userID')";
            $rs=connection()->query($sql);
            if($rs){
                echo'
                <script>
                $(document).ready(function(){
                    swal({
                    title: "Done",
                    text: " New Insert successfully!",
                    icon: "success",
                    button: "Done",
                        });
                        
                        });
                    </script>
                ';
            }

        }
        else{
            echo'
            <script>
            $(document).ready(function(){
                swal({
                title: "Error",
                text: " Please input all fill!",
                icon: "error",
                button: "Done",
                    });
                    
                    });
                </script>
            ';
        }
    }
}
addNews();

function viewNews(){
    $sql = "SELECT `tn`.*,`tu`.`username` FROM `tbl_new` `tn` INNER JOIN `tbl_user` `tu` ON `tn`.`user_id` = `tu`.`id` ORDER BY `id` DESC";
    $rs = connection()->query($sql);
    while($row = mysqli_fetch_assoc($rs)){
        echo'
        <tr>
        <td>'.$row['title'].'</td>
        <td>'.$row['news_type'].'</td>
        <td>'.$row['category'].'</td>
        <td><img src="assets/image/'.$row['thumbnail'].'" width="150px" height="100px"/></td>
        <td><img src="assets/image/'.$row['banner'].'" width="150px" height="100px"/></td>
        <td>'.$row['username'].'</td>
        <td>'.$row['viewer'].'</td>
        <td>'.$row['created_at'].'</td>
        <td width="150px">
            <a href="update-new.php?id='.$row['id'].'"class="btn btn-primary">Update</a>
            <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Remove
            </button>
        </td>
    </tr>
        ';
    }
}
function deleteNews(){
    if(isset($_POST['btn-delete-news'])){
        $remove_id = $_POST['remove_id'];

        $sql = "DELETE FROM `tbl_new` WHERE `id` = '$remove_id'";
        $rs = connection()->query($sql);
        if($rs){
            echo'
                <script>
                $(document).ready(function(){
                    swal({
                    title: "Done",
                    text: " New Insert successfully!",
                    icon: "success",
                    button: "Done",
                        });
                        
                        });
                    </script>
                ';
        }
    }
}
deleteNews();

function updateNews(){
    if(isset($_POST['btn-update-news'])){
        $id = $_GET['id'];
        $title = $_POST['title'];
        $newsType = $_POST['newsType'];
        $category = $_POST['category'];
        $thumbnail = $_FILES['thumbnail']['name'];
        $banner = $_FILES['banner']['name'];
        $description = $_POST['description'];

        if($thumbnail){
            $thumbnail = rand(1,99999).'-'.$thumbnail;
            $path = 'assets/image/'.$thumbnail;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);
        }
        else{
            $thumbnail = $_POST['old_thumbnail'];
        }
        if($banner){
            $banner = rand(1,99999).'-'.$banner;
            $path = 'assets/image/'.$banner;
            move_uploaded_file($_FILES['banner']['tmp_name'],$path);
        }
        else{
            $banner = $_POST['old_banner'];
        }

        if(!empty($thumbnail) && !empty($title) && !empty($newsType)
         && !empty($category) && !empty($banner) && !empty($description)){
        
            $sql = "UPDATE `tbl_new` SET
             `title` ='$title', `description` ='$description', `banner` ='$banner', `thumbnail` ='$thumbnail', `news_type` ='$newsType', `category` ='$category' WHERE `id` ='$id'";
            $rs = connection()->query($sql);
            if($rs){
                echo'
                <script>
                $(document).ready(function(){
                    swal({
                    title: "Done",
                    text: " New Insert successfully!",
                    icon: "success",
                    button: "Done",
                        });
                        
                        });
                    </script>
                ';
            }
        }  
        else{
            echo'
            
            <script>
                $(document).ready(function(){
                    swal({
                    title: "Error",
                    text: " please input all New!",
                    icon: "error",
                    button: "Done",
                        });
                        
                        });
                    </script>';
        }      
        }
    }
updateNews();
function getFeedbacknews(){
    if(!empty($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }
    $limitfeedback = ($page-1)*5;
    $sql = "SELECT * FROM `tbl_feedback` ORDER BY `id` DESC LIMIT $limitfeedback,5";
    $rs = connection()->query($sql);
    while ($row = mysqli_fetch_assoc($rs)){
        echo'   
            <tr>
                <td>'.$row['username'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['telephone'].'</td>
                <td>'.$row['address'].'</td>
                <td>'.$row['message'].'</td>
                <td>'.$row['created_at'].'</td>
                <td width="150px">
                    <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Remove
                    </button>
                </td>
            </tr>
        ';
    } 
}
function DeleteFeedbackNews(){

    if (isset($_POST['btn-remove-feedback'])){
        $remove_id = $_POST['remove_idFeedbackNews'];
        $sql = "DELETE FROM `tbl_feedback` WHERE `id` = '$remove_id' ";
        $rs = connection()->query($sql);
        if ($rs){
            echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Done!",
                            text: "Delete feedback news is successfully!",
                            icon: "success",
                            button: "Thank You!",
                        });    
                    });
                </script>
            ';
        }
    }
}
DeleteFeedbackNews();

function addAboutNews(){
    if (isset($_POST['btn-add-about-news'])){
        $description = $_POST['description'];

        if ( !empty($description)){
            $sql = "INSERT INTO `tbl_about_us`(`description`) 
                    VALUES ('$description')";
            $rs = connection()->query($sql);
            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Done!",
                                text: "Add about us news is successfully!",
                                icon: "success",
                                button: "Thank You!",
                            });    
                        });
                    </script>
                ';
            }
        }
        else{
            echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Error!",
                            text: "Add about us news is not successfully!",
                            icon: "error",
                            button: "Thank You!",
                        });    
                    });
                </script>
            ';
        }
    }
}
addAboutNews();

function GetAboutNews(){
    if(!empty($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }
    $limitabout = ($page-1)*5;

    $sql = "SELECT * FROM `tbl_about_us` ORDER BY `id` DESC LIMIT $limitabout,5";
    $rs = connection()->query($sql);
    while ($row = mysqli_fetch_assoc($rs)){
        echo'
            <tr>        
                <td class="text-start">'.$row['description'].'</td>
                <td>'.$row['created_at'].'</td>
                <td width="150px">
                    <a href="update-about-us.php?id='.$row['id'].'"class="btn btn-primary">Update</a>
                    <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Remove
                    </button>
                </td>
            </tr>
        ';
    }
}

function UpdateAboutNews(){
    if (isset($_POST['btn-update-about'])){

        $param_id = $_GET['id']; 
        $description = $_POST['description'];

        if ( !empty($description)){

            $sql = "UPDATE `tbl_about_us` SET `description`='$description' WHERE `id` = '$param_id'";
            $rs = connection()->query($sql);
            if ($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Done!",
                                text: "Update about us successfully!",
                                icon: "success",
                                button: "Thank You!",
                            });    
                        });
                    </script>
                ';
            }
        }
        else{
            echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Not Success!",
                            text: "Update about us not successfully!",
                            icon: "error",
                            button: "Thank You!",
                        });    
                    });
                </script>
            ';
        }
    }
}
UpdateAboutNews();

function DeleteAboutNews(){

    if (isset($_POST['btn-remove-about'])){
        $remove_id = $_POST['remove_idAbout'];
        $sql = "DELETE FROM `tbl_about_us` WHERE `id` = '$remove_id' ";
        $rs = connection()->query($sql);
        if ($rs){
            echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Done!",
                            text: "Delete feedback news is successfully!",
                            icon: "success",
                            button: "Thank You!",
                        });    
                    });
                </script>
            ';
        }
    }
}
DeleteAboutNews();

function AddFollowNews(){
    if (isset($_POST['btn-add-follow'] )){
        $label = $_POST['label'];
        $url = $_POST['url'];
        $status = $_POST['Status'];
        $thumbnail = $_FILES['thumbnail']['name'];

        if ( !empty($status) && !empty($thumbnail) && !empty($label) && !empty($url)){
            $thumbnail = rand(1,9999)."_".$thumbnail;
            $path = 'assets/image/'.$thumbnail;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path);

            $sql = "INSERT INTO `tbl_follow`(`thumbnail`, `label`, `url`, `status`) 
                    VALUES ('$thumbnail','$label','$url','$status')";
            $rs = connection()->query($sql);

            if ($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Done!",
                                text: "Follow to us is successfully!",
                                icon: "success",
                                button: "Thank You!",
                            });    
                        });
                    </script>
                ';
            }
        }
        else{
            echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Error!",
                            text: "Please, You check your information again!",
                            icon: "error",
                            button: "Thank You!",
                        });    
                    });
                </script>
            ';
        }
    }
}
AddFollowNews();

function GetFollowNews(){
    if(!empty($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }
    $limitfollow = ($page-1)*5;
    $sql = "SELECT * FROM `tbl_follow` ORDER BY `id` DESC LIMIT $limitfollow,5";
    $rs = connection()->query($sql);
    while ($row = mysqli_fetch_assoc($rs)){
        echo'
            <tr>        
                
                <td>'.$row['status'].'</td>
                <td style="width: 110px; height: 110px;"><img src="assets/image/'.$row['thumbnail'].'" style="width: 95px; height: 90px; object-fit: cover; "></td>
                <td>'.$row['label'].'</td>
                <td class=" text-start overflow-auto">
                    <a class="text-dark" href="'.$row['url'].'">'.$row['url'].'</a>
                </td>
                <td>'.$row['created_at'].'</td>
                <td width="150px">
                    <a href="update-follow.php?id='.$row['id'].'"class="btn btn-primary">Update</a>
                    <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Remove
                    </button>
                </td>
            </tr>
        ';
    }
}
function UpdateFollowNews(){
    if (isset($_POST['btn-update-follow'])){
        $param_id = $_GET['id']; 
        $label = $_POST['label'];
        $url = $_POST['url'];
        $status = $_POST['status'];
        $thumbnail = $_FILES['thumbnail']['name'];
        if (empty($thumbnail)){
            $thumbnail = $_POST['old_thumbnail'];
        }
        else{
            $thumbnail = rand(1,9999)."_".$thumbnail;
            $path = 'assets/image/'.$thumbnail;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path);
        }
        if (!empty($status) && !empty($thumbnail) && !empty($label) && !empty($url)){

            $sql = "UPDATE `tbl_follow` SET `thumbnail`='$thumbnail',`label`='$label',`url`='$url',`status`='$status' WHERE `id` = '$param_id'";	
            $rs = connection()->query($sql);
            if ($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Done!",
                                text: "Update follow us successfully!",
                                icon: "success",
                                button: "Thank You!",
                            });    
                        });
                    </script>
                ';
            }
        }
        else{
            echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Done!",
                            text: "Update follow us not successfully!",
                            icon: "error",
                            button: "Thank You!",
                        });    
                    });
                </script>
            ';
        }
    }
}
UpdateFollowNews();

function DeleteFollowNews(){
    if (isset($_POST['btn-remove-follow'])){
        $remove_id = $_POST['remove_idFollow'];
        $sql = "DELETE FROM `tbl_follow` WHERE `id` = '$remove_id'";
        $rs = connection()->query($sql);
        if ($rs){
            echo'
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Done!",
                            text: "Delete follow news is successfully!",
                            icon: "success",
                            button: "Thank You!",
                        });    
                    });
                </script>
            ';
        } 
    }
}
DeleteFollowNews();
function pagination($table){
    $sql = "SELECT COUNT(`id`) AS `Total_news` FROM `$table`";
    $rs = connection()->query($sql);
    $row = mysqli_fetch_assoc($rs);
    $totalNews = $row['Total_news'];
    $totalPage = ceil($totalNews/5);
    for ($i=1; $i<=$totalPage; $i++){
        echo '
            <li>    
                <a href="?page='.$i.'">'.$i.'</a>
            </li>
        ';
    }
}