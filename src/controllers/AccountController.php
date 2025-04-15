<?php

require_once __DIR__ . '/../models/Account.php';

class AccountController
{
    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $this->conn = $this->db->getConnection();
    }

    public function getAccountById($id)
    {
        $sql = "SELECT * FROM ACCOUNTS WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $stmt->close();
            return new Account($row['ID'], $row['USERNAME'], $row['PASSWORD']);
        }
        $stmt->close();
        return null;
    }

    public function createAccount(Account $account)
    {
        $sql = "INSERT INTO ACCOUNTS (USERNAME, PASSWORD) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $account->getUsername(), $account->getPassword());

        if ($stmt->execute()) {
            $id = $this->conn->insert_id;
            $stmt->close();
            return $id;
        }
        $stmt->close();
        return false;
    }

    public function updateAccount(Account $account)
    {
        $sql = "UPDATE ACCOUNTS SET USERNAME = ?, PASSWORD = ? WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $account->getUsername(), $account->getPassword(), $account->getId());

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }

    public function deleteAccount($id)
    {
        $sql = "DELETE FROM ACCOUNTS WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }

    public function getAllAccounts()
    {
        $sql = "SELECT * FROM ACCOUNTS";
        $result = $this->conn->query($sql);
        $accounts = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $accounts[] = new Account($row['ID'], $row['USERNAME'], $row['PASSWORD']);
            }
        }
        return $accounts;
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM ACCOUNTS WHERE USERNAME = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            error_log("Found user: " . print_r($row, true));

            if (password_verify($password, $row['PASSWORD'])) {
                $stmt->close();
                return new Account($row['ID'], $row['USERNAME'], $row['PASSWORD'], $row['ROLE']);
            } else {
                error_log("Mật khẩu không đúng.");
            }
        } else {
            error_log("Không tìm thấy user với username: $username");
        }

        $stmt->close();
        return null;
    }

    public function register($username, $password)
    {
        $sql = "SELECT * FROM ACCOUNTS WHERE USERNAME = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt->close();
            return "Tài khoản đã tồn tại!";
        }

        $stmt->close();

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        error_log("Hashed password for $username: $hashedPassword");

        $sql = "INSERT INTO ACCOUNTS (USERNAME, PASSWORD, ROLE) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $defaultRole = 'user';
        $stmt->bind_param("sss", $username, $hashedPassword, $defaultRole);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }
}
