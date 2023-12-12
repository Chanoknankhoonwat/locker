<?php
include 'database.php';
//$selection = $_POST['selection']
//$selectionID = $_POST['selectionID']
//$employeeID = $_POST["employeeID"]

if( $conn ) {
    $sql = "SELECT locker_employee.*, department.*,buddy_locker.*
        FROM locker_employee
        JOIN department ON locker_employee.departmentid = department.departmentno
        LEFT JOIN buddy_locker ON locker_employee.idcard = buddy_locker.owner_buddy
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
        echo "<tr><th>idcard</th><th>buddynumber</th><th>InitialT</th><th>namethai</th><th>surnamethai</th>
        <th>departmentid</th><th>departmentname</th><th>lineid</th></tr>";
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['idcard'] . "</td>";
            echo "<td>" . $row['buddy_number'] . "</td>";
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