<?php

/*
echo $_POST['wocategory'];
echo $_POST['wotitle'];
echo $_POST['woyear'];
echo $_POST['womaterial'];
echo $_POST['wosize'];
echo $_POST['wostatus'];
echo $_POST['wofile'];
*/
$_con = mysqli_connect("localhost","example","kYcM1XuFebgqftpm","example");

if(isset($_POST['action'])&&$_POST['action']=="新增作品"){
    if(isset($_FILES['wofile'])){
        //定義上傳路徑
        $upload_dir="uploadfiles/".$_POST['wocategory']."/";
        if(!is_dir($upload_dir)){
            if(!mkdir($upload_dir)){
                header("Location: index.php?result=mkdirfailed");
                exit;
            }
        }
        
        $allow_ext=array("jpg","png","pdf","tif");
        echo $filename=$_FILES['wofile']['name'];
        echo $ext=strtolower(pathinfo($_FILES['wofile']['name'], PATHINFO_EXTENSION));

        if(in_array($ext,$allow_ext)){
            echo $sql ="INSERT INTO `ex_works` (`woid`, `wocategory`, `wotitle`, `woyear`, `womaterial`, `wosize`, `wostatus`, `woext`) VALUES (NULL, '".$_POST['wocategory']."', '".$_POST['wotitle']."', '".$_POST['woyear']."', '".$_POST['womaterial']."', '".$_POST['wosize']."', '".$_POST['wostatus']."', '".$ext."');";
            $query = mysqli_query($_con, $sql);
            if($query){
                $new_file_name=$upload_dir.mysqli_insert_id($_con).".".$ext;
                if(move_uploaded_file($_FILES['wofile']['tmp_name'],$new_file_name)){
                    header("Location: index.php?result=success");
                    exit;
                }else{
                    header("Location: index.php?result=unabletoupload");
                    exit;
                }
            }else{
                header("Location: index.php?result=failed");
                exit;
            }
        }else{
            header("Location: index.php?result=invailedext");
            exit;

        }
    }else{
        header("Location: index.php?result=nofile");
        exit;
    }
}

/*
    //判斷輸入值是否為數字
    if(!(is_numeric($_POST['i'])&&is_numeric($_POST['j']))){
        echo "輸入值非數字！";
        exit;
    }
    //設定結果的初值
    $result = 0;
    //判斷運算方式
    switch($_POST['count']){
        case "1":
            $result = $_POST['i']+$_POST['j'];
            break;
        case "2":
            $result = $_POST['i']-$_POST['j'];
            break;
        case "3":
            $result = $_POST['i']*$_POST['j'];
            break;
        case "4":
            $result = $_POST['i']/$_POST['j'];
            break;
        default:
            echo "輸入錯誤";
            break;
    }

    //定義運算子顯示符號的鍵值
    $count_dis = array( "1"=>"+",
                        "2"=>"-",
                        "3"=>"*",
                        "4"=>"/"
                    );

    //顯示運算過程&結果
    echo $_POST['i'].$count_dis[$_POST['count']].$_POST['j']."=".$result;
    //將運算過程與結果傳送回原來的頁面
    header("Location: index.php?i=".$_POST['i']."&j=".$_POST['j']."&count=".$_POST['count']."&result=".$result);
    exit;
*/
?>