<?php 

$_con = mysqli_connect("localhost","example","kYcM1XuFebgqftpm","example");

//載入分類清單
$sql ="SELECT * FROM `ex_category`";
$query = mysqli_query($_con, $sql);
$category = array();
while($row=mysqli_fetch_assoc($query)){ 
    $category[$row['wcid']]=$row;
}
/* 分類清單陣列JSON化 JSON VIEWER: http://jsonviewer.stack.hu/ */
// echo json_encode($category);

//載入作品清單
$sql ="SELECT * FROM `ex_works`";
$query = mysqli_query($_con, $sql);
$content = array();
while($row=mysqli_fetch_assoc($query)){
    $content[$row["woid"]]=$row;
    $content[$row["woid"]]['wocatname']=$category[$row["wocategory"]]['wcname'];
}
/* 作品清單陣列JSON化 JSON VIEWER: http://jsonviewer.stack.hu/ */
// echo json_encode($content);

?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>作品文物</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>
<body>

<div class="container mb-3">
    <?php   if(isset($_GET['result'])&&$_GET['result']=="success"){echo "<h3>新增成功!</h3>";} 
            if(isset($_GET['result'])&&$_GET['result']=="failed"){echo "<h3>新增失敗!</h3>";} 
            if(isset($_GET['result'])&&$_GET['result']=="nofile"){echo "<h3>未選擇檔案!</h3>";} ?>
    <!--主要內容區塊-->
    <div class="card mt-3 p-3">
        <div class="row">
            <div class="col-4">
                <h2>作品列表</h2>
            </div>
            <div class="col-2 offset-6">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                新增作品
            </button>
            </div>
        </div>
        <!--頁籤按鈕組-->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-image-tab" data-bs-toggle="tab" data-bs-target="#nav-image" type="button" role="tab" aria-controls="nav-image" aria-selected="true">圖像顯示</button>
                <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false">列表顯示</button>
                <button class="nav-link" id="nav-category-tab" data-bs-toggle="tab" data-bs-target="#nav-category" type="button" role="tab" aria-controls="nav-category" aria-selected="false">編輯分類</button>
            </div>
        </nav>
        <!--./頁籤按鈕組-->
        <!--頁籤按鈕影響到的內容框架-->
        <div class="tab-content mt-3" id="nav-tabContent">
            <!--圖像顯示區塊-->
            <div class="tab-pane fade show active" id="nav-image" role="tabpanel" aria-labelledby="nav-image-tab">
                <div class="row">
                    <?php foreach($content as $key => $value){  ?>
                        <div class="col-3">
                        <div class="card">
                            <img src="uploadfiles/<?php echo $value['wocategory']."/".$value['woid'].".".$value['woext']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $value['wotitle']; ?></h5>
                                <ul>
                                    <li><?php echo $value['woyear']; ?></li>
                                    <li><?php echo $value['womaterial']; ?></li>
                                    <li><?php echo $value['wosize']; ?></li>
                                    <li><?php echo $value['wostatus']; ?></li>
                                </ul>
                            </div>
                        </div>
                        </div>
                    <?php }  ?>
                </div>
            </div>
            <!--./圖像顯示區塊-->
            <!--列表顯示區塊-->
            <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>作品分類</th>
                            <th>作品名稱</th>
                            <th>年份</th>
                            <th>材質</th>
                            <th>尺寸</th>
                            <th>收藏狀態</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($content as $key => $value){ ?>
                        <tr>
                            <td><?php echo $value['wocatname']; ?></td>
                            <td><a href="index.php?id=<?php echo $value['woid']; ?>"><?php echo $value['wotitle']; ?></a></td>
                            <td><?php echo $value['woyear']; ?></td>
                            <td><?php echo $value['womaterial']; ?></td>
                            <td><?php echo $value['wosize']; ?></td>
                            <td><?php echo $value['wostatus']; ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $value['woid']; ?>" class="btn btn-sm btn-success">編輯</a>
                                <form action="process.php" method="POST">
                                    <input type="hidden" name="woid" value="<?php echo $value['woid']; ?>">
                                    <input type="submit" name="action" class="btn btn-sm btn-danger" value="刪除" onclick="return confirm('確認要刪除嗎？')">
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!--./列表顯示區塊-->
            <!--分類列表區塊-->
            <div class="tab-pane fade" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab">
                <h1>分類列表</h1>
                <hr>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>順序</th>
                            <th>分類名稱</th>
                            <th>分類說明</th>
                            <th>操作</th>
                            <td>刪除</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($category as $key => $value){ ?>
                            <tr>
                                <td><?php echo $value['wcorder']; ?></td>
                                <td><?php echo $value['wcname']; ?></td>
                                <td><?php echo $value['wcbrief']; ?></td>
                                <td>
                                    ↑向上｜↓向下
                                </td>
                                <td><a class="btn btn-sm btn-success" href="index.php?tab=category&editcat=<?php echo $key; ?>">編輯</a><form action="process.php" method="POST"><input type="hidden" name="wcid" value="<?php echo $key; ?>"><input type="submit" class="btn btn-sm btn-danger" name="action" value="刪除分類" onclick="return confirm('確定要刪除嗎？')"></form></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!--新增分類區塊-->
                <?php if(!isset($_GET['editcat'])){ ?>
                <div class="card">
                    <div class="card-body">
                        <form action="process.php" method="POST">
                            <h5>新增分類</h5>
                            <label for="wcname">分類名稱</label>
                            <input type="text" class="form-control" name="wcname" id="wcname" placeholder="請輸入分類">
                            <input type="hidden" name="wcorder" value="<?php echo count($category)+1; ?>">
                            <label for="wcbrief">分類介紹</label>
                            <textarea name="wcbrief" id="wcbrief" cols="30" rows="10" class="form-control"></textarea>
                            <hr>
                            <input type="submit" class="btn btn-success form-control" name="action" value="新增分類">
                        </form>
                    </div>
                </div>
                <?php }else{ ?>
                <!--./新增分類區塊-->
                <!--編輯分類區塊-->
                <div class="card">
                    <div class="card-body">
                        <form action="process.php" method="POST">
                            <h5>編輯「<?php echo $category[$_GET['editcat']]['wcname']; ?>」分類</h5>
                            <label for="wcname">分類名稱</label>
                            <input type="hidden" name="wcid" value="<?php echo $_GET['editcat']; ?>">
                            <input type="text" class="form-control" name="wcname" id="wcname" placeholder="請輸入分類" value="<?php echo $category[$_GET['editcat']]['wcname']; ?>">
                            <label for="wcbrief">分類介紹</label>
                            <textarea name="wcbrief" id="wcbrief" cols="30" rows="10" class="form-control"><?php echo $category[$_GET['editcat']]['wcbrief']; ?></textarea>
                            <hr>
                            <input type="submit" class="btn btn-success form-control" name="action" value="編輯分類">
                        </form>
                    </div>
                </div>
                <?php } ?>
                <!--./編輯分類區塊-->
            </div>
            <!--./分類列表區塊-->
        </div>
        <!--./頁籤按鈕影響到的內容框架-->
    </div>
    <!--./主要內容區塊-->
    <!--檢視作品Modal-->
    <?php
    //檢查GET變數是否為檢視模式(判斷方式：是否有在id變數中指定作品ID)
    if(isset($_GET['id'])){ 
        $sql ="SELECT * FROM `ex_works` WHERE `woid` = '".$_GET['id']."'";
        $query = mysqli_query($_con, $sql);
        $row = mysqli_fetch_assoc($query);   
    ?>
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel"><?php echo $row['wotitle']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="uploadfiles/<?php echo $row['wocategory']."/".$row['woid'].".".$row['woext']; ?>" class="img-fluid" alt="">
            </div>
            <div class="modal-footer">
                <a href="uploadfiles/<?php echo $row['wocategory']."/".$row['woid'].".".$row['woext']; ?>" class="btn btn-primary" download="<?php echo $row['wotitle'].".".$row['woext']; ?>">下載</a>
            </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!--./檢視作品Modal-->
    <!-- 新增作品Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">新增作品</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            <label for="">作品分類</label>
                            <select name="wocategory" id="wocategory" class="form-control">
                                <?php foreach ($category as $key => $value){ ?>
                                    <option value="<?php echo $value['wcid']; ?>"><?php echo $value['wcname']; ?></option>
                                <?php } ?>
                            </select>
                            <label>作品名稱</label>
                            <input type="text" name="wotitle" id="wotitle" class="form-control" required>
                            <label>年份</label>
                            <input type="text" name="woyear" id="woyear" class="form-control"  required>
                            <label>材質</label>
                            <input type="text" name="womaterial" id="womaterial" class="form-control"  required>
                            <label>尺寸</label>
                            <input type="text" name="wosize" id="wosize" class="form-control"  required>
                            <label>收藏狀態</label>
                            <input type="text" name="wostatus" id="wostatus" class="form-control"  required>
                            <label>作品圖片</label>
                            <input type="file" name="wofile" id="wofile" class="form-control"  required>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="action" class="form-control btn-success" value="新增作品"  required>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--./新增作品Modal-->
    <!-- 編輯作品Modal -->
    <?php 
    //檢查GET變數是否為編輯模式(判斷方式：是否有在edit變數中指定作品ID)
    if(isset($_GET['edit'])){ 
        $sql ="SELECT * FROM `ex_works` WHERE `woid` = '".$_GET['edit']."'";
        $query = mysqli_query($_con, $sql);
        $row = mysqli_fetch_assoc($query);
    ?>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">編輯「<?php echo $row['wotitle']; ?>」作品</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                            <label for="">作品分類</label>
                            <select name="wocategory" id="wocategory" class="form-control">
                                <?php foreach ($category as $key => $value){ ?>
                                    <option value="<?php echo $value['wcid']; ?>" <?php if($row['wocategory']==$value['wocategory']){echo "selected";} ?>><?php echo $value['wcname']; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="wocatorigin" value="<?php echo $row['wocategory']; ?>">
                            <label>作品名稱</label>
                            <input type="text" name="wotitle" id="wotitle" class="form-control" value="<?php echo $row['wotitle']; ?>" required>
                            <label>年份</label>
                            <input type="text" name="woyear" id="woyear" class="form-control" value="<?php echo $row['woyear']; ?>"  required>
                            <label>材質</label>
                            <input type="text" name="womaterial" id="womaterial" class="form-control"  value="<?php echo $row['womaterial']; ?>" required>
                            <label>尺寸</label>
                            <input type="text" name="wosize" id="wosize" class="form-control" value="<?php echo $row['wosize']; ?>"  required>
                            <label>收藏狀態</label>
                            <input type="text" name="wostatus" id="wostatus" class="form-control" value="<?php echo $row['wostatus']; ?>"  required>
                            <label>作品圖片</label>
                            <img src="uploadfiles/<?php echo $row['wocategory']."/".$row['woid'].".".$row['woext'] ?>" class="img-fluid img-thumbnail">
                            <input type="file" name="wofile" id="wofile" class="form-control">
                            <input type="hidden" name="woext" value="<?php echo $row['woext']; ?>">
                            <input type="hidden" name="woid" value="<?php echo $row['woid']; ?>">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="action" class="form-control btn-success" value="編輯作品"  required>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ./編輯作品Modal -->
    <?php } ?>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script>
    <?php if(isset($_GET['id'])){ ?>
    var myModal = new bootstrap.Modal(document.getElementById('viewModal'), {
        keyboard: false
    });
    myModal.show();
    <?php } ?>
    <?php if(isset($_GET['edit'])){ ?>
    var editModal = new bootstrap.Modal(document.getElementById('editModal'), {
        keyboard: false
    });
    editModal.show();
    <?php } ?>
    <?php
    if(isset($_GET['tab'])){ 
        switch($_GET['tab']){
            case "image": ?>
            var tab = new bootstrap.Tab("#nav-image-tab");
        <?php break;
            case "list": ?>
            var tab = new bootstrap.Tab("#nav-list-tab");
        <?php break;
            case "category": ?>
            var tab = new bootstrap.Tab("#nav-category-tab");
        <?php break;
        }?>
    tab.show();
    <?php 
    };
    ?>
</script>
</html>