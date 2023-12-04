<?php
$serverName = "DESKTOP-8T9L9T4\\SQLEXPRESS"; //serverName\instanceName
$connectionInfo = array( "Database"=>"officecenter", "UID"=>"sa", "PWD"=>"EuroInturn");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn) {
    $employeeId = $_POST['employee_id'];
    $employeeIn = $_POST['employee_in'];
    $employeeName = $_POST['employee_name'];
    $employeeSurName = $_POST['employee_sur'];
    $employeePosition = $_POST['employee_depart'];
    $employeeBuddy = $_POST['employee_buddy'];

    $sql = "INSERT INTO locker_employee (idcard
    ,InitialT
    ,namethai
    ,surnamethai
    ,departmentid) VALUES (?,?,?,?,?)";
    $params = array($employeeId ,$employeeIn ,  $employeeName ,   $employeeSurNam, $employeePosition, );
    $stmt = sqlsrv_query($conn, $sql, $params);
    $sql2 = "UPDATE buddy_locker SET owner_buddy = ? WHERE buddy_number = ?";
    $params = array($employeeId, $employeeBuddy);
    $stmt = sqlsrv_query($conn, $sql2, $params )

    if ($stmt !== false ) {
        echo "เพิ่มพนักงานเรียบร้อยแล้ว";
    } else {
        echo "ไม่สามารถเพิ่มพนักงานได้: " . print_r(sqlsrv_errors(), true);
    }

    sqlsrv_close($conn);
} else {
    echo "ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้";
}
?>