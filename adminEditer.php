<?php
include 'database.php';
if ($conn) {
    $employeeId = $_POST['employee_id'];
    $employeeIn = $_POST['employee_in'];
    $employeeName = $_POST['employee_name'];
    $employeeSurName = $_POST['employee_sur'];
    $employeePosition = $_POST['employee_depart'];
    $employeeBuddy = $_POST['employee_buddy'];
    $employeeShirt = $_POST['employee_shirt'];
    $employeeOut = $_POST['employee_out'];

    $sql = "UPDATE locker_employee SET InitialT = ?
    ,namethai= ?
    ,surnamethai= ?
    ,departmentid = ? WHERE idcard = ?";
    $params = array($employeeIn ,  $employeeName ,   $employeeSurNam, $employeePosition,$employeeId);
    $stmt = sqlsrv_query($conn, $sql, $params);

    $sql2 = "UPDATE buddy_locker SET owner_buddy = ?,status_buddy = 0 WHERE buddy_number = ?";
    $params2 = array($employeeId, $employeeBuddy);
    $stmt = sqlsrv_query($conn, $sql2, $params2 );

    $sql3 = "UPDATE locker_shirt SET owner_locker = ?,status_locker = 0 WHERE shirt_number = ?";
    $params3 = array($employeeId, $employeeShirt);
    $stmt = sqlsrv_query($conn, $sql3, $params3 );

    $sql4 = "UPDATE locker_out SET owner_out = ?,status_out = 0 WHERE out_number = ?";
    $params4 = array($employeeId, $employeeOut);
    $stmt = sqlsrv_query($conn, $sql4, $params4 );


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