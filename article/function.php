<!-- @import jquery & sweet alert  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php 
function connection(){
    $connection = new mysqli('localhost','root','','project');
    return $connection;
}
 function getlogo($status){
    $sql = "SELECT *FROM `tbl_logo` WHERE `status` = '$status' ORDER BY `id` DESC LIMIT 3";
    $rs= connection()->query($sql);
    $row = mysqli_fetch_assoc($rs);
    echo $row['thumbnail'];
 }
 function getNews($newsType){
        $sql = "SELECT * FROM `tbl_new` WHERE `news_type` = '$newsType' ORDER BY `id` DESC LIMIT 3";
        $rs = connection()->query($sql);
        while($row = mysqli_fetch_assoc($rs)){
             echo '
                <div class="col-4">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'&Type='.$row['news_type'].'">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['thumbnail'].'" width="350px" height="200" alt="">
                            <div class="title">
                                '.$row['title'].'
                            </div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
 }

 function newDetail(){
    $id = $_GET['id'];
    $rs = connection()->query("SELECT * FROM `tbl_new` WHERE `id` ='$id'");
    $row = mysqli_fetch_assoc($rs);
     echo '
      <div class="col-4">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['banner'].'" width="730px" height="415px" alt="">
                            <div class="title">
                                '.$row['title'].'
                            </div>
                            </div>
                        </a>
                    </figure>
                </div>
     ';
     $newViewer = $row['viewer']+1;
     $sqlUpdate = "UPDATE `tbl_new` SET `viewer` = '$newViewer' WHERE `id`= '$id'";
     $rsUpdate = connection()->query($sqlUpdate);
 }

function trendingNews(){
    $sql = "SELECT *FROM `tbl_new` ORDER BY `viewer` DESC LIMIT 1";
    $rs = connection()->query($sql);
    $row = mysqli_fetch_assoc($rs);
    echo '
    <div class="col-4">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'&Type='.$row['news_type'].'">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['banner'].'" width="730px" height="415px" alt="">
                            <div class="title">
                                '.$row['title'].'
                            </div>
                            </div>
                        </a>
                    </figure>
                </div>
    ';
}
function mainTrendingNews(){
    $sqlID = "SELECT `id` FROM `tbl_new` ORDER BY `viewer` DESC LIMIT 1";
    $rsID = connection()->query($sqlID);
    $rowID = mysqli_fetch_assoc($rsID);
    $id = $rowID['id'];
    $sql = "SELECT *FROM `tbl_new` WHERE `id` !='$id' ORDER BY `viewer` DESC LIMIT 2";
    $rs = connection()->query($sql);
    while($row = mysqli_fetch_assoc($rs)){
        echo'
        <div class="col-12">
        <figure>
            <a href="news-detail.php?id='.$row['id'].'&Type='.$row['news_type'].'">
                <div class="thumbnail">
                    <img src="../admin/assets/image/'.$row['banner'].'" width="350px" height="200px" alt="">
                <div class="title">
                    '.$row['title'].'
                </div>
                </div>
            </a>
        </figure>
    </div>
        ';
    }
}
function relatedNews(){
    $id = $_GET['id'];
    $newType = $_GET['Type'];  
    $sql  = "SELECT * FROM `tbl_new` WHERE `news_type`='$newType' AND `id` != '$id' ORDER BY `id` DESC LIMIT 2";
    $rs   = connection()->query($sql);
        while($row = mysqli_fetch_assoc($rs)){
            echo '
            <figure>
                <a href="news-detail.php?id='.$row['id'].'&Type='.$row['news_type'].'">
                <div class="thumbnail">
                <img src="../admin/assets/image/'.$row['thumbnail'].'" width="350px" height="200" alt="">
                </div>
                <div class="detail">
                    <h3 class="title">'.$row['title'].'</h3>
                    <div class="date">'.$row['created_at'].'</div>
                    <div class="description">
                        '.$row['description'].'
                        </div>
                    </div>
                </a>
            </figure>

            ';
    }
}
function tredingMaquee(){
    $rs = connection()->query("SELECT * FROM `tbl_new` ORDER BY `viewer` DESC LIMIT 2");
    while($row = mysqli_fetch_assoc($rs)){
        echo '
            <i class="fas fa-angle-double-right"></i>
            <a href="news-detail.php?id='.$row['id'].'&Type='.$row['news_type'].'">'.$row['title'].'</a> &ensp;
        ';
    }
}

function getNewsByNewType($Type, $category){
    $sql = "SELECT * FROM `tbl_new` WHERE `news_type` ='$Type' AND `category` ='$category' ORDER BY `id` DESC";
    $rs = connection()->query($sql);
    while($row = mysqli_fetch_assoc($rs)){
        echo'
        <figure>
            <a href="news-detail.php?id='.$row['id'].'&Type='.$row['news_type'].'">
            <div class="thumbnail">
            <img src="../admin/assets/image/'.$row['thumbnail'].'" width=350px" height="200px" alt="">
            </div>
            <div class="detail">
            <h3 class="title">'.$row['title'].'</h3>
            <div class="date">'.$row['created_at'].'</div>
            <div class="description">
            '.$row['description'].'
            </div>
            </div>
            </a>
        </figure>
        ';
    }
}
function pagination($Type,$category){
    $sql ="SELECT COUNT(`id`) AS 'Total_News' FROM `tbl_new` WHERE `news_type` = '$Type' AND `category`= '$category'";
    $rs =connection()->query($sql);
    $row = mysqli_fetch_assoc($rs);
    $totalNews = $row['Total_News'];
    $totalPage = ceil($totalNews /3);
    for($i=1;$i<$totalPage;$i++){
        echo '
        <li>
        <a href="?page='.$i.'">'.$i.'</a>
        </li>
        ';
    }
}
function search(){
    $query = $_GET['query'];
    $sql = "SELECT * FROM `tbl_new` WHERE `title`  LIKE '%$query%' ORDER BY `id` DESC";
    $rs = connection()->query($sql);
    while ($row = mysqli_fetch_assoc($rs)){
        echo '
                <div class="col-4">
                    <figure>
                        <a href="news-detail.php?id='.$row['id'].'&Type='.$row['news_type'].'">
                            <div class="thumbnail">
                            <img src="../admin/assets/image/'.$row['thumbnail'].'" width="350px" height="200" alt="">
                            </div>
                            <div class="detail">
                                <h3 class="title">'.$row['title'].'</h3>
                                <div class="date">'.$row['created_at'].'</div>
                                <div class="description">
                                    '.$row['description'].'
                                </div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
    }
}
function AddFeedback(){
    if (isset($_POST['btn_message'] )){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $address = $_POST['address'];
        $message = $_POST['message'];

        if ( !empty($username) && !empty($email) && !empty($telephone) && !empty($address) && !empty($message)){

            $sql = "INSERT INTO `tbl_feedback`(`username`, `email`, `telephone`, `address`, `message`) 
                    VALUES ('$username','$email','$telephone','$address','$message')";
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
AddFeedback();
function getAboutNews(){
    $sql = "SELECT * FROM `tbl_about_us` ORDER BY `id` DESC LIMIT 1";
    $rs = connection()->query($sql);
    while ($row = mysqli_fetch_assoc($rs)){
        echo'
            <P style="font-weight: 500; font-size: 20px;">'.$row['description'].'</P>
        ';
    }
}
function getFollowNews($status,$label){
    $sql = "SELECT * FROM `tbl_follow` WHERE `status`='$status' AND `label` = '$label' ORDER BY `id` DESC LIMIT 1";
    $rs  = connection()->query($sql);
    $row = mysqli_fetch_assoc($rs);
    echo $row['thumbnail'];
}
function getFollowNewsUrl($label){
    $sql = "SELECT * FROM `tbl_follow` WHERE `label`='$label' ";
    $rs  = connection()->query($sql);
    $row = mysqli_fetch_assoc($rs);
    echo $row['url'];
}

