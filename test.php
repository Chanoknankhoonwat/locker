<?php
$serverName = "DESKTOP-8T9L9T4\\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"officecenter", "UID"=>"sa", "PWD"=>"EuroInturn");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    $sql = "SELECT * FROM [dbo].[buddy_number]"; // แทนที่ table_name ด้วยชื่อของ table ที่ต้องการเรียก
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