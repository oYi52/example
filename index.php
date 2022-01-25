<?php 

$_con = mysqli_connect("localhost","example","kYcM1XuFebgqftpm","example");
$sql ="SELECT * FROM `ex_works`";
$query = mysqli_query($_con, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>
<body>

<div class="container">
    <?php if(isset($_GET['result'])&&$_GET['result']=="success"){echo "<h3>新增成功!</h3>";} ?>
    <div class="card mt-3 p-3">
        <h2>作品列表</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>作品分類</th>
                    <th>作品名稱</th>
                    <th>年份</th>
                    <th>材質</th>
                    <th>尺寸</th>
                    <th>收藏狀態</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row=mysqli_fetch_assoc($query)){ ?>
                <tr>
                    <td><?php echo $row['wocategory']; ?></td>
                    <td><?php echo $row['wotitle']; ?></td>
                    <td><?php echo $row['woyear']; ?></td>
                    <td><?php echo $row['womaterial']; ?></td>
                    <td><?php echo $row['wosize']; ?></td>
                    <td><?php echo $row['wostatus']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="card mt-3 p-3">
        <h2>新增作品</h2>
        <hr>
        <form action="process.php" method="POST">
            <label for="">作品分類</label>
            <select name="wocategory" id="wocategory" class="form-control">
                <option value="分類一">分類一</option>
                <option value="分類二">分類二</option>
                <option value="分類三">分類三</option>
            </select>
            <label>作品名稱</label>
            <input type="text" name="wotitle" id="wotitle" class="form-control">
            <label>年份</label>
            <input type="text" name="woyear" id="woyear" class="form-control">
            <label>材質</label>
            <input type="text" name="womaterial" id="womaterial" class="form-control">
            <label>尺寸</label>
            <input type="text" name="wosize" id="wosize" class="form-control">
            <label>收藏狀態</label>
            <input type="text" name="wostatus" id="wostatus" class="form-control">
            <label>作品圖片</label>
            <input type="file" name="wofile" id="wofile" class="form-control">
            <hr>
            <input type="submit" class="form-control btn-success" value="新增作品">
        </form>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</html>