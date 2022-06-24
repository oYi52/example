<?php
session_start();
$_con = mysqli_connect("localhost","example","kYcM1XuFebgqftpm","example");
$_con->query("SET NAMES utf8");

function saltPassword($password, $salt) {
    $oriSaltPass=hash('sha256', $password . $salt);
    return substr($oriSaltPass,0,5).substr($oriSaltPass,-5);
}


if(isset($_POST['action'])){
    switch($_POST['action']){
        case "登入":
            $sql="SELECT * FROM `ex_auth` WHERE `said` = '".$_POST['userid']."'";
            $query=mysqli_query($_con,$sql);
            $row=mysqli_fetch_assoc($query);
            echo saltPassword($_POST['userpass'],$row['salt']);
            echo "<br>";
            echo $row['sapass'];
            if(saltPassword($_POST['userpass'],$row['salt'])==$row['sapass']){
                echo "登入成功";
                $_SESSION['user']=$row['said'];
                $_SESSION['role']=$row['sarole'];
                $_SESSION['name']=$row['saname'];
                header("Location: index.php");
                exit;
            }else{
                echo "登入失敗";
                header("Location: login.php?err=登入失敗");
                exit;
            }
        break;
        case "註冊":
            $salt=substr(md5(time()),0,5);
            $encryptPass=saltPassword($_POST['userpass'],$salt);
            echo $sql="INSERT INTO `ex_auth` (`said`, `sapass`, `salt`, `saname`, `sarole`) VALUE ('{$_POST['userid']}','{$encryptPass}','{$salt}','{$_POST['username']}','R')";
            if($query=mysqli_query($_con,$sql)){
                echo "註冊成功";
            }else{
                echo "註冊失敗";
            }

        break;
    }
}


?>