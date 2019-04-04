<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';
  $database = new Database();
  $db = $database->connect();
  $category = new Category($db);
  $result = $category->read();
  $num = $result->rowCount();
  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'id' => $id,
            'name' => $name
          );
          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {

        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
