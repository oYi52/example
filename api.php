<?php 
    $data = file_get_contents("https://bsb.kh.edu.tw/afterschool/opendata/afterschool_json.jsp?city=70");

    if(isset($_GET['limit'])){
        $limit = $_GET['limit'];
        $output_array=array();
        $data_array = json_decode($data, true);
        for($i = 0 ; $i<$limit ; $i++){
            $output_array[] = $data_array[$i];
        }
        echo json_encode($output_array);
    }else{
        echo $data;
    }
    /*echo json_encode(
        array(
            array(
                "id"=>1,
                "name"=>"John",
                "age"=>30,
                "cars"=>array(
                    array("id"=>1, "name"=>"Ford"),
                    array("id"=>2, "name"=>"Fiat"),
                    array("id"=>3, "name"=>"Honda")
                )
            ),
            array(
                "id"=>2,
                "name"=>"Anna",
                "age"=>25,
                "cars"=>array(
                    array("id"=>4, "name"=>"Renault"),
                    array("id"=>5, "name"=>"Volvo"),
                    array("id"=>6, "name"=>"BMW")
                )
            ),
            array(
                "id"=>3,
                "name"=>"Bob",
                "age"=>20,
                "cars"=>array(
                    array("id"=>7, "name"=>"Mercedes"),
                    array("id"=>8, "name"=>"Audi"),
                    array("id"=>9, "name"=>"Ferrari")
                )
            )
        )
    );*/

?>