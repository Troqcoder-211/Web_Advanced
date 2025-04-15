<?php
class DatabaseConnection
{
    private $host = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "COFFESHOP";
    private $connection = null;

    public function __construct()
    {
        try {
            // Kiểm tra và tạo kết nối
            if ($this->connection === null) {
                $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

                // Kiểm tra kết nối
                if ($this->connection->connect_error) {
                    throw new Exception("Không thể kết nối đến cơ sở dữ liệu: " . $this->connection->connect_error);
                }
            }
        } catch (Exception $e) {
            // Ghi log lỗi hoặc hiển thị thông báo lỗi
            error_log("Lỗi kết nối database: " . $e->getMessage());
            die("Lỗi hệ thống. Vui lòng liên hệ quản trị viên.");
        }
    }

    public function getConnection()
    {
        if ($this->connection === null) {
            new self(); // Tạo mới kết nối nếu chưa có
        }
        return $this->connection;
    }

    public function closeConnection()
    {
        if ($this->connection !== null) {
            $this->connection->close();
            $this->connection = null;
        }
    }


    public function __destruct()
    {
        $this->closeConnection();
    }
}
