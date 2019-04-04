<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once'../../config/Database.php';
include_once'../../models/student.php';
$database=new Database();
$db=$database->connect();
$student=new Student($db);
$result=$student->read();
$num=$result->rowCount();
if($num>0)
{
    $std_arr=array();
    $std_arr['data']=array();
    while($row=$result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $std_item=array('id'=>$id,'name'=>$name,'branch'=>$branch);
        array_push($std_arr['data'],$std_item);
       
    }
     echo json_encode($std_arr);
}
    else
    {
        echo json_encode(array('message'=>'no students found'));
    }

?>