<?php
session_start();
$_con = mysqli_connect("localhost","example","kYcM1XuFebgqftpm","example");
$_con->query("SET NAMES utf8");

if(isset($_POST['action'])){
    switch($_POST['action']){
        case "登入":
            $sql="SELECT * FROM `ex_auth`";
            $query=mysqli_query($_con,$sql);
            $row=mysqli_fetch_assoc($query);
            if($_POST['userpass']==$row['sapass']){
                echo "登入成功";
                $_SESSION['user']=$row['said'];
                $_SESSION['role']=$row['sarole'];
                $_SESSION['name']=$row['saname'];
                header("Location: index.php");
            }else{
                echo "登入失敗";
                header("Location: login.php?err=登入失敗");
            }
        break;
        case "註冊":
            echo $sql="INSERT INTO `ex_auth` (`said`, `sapass`, `saname`, `sarole`) VALUE ('{$_POST['userid']}','{$_POST['userpass']}','{$_POST['username']}','R')";
            if($query=mysqli_query($_con,$sql)){
                echo "註冊成功";
            }else{
                echo "註冊失敗";
            }

        break;
    }
}


?>