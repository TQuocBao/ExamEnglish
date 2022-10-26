<?php session_start(); ?>
<?php include '../inc/header.php' ?>
<?php include '../inc/navbar1.php'?>
<?php 
	if(isset($_SESSION['users'])){
            $user = $_SESSION['users'];
        }
        else
            header('location:index.php');
 ?>
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
   
<html>

<body>

<table align="center" >
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >

        
       
        <tr><td><input name="password_old" 	type="password"  placeholder="Password-old"></tr></td>
        <tr><td><input name="password_new" 	type="password"  placeholder="Password-new(độ dài 6-12)"></tr></td>
	<tr><td><input name="repassword_new" type="password"  placeholder="RE-Password-new">

        
        <tr><td><button name="btn_sua"  type="submit" class="btn btn-primary btn-lg" role="button" >Cập nhật</button></tr></td>
        
        
    </form>
</table>

</body>
</html>
<?php
if(isset($_POST['btn_sua']))
{
	if(isset($_SESSION['users']))
		{
            if(empty($_POST['password_old']) || empty($_POST['password_new'])|| empty($_POST['repassword_new']))
			{
                echo ' <center><p style="color: red;">Thông tin chưa điền đầy đủ!</p></center>';
            }
			else
			{
                $pass_old = $_POST['password_old'];
                $pass_new = $_POST['password_new'];
                $repass_new = $_POST['repassword_new'];
                $length_passnew = strlen($pass_new);
		$email=$user;
                $check = $data->ManipulationDB('select * from nguoidung where email ="'.$email.'"');
				if($row=mysqli_fetch_array($check))
				{
					
					if($row['matkhau']==$pass_old)
					{
					 if( $pass_new== $repass_new )
						if($length_passnew>=6 && $length_passnew<=12)
						{
						
							{
								$result = $data->ManipulationDB("update nguoidung set matkhau='".$pass_new."' where email='".$email."'");
								if($result)
								{
									echo ' <center><p style="color: red;">Đổi mật khẩu thành công thành công</p></center>';
								}
								else
								{
									echo ' <center><p style="color: red;">Thay đổi mật khẩu không thành công</p></center>';
								}
								
							}
						}
						else
							echo ' <center><p style="color: red;">Độ dài mật khẩu không hợp lệ!</p></center>';
						else
						{
							echo ' <center><p style="color: red;">Nhập lại mật khẩu không khớp</p></center>';
						}
					}
					else
					{
						echo ' <center><p style="color: red;"> Mật khẩu không hợp lệ!</p></center>';
					}
				}
                else
				{
                    echo ' <center><p style="color: red;">Tài khoản đã tồn tại!</p></center>';
                }
            }
		}
	else
	{
			echo ' <center><p style="color: blue;">Xin mời nhập thông tin</p></center>';
	}
}	
?>
<?php include '../inc/footer.php' ?>
