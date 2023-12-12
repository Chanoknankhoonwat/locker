<?php
include 'database.php';

if( $conn ) {
    $sql = "SELECT * FROM buddy_locker ";
    //$sql .= "WHERE status_buddy IS NOT NULL AND status_buddy = 1 "; // แทนที่ table_name ด้วยชื่อของ table ที่ต้องการเรียก
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt !== false) {
        echo '<table border="1">';
        $headerPrinted = false;

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            if (!$headerPrinted) {
                echo '<tr>';
                foreach ($row as $key => $value) {
                    echo '<th>' . $key . '</th>';
                }   
                echo '</tr>';
                $headerPrinted = true;
            }
            
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "ไม่สามารถดึงข้อมูลได้: " . print_r(sqlsrv_errors(), true);
    }

    // ปิดการเชื่อมต่อ
    sqlsrv_close($conn);
} else {
    echo "การเชื่อมต่อไม่สำเร็จ";
}
?>