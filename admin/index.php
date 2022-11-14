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