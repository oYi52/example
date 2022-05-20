<?php

$_con = mysqli_connect("localhost","example","kYcM1XuFebgqftpm","example");
$_con->query("SET NAMES utf8");

if(!isset($_GET['p'])){
    $curpage=1;
}else{
    $curpage=$_GET['p'];
}

$query_string="";
if(isset($_GET['q'])){
    $query_string="WHERE `eptitle` LIKE '%{$_GET['q']}%' ";
}

$order = "asc";
$order_string="";
if(isset($_GET['o'])){
    $order = $_GET['o'];
    $order_string="ORDER BY `epid` {$order}";
}

//定義一頁幾筆資料
$itemsperpage=9;

$offset=($curpage-1)*$itemsperpage;

//載入分類清單
$sql ="SELECT * FROM `ex_episodes` {$query_string} {$order_string} LIMIT {$itemsperpage} OFFSET {$offset}";
$query = mysqli_query($_con, $sql);

$total_sql="SELECT COUNT(*) FROM `ex_episodes` {$query_string}";
$total_query=mysqli_query($_con,$total_sql);
$total_row=mysqli_fetch_array($total_query);
$epcount = $total_row[0];

//判斷筆數是否可以被整除
if($epcount%$itemsperpage>0){
    $pages = intval($epcount/$itemsperpage)+1;
}else{
    $pages = intval($epcount/$itemsperpage);
}

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
        <form action="episodes.php" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search Episodes Title..." name="q">
                <input class="btn btn-secondary" type="submit" id="button-addon2" value="search">
            </div>
        </form>
        <div class="btn-group">
            <a href="episodes.php?<?php if(isset($_GET['p'])){echo "p={$_GET['p']}&";} ?>o=asc" class="btn btn-primary<?php if($order=="asc"){echo " active";} ?>">正序▲</a>
            <a href="episodes.php?<?php if(isset($_GET['p'])){echo "p={$_GET['p']}&";} ?>o=desc" class="btn btn-primary<?php if($order=="desc"){echo " active";} ?>">倒序▼</a>
        </div>
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
        <?php 
        
        if($curpage-2<1){
            $start = 1;
            if($pages<5){
                $end = $pages;
            }else{
                $end = 5;
            }
        }elseif($curpage+2>$pages){
            if($pages-4<1){
                $start = 1;
            }else{
                $start = $pages-4;
            }
            $end = $pages;
        }else{
            $start=$curpage-2;
            $end=$curpage+2;
        }
        
        ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item<?php if($curpage==1){echo " disabled";} ?>"><a class="page-link" href="episodes.php?<?php if(isset($_GET['o'])){echo "o={$_GET['o']}&";}if(isset($_GET['q'])){echo "q={$_GET['q']}&";} ?>p=<?php echo $curpage-1; ?>">Previous</a></li>
                <?php for($i=$start;$i<=$end;$i++){ ?>
                <li class="page-item<?php if($i==$curpage){echo " active";} ?>"><a class="page-link" href="episodes.php?<?php if(isset($_GET['o'])){echo "o={$_GET['o']}&";}if(isset($_GET['q'])){echo "q={$_GET['q']}&";} ?>p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
                <li class="page-item<?php if($curpage==$pages){echo " disabled";} ?>"><a class="page-link" href="episodes.php?<?php if(isset($_GET['o'])){echo "o={$_GET['o']}&";}if(isset($_GET['q'])){echo "q={$_GET['q']}&";} ?>p=<?php echo $curpage+1; ?>">Next</a></li>
            </ul>
        </nav>
        <p class="text-center"><?php echo "共{$epcount}筆資料，每頁顯示{$itemsperpage}筆資料，共{$pages}頁"; ?></p>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</html>