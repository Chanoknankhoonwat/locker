<?php
include 'database.php';
//$selection = $_POST['selection']
//$lockerID = $_POST['selectionID']
//$buildID = $_POST["employeeID"]

if( $conn ) {
    $sql = "SELECT locker_employee.*,locker_out.*,building.*  
    FROM locker_out
    LEFT JOIN locker_employee ON locker_out.owner_out = locker_employee.idcard
    JOIN building ON locker_out.build_id = building.building_id
        ";
    
    if(true){ 
        $stmt = sqlsrv_query($conn, $sql);
    }
    
    elseif ($selection === "id"){
        $sql .= "WHERE out_number = ?";     
        $params = array($lockerID);
        $stmt = sqlsrv_query($conn, $sql, $params );
    }
    elseif ($selection === "build"){
        $sql .= "WHERE build_id = ?";     
        $params = array($buildID);
        $stmt = sqlsrv_query($conn, $sql, $params );
    }
    
    
    if ($stmt !== false) {
        echo '<table border="1">';
        $headerPrinted = false;
        echo "<table border='1'>";
        
        while ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['idcard'] . "</td>";
            echo "<td>" . $row['out_number'] . "</td>";
            echo "<td>" . $row['building_name'] . "</td>";

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