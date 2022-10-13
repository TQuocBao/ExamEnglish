<?php include '../inc/header.php'?>
<?php session_start(); ?>
<?php 
            require '../database/database.class.php';

            $config = [
                'host' => 'localhost',
                'user' => 'root',
                'pass' => '',
                'nameDB' => 'databasetienganh'
            ];
            $data = new database($config);
         ?>

         <?php 
         ob_start();
            if(isset($_POST['btn_dangnhap'])){
                if(empty($_POST['email_dangnhap']) || empty($_POST['password_dangnhap'])){
                    echo ' <center><p style="color: red;">Xin hãy điền đầy đủ tài khoản và mật khẩu!</p></center>';
                }
                else{
                    $email_dangnhap = $_POST['email_dangnhap'];
                    $password_dangnhap = $_POST['password_dangnhap'];
                    $result = $data->ManipulationDB('select * from nguoidung where email ="'.$email_dangnhap.'"');
                    $arr = mysqli_fetch_array($result);
                    if($email_dangnhap == @$arr['email']){
                        if($password_dangnhap == $arr['matkhau']){
                            if(isset($_POST['check_Users'])){
                                setcookie('user_name',$email_dangnhap,time()+(60*3));
                                setcookie('pass_word',$password_dangnhap,time()+(60*3));
                            }
                            $_SESSION['users'] = $email_dangnhap;
 			
                            header('location: manager.php');
                        }
                        else
                             echo ' <center><p style="color: red;">Sai mật khẩu!</p></center>';
                    }
                    else
                         echo ' <center><p style="color: red;">Tài khoản không tồn tại</p></center>';
                }
            }
            ob_end_flush();
          ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/313025c77d.js" crossorigin="anonymous"></script>
    <title>Online Exam English</title>
</head>

<form class="text-center border border-light w-25 p-3 mx-auto" action="" method="post" >

        <p class="h4 mb-4">LOGIN</p>

        <!-- Email -->
        <input name="email_dangnhap" type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail" value="<?php 
            if(isset($_COOKIE['user_name']))
                echo ($_COOKIE['user_name']);
            else echo "";?>">

        <!-- Password -->
        <input name="password_dangnhap" type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" value="<?php 
            if(isset($_COOKIE['pass_word']))
                echo ($_COOKIE['pass_word']);
            else echo "";?>">
        <div class="custom-control custom-checkbox">
                    <input name="check_Users" type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                    <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
        </div>
        <div class="d-flex justify-content-around">

            <div>
                <a href="register.php">Đăng ký?</a> Nếu bạn chưa có tài khoản
            </div>
        </div>
        <!-- Sign in button -->
        <button name="btn_dangnhap" class="btn btn-info btn-block my-4" type="submit" >Sign in</button>
    </form>
   <?php include'../inc/footer.php '?>