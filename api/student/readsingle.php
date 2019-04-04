<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once'../../config/Database.php';
include_once'../../models/student.php';
$database=new Database();
$db=$database->connect();
$student=new Student($db);
$student->id=isset($_GET['id'])?$_GET['id']:die();
$student->read_single();
$student_arr=array('id'=>$student->id,'name'=>$student->name,'branch'=>$student->branch);
print_r(json_encode($student_arr));
