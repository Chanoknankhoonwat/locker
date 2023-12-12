<?php
include 'database.php';
if ($conn) {
    $employeeIDToDelete = $_POST["username"]; // ลบข้อมูลพนักงานที่มี ID = 1

    $sql = "DELETE FROM locker_employee WHERE idcard = ?";
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
