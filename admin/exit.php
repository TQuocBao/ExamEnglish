<?php session_start(); ?>
<?php 
            if(isset($_SESSION['admin'])){
              session_unset();
              session_destroy();
            }
            header('location:../admin');
          ?>