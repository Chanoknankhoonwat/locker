<?php
$serverName = "DESKTOP-8T9L9T4\\SQLEXPRESS"; //serverName\instanceName
$connectionInfo = array( "Database"=>"officecenter", "UID"=>"sa", "PWD"=>"EuroInturn");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if ($conn) {
    $employeeIDToDelete = $_POST["username"]; // ลบข้อมูลพนักงานที่มี ID = 1

    $sql = "DELETE FROM [dbo].[locker_userlogin] WHERE username = ?";
    $params = array($employeeIDToDelete);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt !== false) {
        echo "ลบข้อมูลพนักงานเรียบร้อยแล้ว";
    } else {
        echo "ไม่สามารถลบข้อมูลพนักงานได้: " . print_r(sqlsrv_errors(), true);
    }

    sqlsrv_close($conn);
} else {
    echo "ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้";
}
?>
