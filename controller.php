<?php 

//echo json_encode($_POST);

//總題數
$count=$_POST['count'];

$output=array();

for($i=1;$i<=$count;$i++){
    $output[$i]["name"]=$_POST['name_'.$i];
    for($j=1;$j<=$_POST['ans_'.$i.'_count'];$j++){
        $output[$i]['option'][]=$_POST["q_".$i."_option_".$j];
    }
    $output[$i]["curans"]=$_POST[$i.'_curans'];
}

echo json_encode($output);



?>