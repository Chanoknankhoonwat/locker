<?php
include 'database.php';

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// SQL query สร้างตาราง
$sql = "CREATE TABLE locker_shirt (
    locker_number VARCHAR(50) PRIMARY KEY,
    status_buddy INT NULL,
    owner_buddy VARCHAR(50) NULL,
    departmentid CHAR(4) NULL
)";

// สร้างตาราง
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "สร้างตารางเรียบร้อยแล้ว";
}

// ปิดการเชื่อมต่อ
sqlsrv_close($conn);
?>