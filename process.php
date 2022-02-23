<?php

$_con = mysqli_connect("localhost","example","kYcM1XuFebgqftpm","example");


if(isset($_POST['action'])&&$_POST['action']=="新增作品"){
    if(isset($_FILES['wofile'])){
        //定義上傳路徑
        echo $upload_dir="uploadfiles/".$_POST['wocategory']."/";

        //確認路徑是否存在
        if(!is_dir($upload_dir)){
            //如果不存在，就新增並給予權限
            if(!mkdir($upload_dir,0755)){
                header("Location: index.php?result=mkdirfailed");
                exit;
            }
        }
        //宣告允許上傳的附檔名陣列
        $allow_ext=array("jpg","png","pdf","tif");
        //檔案上傳的檔名
        $filename=$_FILES['wofile']['name'];
        //透過檔名取得附檔名資訊
        $ext=strtolower(pathinfo($_FILES['wofile']['name'], PATHINFO_EXTENSION));
        
        //檢查是否為可上傳之副檔名
        if(in_array($ext,$allow_ext)){
            //插入一筆記錄，這裡會先插入一筆記錄是因為等等要用到這筆記錄的ID
            echo $sql ="INSERT INTO `ex_works` (`woid`, `wocategory`, `wotitle`, `woyear`, `womaterial`, `wosize`, `wostatus`, `woext`) VALUES (NULL, '".$_POST['wocategory']."', '".$_POST['wotitle']."', '".$_POST['woyear']."', '".$_POST['womaterial']."', '".$_POST['wosize']."', '".$_POST['wostatus']."', '".$ext."');";
            $query = mysqli_query($_con, $sql);
            if($query){
                //將上傳目的地、剛剛插入的紀錄ID跟附檔名合成成新的檔名
                $new_file_name=$upload_dir.mysqli_insert_id($_con).".".$ext;
                //搬移檔案至目的地，並確認有沒有完成
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


if(isset($_POST['action'])&&$_POST['action']=="刪除"){
    echo $sql ="DELETE FROM `ex_works` WHERE `woid` = '".$_POST['woid']."'";
    $query = mysqli_query($_con, $sql);
    header("Location: index.php?result=deleted");
    exit;
}


if(isset($_POST['action'])&&$_POST['action']=="編輯作品"){

    //先編輯文本
    $sql = "UPDATE `ex_works` SET `wocategory` = '".$_POST['wocategory']."', `wotitle` = '".$_POST['wotitle']."', `woyear` = '".$_POST['woyear']."', `womaterial` = '".$_POST['womaterial']."', `wosize` = '".$_POST['wosize']."', `wostatus` = '".$_POST['wostatus']."' WHERE `woid` = ".$_POST['woid'];
    $query = mysqli_query($_con, $sql);

    //判斷是否有改類別
    /* 這次的回家作業寫在這裡 */
    if($_POST['wocategory']!=$_POST['wocatorigin']){
        $origin_dir="uploadfiles/".$_POST['wocatorigin']."/";
        $new_dir="uploadfiles/".$_POST['wocategory']."/";
        $file_name = $_POST['woid'].".".$_POST['woext'];

        rename($origin_dir.$file_name,$new_dir.$file_name);

    }
    
    //再判斷是不是有重新上傳檔案
    if(isset($_FILES['wofile'])){
        //定義路徑
        echo $upload_dir="uploadfiles/".$_POST['wocategory']."/";

        //確認路徑是否存在
        if(!is_dir($upload_dir)){
            //如果不存在，就新增並給予權限
            if(!mkdir($upload_dir,0755)){
                header("Location: index.php?result=mkdirfailed");
                exit;
            }
        }
        //宣告允許上傳的附檔名陣列
        $allow_ext=array("jpg","png","pdf","tif");
        //檔案上傳的檔名
        $filename=$_FILES['wofile']['name'];
        //透過檔名取得附檔名資訊
        $ext=strtolower(pathinfo($_FILES['wofile']['name'], PATHINFO_EXTENSION));
        
        //檢查是否為可上傳之副檔名
        if(in_array($ext,$allow_ext)){
            //將上傳目的地、剛剛插入的紀錄ID跟附檔名合成成新的檔名
            $new_file_name=$upload_dir.$_POST['woid'].".".$ext;
            //搬移檔案至目的地，並確認有沒有完成
            if(move_uploaded_file($_FILES['wofile']['tmp_name'],$new_file_name)){
                $sql = "UPDATE `ex_works` SET `woext` = '".$ext."' WHERE `woid` = ".$_POST['woid'];
                $query = mysqli_query($_con, $sql);
                header("Location: index.php?result=success");
                exit;
            }else{
                header("Location: index.php?result=unabletoupload");
                exit;
            }
        }else{
            header("Location: index.php?result=invailedext");
            exit;

        }
    }else{
        header("Location: index.php?result=editsucandnofile");
        exit;
    }
}



?>