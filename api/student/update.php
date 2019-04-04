<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Student.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $student = new Student($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $student->id = $data->id;

  $student->name = $data->name;
$student->branch = $data->branch;
  // Update post
  if($student->update()) {
    echo json_encode(
      array('message' => 'student record Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'student record not updated')
    );
  }
