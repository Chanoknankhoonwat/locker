<?php
include 'database.php';
if ($conn) {
    $employeeIDToDelete = $_POST["username"]; // ลบข้อมูลพนักงานที่มี ID = 1

    $sql = "DELETE FROM locker_employee WHERE idcard = ?";
    $params = array($employeeIDToDelete);
    $stmt = sqlsrv_query($conn, $sql, $params);
    
    $sql2 = "UPDATE buddy_locker SET owner_buddy = NULL,status_buddy = 1 WHERE owner_buddy = ?";
    $params2 = array($employeeId);
    $stmt = sqlsrv_query($conn, $sql2, $params2 );
    
    $sql3 = "UPDATE locker_shirt SET owner_locker = NULL WHERE,status_locker = 1 owner_locker = ?";
    $params3 = array($employeeId);
    $stmt = sqlsrv_query($conn, $sql3, $params3 );
    
    $sql4 = "UPDATE locker_out SET owner_out = NULL,status_out = 1 WHERE owner_out = ?";
    $params4 = array($employeeId);
    $stmt = sqlsrv_query($conn, $sql4, $params4 );


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
