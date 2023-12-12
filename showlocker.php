<?php
include 'database.php';
//$selection = $_POST['selection']
//$selectionID = $_POST['selectionID']
//$employeeID = $_POST["employeeID"]

if( $conn ) {
    $sql = "SELECT locker_employee.*,buddy_locker.*,department.*,locker_shirt.*,locker_out.* 
    FROM locker_employee
    LEFT JOIN buddy_locker ON locker_employee.idcard = buddy_locker.owner_buddy
    LEFT JOIN locker_shirt ON locker_employee.idcard = locker_shirt.owner_locker
    LEFT JOIN locker_out ON locker_employee.idcard = locker_out.owner_out
    JOIN department ON locker_employee.departmentid = department.departmentno
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
        
        while ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['idcard'] . "</td>";
            echo "<td>" . $row['buddy_number'] . "</td>";

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