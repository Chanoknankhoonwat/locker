<?php
include 'database.php';

$sql = "SELECT * FROM buddy_locker"; // เลือกตารางที่ต้องการเช็คข้อมูล
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    if(!empty($row["owner_buddy"])){
        $sql2 = "UPDATE buddy_locker SET status_buddy = 0 WHERE buddy_number = ?";
        $params2 = array($row['buddy_number']);
        $stmt2 = sqlsrv_query($conn, $sql2, $params2 );
        echo "ez";
    }
    else{
        $sql3 = "UPDATE buddy_locker SET status_buddy = 1 WHERE buddy_number = ?";
        $params3 = array($row['buddy_number']);
        $stmt3 = sqlsrv_query($conn, $sql3, $params3 );
    }
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
