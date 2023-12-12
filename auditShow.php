<?php
include 'database.php';
//$selection = $_POST['selection'];
//$depart = $_POST['depart'];
//$type = $_POST['type'];
//$sex = $_POST['sex'];


if( $conn ) {
    $sql = "SELECT locker_employee.*,buddy_locker.*,department.*,locker_shirt.*,out_locker.* 
        FROM locker_employee
        JOIN buddy_locker ON locker_employee.idcard = buddy_locker.owner_buddy
        JOIN locker_shirt ON locker_employee.idcard = locker_shirt.owner_buddy
        JOIN out_locker ON locker_employee.idcard = out_locker.owner_buddy
        JOIN department ON locker_employee.departmentid = department.departmentno
        WHERE locker_employee.idcard IS NOT NULL";
    $params  =array();
    if(true){
        $stmt = sqlsrv_query($conn, $sql);
    }
   else{  
        if ($type !== NULL){
            if ($type === 'buddy'){
        }
            elseif ($type === 'shirt'){
                $sql .=" AND locker_shirt.shirt_number IS NOT NULL ";
        }
         // แทนที่ table_name ด้วยชื่อของ table ที่ต้องการเรียก        
        }
        if ($depart !== NULL){
            $sql .=" AND departmentid = ? "; // แทนที่ table_name ด้วยชื่อของ table ที่ต้องการเรียก       
            $params[] = $depart;
        }

        if ($sex !== NULL){
            $sql .=" AND InitialT = ? "; // แทนที่ table_name ด้วยชื่อของ table ที่ต้องการเรียก       
            $params[] = $sex; 
        }
        $stmt = sqlsrv_query($conn, $sql, $params );
    }
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