<?php

$_con = mysqli_connect("localhost","example","kYcM1XuFebgqftpm","example");
$_con->query("SET NAMES utf8");

//載入分類清單
$sql ="SELECT * FROM `ex_episodes`";
$query = mysqli_query($_con, $sql);
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
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</html>