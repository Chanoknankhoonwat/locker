<?php
include 'database.php';
//$selection = $_POST['selection'];
//$depart = $_POST['depart'];
//$type = $_POST['type'];


if( $conn ) {
    $sql = "SELECT locker_employee.*,buddy_locker.buddy_number AS buddy_locker,department.departmentname AS departmentname
        FROM locker_employee
        JOIN buddy_locker ON locker_employee.idcard = buddy_locker.owner_buddy
        JOIN department ON locker_employee.departmentid = department.departmentno";
    $params  =array();
    $stmt = sqlsrv_query($conn, $sql);
   /* else{  
        if ($depart !== NULL){
            $sql .="WHERE departmentid = ? AND departmentid IS NOT NULL"; // แทนที่ table_name ด้วยชื่อของ table ที่ต้องการเรียก       
            $params[] = $depart;
        }

        if ($type !== NULL){
            $sql .="WHERE type_locker = ? AND type_locker IS NOT NULL"; // แทนที่ table_name ด้วยชื่อของ table ที่ต้องการเรียก       
            $params[] = $type; 
        }
        $stmt = sqlsrv_query($conn, $sql, $params );
    }*/
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