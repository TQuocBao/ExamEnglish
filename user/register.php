<?php include '../inc/header.php'?>
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
        if(isset($_POST['btn_dangky'])){
            if(empty($_POST['fullname_dangky']) || empty($_POST['email_dangky'])|| empty($_POST['password_dangky'])||empty($_POST['Re_pass'])){
                echo ' <center><p style="color: red;">Thông tin chưa điền đầy đủ!</p></center>';
            }
            else{
                $fullname = $_POST['fullname_dangky'];
                $email = $_POST['email_dangky'];
                $password = $_POST['password_dangky'];
                $length_pass = strlen($password);
                $repass = $_POST['Re_pass'];
                $check = $data->check("select * from nguoidung where email ='".$email."' ");
                if($check == true){
                    if($length_pass>=6 && $length_pass<=12){

                        if($password != $repass){
                            echo ' <center><p style="color: red;">Mật khẩu không khớp!</p></center>';
                        }
                        else{
                            $rand = 0;
                            $re = $data->ManipulationDB("insert into nguoidung values('".$email."','".$password."','".$fullname."','".$rand."')");
                            header('location:index.php');
                        }
                    }
                    else
                        echo ' <center><p style="color: red;">Độ dài mật khẩu không hợp lệ!</p></center>';
                }
                else{
                    echo ' <center><p style="color: red;">Tài khoản đã tồn tại!</p></center>';
                }
            }
        }
        else{
            echo ' <center><p style="color: blue;">Xin mời nhập thông tin</p></center>';
        }
     ?>
     <?php 
            if(isset($_POST['back'])){
                header('location:index.php');
            }

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
        <input name="email_dangky" type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail">
         <input name="fullname_dangky" type="text" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="FullName">
        <!-- Password -->
        <input name="password_dangky" type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password(độ dài 6-12)">
        <input name="Re_pass" type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="RE-Password">

        <!-- Sign in button -->
        <button name="btn_dangky" class="btn btn-info btn-block my-4" type="submit">Đăng ký</button>
        <button name="back" class="btn btn-info btn-block my-4" type="submit">Quay lại đăng nhập</button>

        
    </form>

<?php include '../inc/footer.php'?>