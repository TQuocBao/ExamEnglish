<?php
include '../inc/header.php';
?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/313025c77d.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
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
        if(isset($_SESSION['users'])){
            $user = $_SESSION['users'];
        }
        else
            header('location:index.php');
        $show_name = $data->ManipulationDB("select * from nguoidung where email = '".$user."'");
        $arr = mysqli_fetch_array($show_name);
     ?>
<body>
    <div class="jumbotron text-center">
        <h1 class="display-4">Hello<?php echo "  ".@$arr['fullname']; ?></h1>
        <p class="lead">Đây là trang thi thử THPTQG bộ môn Tiếng Anh</p>
        <hr class="my-4">
        <p>Bạn đã sẵn sàng?</p>
        <a class="btn btn-primary btn-lg" href="showDe.php?q=1" role="button">Start Test</a>
	<a class="btn btn-primary btn-lg" href="manager.php?" role="button">Quay lại trang chủ</a>
    </div>
</body>

</html>
<?php include '../inc/footer.php' ?>