<?php
$serverName = "DESKTOP-8T9L9T4\\SQLEXPRESS"; //serverName
// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"officecenter", "UID"=>"sa", "PWD"=>"EuroInturn");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    $sql = "SELECT locker_employee.*,buddy_locker.buddy_number AS buddy_locker,department.departmentname AS departmentname
    FROM locker_employee
    JOIN buddy_locker ON locker_employee.idcard = buddy_locker.owner_buddy
    JOIN department ON locker_employee.departmentid = department.departmentno"; // แทนที่ table_name ด้วยชื่อของ table ที่ต้องการเรียก
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt !== false) {
        echo '<table border="1">';
        $headerPrinted = false;
        echo "<table border='1'>";
        echo "<tr><th>idcard</th><th>buddy_number</th><th>InitialT</th><th>namethai</th><th>surnamethai</th>
        <th>departmentid</th><th>departmentname</th><th>lineid</th></tr>";
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['idcard'] . "</td>";
            echo "<td>" . $row['buddy_number'] . "</td>";
            echo "<td>" . $row['InitialT'] . "</td>";
            echo "<td>" . $row['namethai'] . "</td>";
            echo "<td>" . $row['surnamethai'] . "</td>";
            echo "<td>" . $row['departmentid'] . "</td>";
            echo "<td>" . $row['departmentname'] . "</td>";
            echo "<td>" . $row['lineid'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
   } else {
        echo "ไม่สามารถดึงข้อมูลได้: " . print_r(sqlsrv_errors(), true);
    }

    // ปิดการเชื่อมต่อ
    sqlsrv_close($conn);
} else {
    echo "การเชื่อมต่อไม่สำเร็จ";
}
?>