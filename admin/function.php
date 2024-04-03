<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
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
                $path ='assets/Adminthumbnail'.$profile;
                move_uploaded_file($_FILES['profile']['tmp_name'],$path);

                $sql = "INSERT INTO `tbl_user`(`username`, `email`, `password`, `thumbnail`) VALUES ('$username', '$email', '$password','$profile')";

                $rs = connection()->query($sql);
                if($rs){
                    echo '
                    <script>
                    $(document).ready(function(){
                        swal({
                        title: "Done  For(>_<)",
                        text: "Delete Already!",
                        icon: "success",
                        button: "Done",
                            });
                            
                            });
                        </script>
                    ';
                }
            }
        }
    }
register();

?>