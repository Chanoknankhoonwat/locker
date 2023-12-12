<?php

    $serverName = "DESKTOP-8T9L9T4\\SQLEXPRESS"; //serverName\instanceName
    $connectionInfo = array( "Database"=>"officecenter", "UID"=>"sa", "PWD"=>"EuroInturn");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

if ($conn) {
    $employeeId = $_POST['employee_id'];
    $employeeIn = $_POST['employee_in'];
    $employeeName = $_POST['employee_name'];
    $employeeSurName = $_POST['employee_sur'];
    $employeePosition = $_POST['employee_depart'];
    $employeeBuddy = $_POST['employee_buddy'];

    $sql = "UPDATE locker_employee SET InitialT = ?
    ,namethai= ?
    ,surnamethai= ?
    ,departmentid = ? WHERE idcard = ?";
    $params = array($employeeIn ,  $employeeName ,   $employeeSurNam, $employeePosition,$employeeId);
    $stmt = sqlsrv_query($conn, $sql, $params);

    $sql2 = "UPDATE buddy_locker SET owner_buddy = ? WHERE buddy_number = ?";
    $params = array($employeeId, $employeeBuddy);
    $stmt = sqlsrv_query($conn, $sql2, $params )

    if ($stmt !== false) {
        echo "แก้ไขข้อมูลพนักงานเรียบร้อยแล้ว";
    } else {
        echo "ไม่สามารถแก้ไขข้อมูลพนักงานได้: ".print_r(sqlsrv_errors(), true);
    }

    sqlsrv_close($conn);
} else {
    echo "ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้";
}
?>