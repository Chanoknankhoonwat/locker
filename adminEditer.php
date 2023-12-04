<?php

    $serverName = "DESKTOP-8T9L9T4\\SQLEXPRESS"; //serverName\instanceName
    $connectionInfo = array( "Database"=>"officecenter", "UID"=>"sa", "PWD"=>"EuroInturn");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

if ($conn) {
    $employeeID = $_POST['userid']; // แก้ไขข้อมูลพนักงานที่มี ID = 1
    $employeeName = $_POST['username'];
    $employeePosition = $_POST['position'];

    $sql = "UPDATE [dbo].[locker_employee] SET username = ?, position = ? WHERE idcard = ?";
    $params = array($employeeName, $employeePosition, $employeeID);
    $stmt = sqlsrv_query($conn, $sql, $params);

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