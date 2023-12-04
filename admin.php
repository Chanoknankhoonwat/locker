<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serverName = "DESKTOP-8T9L9T4\\SQLEXPRESS"; //serverName\instanceName

    // Since UID and PWD are not specified in the $connectionInfo array,
    // The connection will be attempted using Windows Authentication.
    $connectionInfo = array( "Database"=>"officecenter", "UID"=>"sa", "PWD"=>"EuroInturn");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if ($conn) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM [dbo].[testadmin] WHERE username = ? AND password = ?";
        $params = array($username, $password);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt !== false) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

            if ($row) {
                header("Location: test.php");
                // ทำการเข้าสู่ระบบ
            } else {
                echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
                // ข้อความแจ้งเตือนถ้าล็อกอินไม่สำเร็จ
            }
        } else {
            echo "เกิดข้อผิดพลาดในการดึงข้อมูล: " . print_r(sqlsrv_errors(), true);
        }

        sqlsrv_close($conn);
    } else {
        echo "ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้";
    }
}
?>
