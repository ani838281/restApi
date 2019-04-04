<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
include_once'../../config/Database.php';
include_once'../../models/student.php';
$database=new Database();
$db=$database->connect();
$student=new Student($db);
$data=json_decode(file_get_contents("php://input"));
$student->name=$data->name;
$student->branch=$data->branch;
if($student->create())
{
    echo json_encode(
    array('meassage'=>'student record created'));
}
else
{
        echo json_encode(
    array('meassage'=>'student record not created'));
}
        

