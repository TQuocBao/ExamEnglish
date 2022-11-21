<?php include '../inc/header.php';?>
<?php session_start();  ?>
<?php 
            require '../database/database.class.php';

            $config = [
                'host' => 'localhost',
                'user' => 'root',
                'pass' => '',
                'nameDB' => 'tienganh'
            ];
            $data = new database($config);
         ?>

         <?php 
         ob_start();
            if(isset($_POST['btn_admin'])){
                if(empty($_POST['email_admin']) || empty($_POST['password_admin'])){

                    echo ' <center><p style="color: red;">Xin hãy nhập tài khoản và mật khẩu!</p></center>';

                }
                else{
                    $email_admin = $_POST['email_admin'];
                    $password_admin = $_POST['password_admin'];

                    $result = $data->ManipulationDB('select * from admin where email_admin ="'.$email_admin.'"');
                    $arr = mysqli_fetch_array($result);

                    if($email_admin == @$arr['email_admin']){
                        if($password_admin == $arr['matkhau_admin']){
                            if(isset($_POST['check_admin'])){
                                setcookie('user_admin',$email_admin,time()+(60*3));
                                setcookie('pass_admin',$password_admin,time()+(60*3));
                            }
                            $_SESSION['admin'] = $email_admin;
                            header('location:manager.php');
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
<!DOCTYPE html>
<html lang="en">

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
<body>
    
    <!-- Default form login -->
    <form class="text-center border border-light w-25 p-3 mx-auto" action="#!" method="post" >

        <p class="h4 mb-4">Admin Login</p>

        <!-- Email -->
        <input name="email_admin" type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail" value="<?php 
            if(isset($_COOKIE['user_admin']))
                echo ($_COOKIE['user_admin']);
            else echo "";?>">

        <!-- Password -->
        <input name="password_admin" type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" value="<?php 
            if(isset($_COOKIE['pass_admin']))
                echo ($_COOKIE['pass_admin']);
            else echo "";?>">

        <div class="d-flex justify-content-around">
            <div>
                <!-- Remember me -->
                <div class="custom-control custom-checkbox">
                    <input name="check_admin" type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                    <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
                </div>
            </div>
        </div>

        <!-- Sign in button -->
        <button name="btn_admin" class="btn btn-info btn-block my-4" type="submit">Sign in</button>

    </form>
    <!-- Default form login -->
</body>

</html>

<?php
    include '../inc/footer.php';
?>
