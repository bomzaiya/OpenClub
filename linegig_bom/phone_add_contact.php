<?php
include_once('inc_function.php');
include_once('db.php');
$db = getDbConnection();

//$pNumber = chkEmpty($_GET["p_number"]);
//$pName = chkEmpty($_GET["p_name"]);
//$pDateAdd = date("Y-m-d H:i:s");
//$pDateRegis = date("Y-m-d H:i:s");

$pReturn = array("contact"=>"","id"=>"","status"=>""); 

$testJson = '{"contact":[{"p_name":"a","p_number":"111"},
                         {"p_name":"b","p_number":"222"},
                         {"p_name":"c","p_number":"333"},
                         {"p_name":"d","p_number":"444"}
                        ]}';

$results = json_decode($testJson);


if(true){
  
  
  foreach($results->contact as $contact){
    $pNumber = $contact->p_number;
    $pName = $contact->p_name;
    $pDateAdd = date("Y-m-d H:i:s");
    
    if($pNumber != ""){
      $result_select_number = $db->query("SELECT id FROM phone WHERE phone_number = '".$pNumber."' ");
      if($result_select_number->num_rows == 0){
        $sql_insert = "INSERT INTO phone set
                        phone_number = '".$pNumber."',
                        phone_name = '".$pName."',
                        phone_add_date = '".$pDateAdd."' ";
        $result_insert = $db->query($sql_insert);
        
        if($result_insert){
           $json_data[] = array(  
              "id"=>$db->insert_id,  
              "number"=>$pNumber,
              "status"=>"insert",  
          );
        }else{
           $json_data[] = array(  
              "id"=>"",  
              "number"=>$pNumber,
              "status"=>"error",  
          );
        }
 
      }else{
        $json_data[] = array(  
          "id"=>"",  
          "number"=>$pNumber,
          "status"=>"has",  
        );
      }
    }
    
  }
  
  $json = json_encode($json_data); 
  echo $json;
  
}




?>
