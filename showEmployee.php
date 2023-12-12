<?php
include 'database.php';
//$selection = $_POST['selection']
//$selectionID = $_POST['selectionID']
//$employeeID = $_POST["employeeID"]

if( $conn ) {
    $sql = "SELECT locker_employee.*,buddy_locker.*,department.*,locker_shirt.*,locker_out.* 
    FROM locker_employee
    LEFT JOIN buddy_locker ON locker_employee.idcard = buddy_locker.owner_buddy
    LEFT JOIN locker_shirt ON locker_employee.idcard = locker_shirt.owner_buddy
    LEFT JOIN locker_out ON locker_employee.idcard = locker_out.owner_buddy
    JOIN department ON locker_employee.departmentid = department.departmentno
    WHERE locker_employee.idcard IS NOT NULL
        ";
    
    if(true){ 
        $stmt = sqlsrv_query($conn, $sql);
    }
    
    elseif ($selection === "id"){
        $sql .= "WHERE idcard = ?";     
        $params = array($employeeID);
        $stmt = sqlsrv_query($conn, $sql, $params );
    }
    
    if ($stmt !== false) {
        echo '<table border="1">';
        $headerPrinted = false;
        echo "<table border='1'>";
        echo "<tr><th>idcard</th><th>buddynumber</th><th>lockernumber</th><th>outnumber</th><th>InitialT</th><th>namethai</th><th>surnamethai</th>
        <th>departmentid</th><th>departmentname</th><th>lineid</th></tr>";
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['idcard'] . "</td>";
            echo "<td>" . $row['buddy_number'] . "</td>";
            echo "<td>" . $row['shirt_number'] . "</td>";
            echo "<td>" . $row['out_number'] . "</td>";
            echo "<td>" . $row['InitialT'] . "</td>";
            echo "<td>" . $row['namethai'] . "</td>";
            echo "<td>" . $row['surnamethai'] . "</td>";
            echo "<td>" . $row['departmentno'] . "</td>";
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