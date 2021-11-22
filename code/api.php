<?php

include "db.php";

//requests with = curl http://localhost:8080/api.php?person_id=1

if (isset($_GET['person_id']) && $_GET['person_id']!="") {
  $person_id = $_GET['person_id'];
  //print($person_id);
  $result = $conn->prepare("SELECT * FROM `tasks` WHERE person_id= :person_id");
  $result->bindValue(':person_id',$person_id,PDO::PARAM_INT);
  $result->execute();
  $title = $result->fetchAll(PDO::FETCH_ASSOC);
  $result2 = $conn->prepare("SELECT * FROM `people` WHERE id= :person_id");
  $result2->bindValue(':person_id',$person_id,PDO::PARAM_INT);
  $result2->execute();
  $names = $result2->fetchAll(PDO::FETCH_ASSOC);
  if($title == NULL){
      response(400, NULL,NULL,"Invalid Request");
  }
  else{
    foreach ($title as $value) {
    //print($value['title']);
    $v_tit = $value['title'];
    foreach ($names as $value2) {
      $v_name = $value2['name'];
      $v_surname = $value2['surname'];
    }
    //response($person_id, $names['name'],$names['surname'],$value['title']);
    response($person_id, $v_name,$v_surname,$v_tit);
  }
  }

  }

else{
  response(400, NULL,NULL,"Invalid Request");
  }

function response($person_id,$name,$surname,$title){
  $response['person_id'] = $person_id;
  $response['name'] = $name;
  $response['surname'] = $surname;
  $response['title'] = $title;

  
  $json_response = json_encode($response);
  echo $json_response;
}