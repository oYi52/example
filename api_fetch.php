<?php

$_con = mysqli_connect("localhost","example","kYcM1XuFebgqftpm","example");
$_con->query("SET NAMES utf8");
/*
$rootAPIurl="https://api.themoviedb.org/3/tv/4614?api_key=b922b65d80249679036c5a7c0a830dd0";

$result = file_get_contents($rootAPIurl);
$data = json_decode($result, true);

$output= array();

$output['introduction']=$data['overview'];
foreach(array_slice($data['seasons'], 1) as $season){
    //$output['seasons'][$season['season_number']]=$season;
    for($i=1;$i<=$season['episode_count'];$i++){
        $epAPI="https://api.themoviedb.org/3/tv/4614/season/{$season['season_number']}/episode/{$i}?api_key=b922b65d80249679036c5a7c0a830dd0&language=en-US";
        $epdata=json_decode(file_get_contents($epAPI), true);
        $output['episode'][$season['season_number']][$i]['image']="https://image.tmdb.org/t/p/original".$epdata['still_path'];
        $output['episode'][$season['season_number']][$i]['title']=$epdata['name'];
        $output['episode'][$season['season_number']][$i]['introduction']=$epdata['overview'];
        $sql="INSERT INTO `ex_episodes` (`epseason`, `epnum`, `eptitle`, `epintro`, `epimg`) VALUES({$season['season_number']},{$i},'{$output['episode'][$season['season_number']][$i]['title']}','{$output['episode'][$season['season_number']][$i]['introduction']}','{$output['episode'][$season['season_number']][$i]['image']}');";
        $query = mysqli_query($_con, $sql);
    }
}

echo json_encode($output);
*/

$result = file_get_contents("data.json");
$data = json_decode($result, true);
$flag=0;
//die(var_dump($data));
foreach($data as $season => $seadata){
    foreach($seadata as $epnum => $episode){
        $title=mysqli_real_escape_string($_con, $episode['title']);
        $text = mysqli_real_escape_string($_con, $episode['introduction']);
        $sql="INSERT INTO `ex_episodes` (`epseason`, `epnum`, `eptitle`, `epintro`, `epimg`) VALUES({$season},{$epnum},'{$title}',\"{$text}\",\"{$episode['image']}\");";
        $query = mysqli_query($_con, $sql);
        if(!$query){
            $flag+=1;
            echo "{$sql}<br>";
        }
    }
}

if($flag==0){
    echo "執行成功！";
}else{
    echo "執行失敗！";
}

?>