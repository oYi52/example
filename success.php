<?php 
session_start();

if(isset($_SESSION['user'])){
    echo "<h1>這段文字登入之後才看的到</h1>";
    echo "<hr>".$_SESSION['user'];
}else{
    echo "<h1>你還沒登入</h1>";
    header("Location: login.php");
}
?>