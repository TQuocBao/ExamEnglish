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
