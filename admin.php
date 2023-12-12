<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database.php';
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if ($conn) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM locker_userlogin WHERE username = ? AND userpassword = ?";
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
