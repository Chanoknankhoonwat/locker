<?php
$employeeId = $_POST['employee_id'];
$main = array();
$no = $_POST['no'];
$locker_no = $_POST['locker_no'];
$line_id_and_idcard = $_POST['line_id_and_idcard'];
$check1 = $_POST['check1'];
$check2 = $_POST['check2'];
$check3 = $_POST['check3'];
$check4 = $_POST['check4'];
$check5 = $_POST['check5'];
$check6 = $_POST['check6'];
$check7 = $_POST['check7'];
$check8 = $_POST['check8'];
$check9 = $_POST['check9'];

$command = 'python pytoex.py';
$output = shell_exec($command);

$detail = array('no','locker_no','line_id_and_idcard','check1','check2','check3','check4','check5','check6','check7','check8','check9');
$test = array($no,$locker_no,$line_id_and_idcard,$check1,$check2,$check3,$check4,$check5,$check6,$check7,$check8,$check9);
array_push($main,$detail,$test);

echo $main[1][5];
?>