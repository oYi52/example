<?php

$_con = mysqli_connect("localhost","example","kYcM1XuFebgqftpm","example");
$_con->query("SET NAMES utf8");

if(!isset($_GET['p'])){
    $curpage=1;
}else{
    $curpage=$_GET['p'];
}

//定義一頁幾筆資料
$itemsperpage=10;

$offset=($curpage-1)*$itemsperpage;

//載入分類清單
$sql ="SELECT * FROM `ex_episodes` LIMIT {$itemsperpage} OFFSET {$offset}";
$query = mysqli_query($_con, $sql);

$total_sql="SELECT COUNT(*) FROM `ex_episodes`";
$total_query=mysqli_query($_con,$total_sql);
$total_row=mysqli_fetch_array($total_query);
$epcount = $total_row[0];

//判斷筆數是否可以被整除
if($epcount%$itemsperpage>0){
    $pages = intval($epcount/$itemsperpage)+1;
}else{
    $pages = intval($epcount/$itemsperpage);
}

echo "<br>共{$epcount}筆資料，每頁顯示{$itemsperpage}筆資料，共{$pages}頁。";

$episodes = array();
while($row=mysqli_fetch_assoc($query)){ 
    $episodes[$row['epid']]=$row;
}

?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Episodes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <h1>Episodes Guide</h1>
        <hr>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach($episodes as $epnum => $epdata){ ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $epdata['epimg']; ?>" class="card-img-top" alt="...">
                        <div class="card-img-overlay">
                            <span class="badge bg-success"><?php echo "#{$epnum}"; ?></span>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><small class="text-muted"><?php echo "Season {$epdata['epseason']}, Episode{$epdata['epnum']}"; ?></small></p>
                            <h5 class="card-title"><?php echo $epdata['eptitle']; ?></h5>
                            <p class="card-text"><?php echo $epdata['epintro']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <hr>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item<?php if($curpage==1){echo " disabled";} ?>"><a class="page-link" href="episodes.php?p=<?php echo $curpage-1; ?>">Previous</a></li>
                <?php for($i=1;$i<=$pages;$i++){ ?>
                <li class="page-item<?php if($i==$curpage){echo " active";} ?>"><a class="page-link" href="episodes.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
                <li class="page-item<?php if($curpage==$pages){echo " disabled";} ?>"><a class="page-link" href="episodes.php?p=<?php echo $curpage+1; ?>">Next</a></li>
            </ul>
        </nav>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</html>