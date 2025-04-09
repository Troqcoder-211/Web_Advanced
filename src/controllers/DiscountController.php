<?php

include __DIR__ ."/../config/DatabaseConnection.php";
include __DIR__ ."/../models/Discount.php";

class DiscountController {
    private $connection;

    public function __construct() {
        $db = new DatabaseConnection();
        $this->connection = $db->getConnection();
    }

    public function getAllDiscounts() {
        $sql = "SELECT * FROM DISCOUNTS";
        
        $result = $this->connection->query( $sql );

        $discounts = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $discount= new Discount(
                    $row['ID'],
                    $row['DISCOUNTNAME'],
                    $row['DISCOUNTPERCENT'],
                    $row['REQUIREMENT'],
                    $row['STARTDATE'],
                    $row['ENDDATE']
                );
                $discounts[] = $discount;
            }
        }
        return $discounts;
    }

    public function getDiscountById($id) {
        $sql = "SELECT * FROM DISCOUNTS WHERE ID = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return new Discount(
                $row['ID'],
                $row['DISCOUNTNAME'],
                $row['DISCOUNTPERCENT'],
                $row['REQUIREMENT'],
                $row['STARTDATE'],
                $row['ENDDATE']
            );
        }
        return null;
    }

    public function createDiscount(Discount $discount) {
        $sql = "INSERT INTO DISCOUNTS (DISCOUNTNAME, DISCOUNTPERCENT, REQUIREMENT, STARTDATE, ENDDATE) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $discountName = $discount->getDiscountName();
        $discountPercent = $discount->getDiscountPercent();
        $requirement = $discount->getRequirement();
        $startDate = $discount->getStartDate();
        $endDate = $discount->getEndDate();

        $stmt->bind_param("sddss", $discountName, $discountPercent, $requirement, $startDate, $endDate);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateDiscount($voucherName, $percent, $requirement, $startDate, $endDate, $id) {
        $sql = "UPDATE DISCOUNTS 
                SET DISCOUNTNAME = ?, DISCOUNTPERCENT = ?, REQUIREMENT = ?, STARTDATE = ?, ENDDATE = ? 
                WHERE ID = ?";
    
        $stmt = $this->connection->prepare($sql);
    
        if (!$stmt) {
            return [
                "success" => false,
                "message" => "Lỗi chuẩn bị truy vấn: " . $this->connection->error
            ];
        }
    
        if (!$stmt->bind_param("sdsssi", $voucherName, $percent, $requirement, $startDate, $endDate, $id)) {
            return [
                "success" => false,
                "message" => "Lỗi khi bind tham số: " . $stmt->error
            ];
        }
    
        if (!$stmt->execute()) {
            return [
                "success" => false,
                "message" => "Lỗi thực thi truy vấn: " . $stmt->error
            ];
        }
    
        return [
            "success" => true,
            "message" => "Cập nhật khuyến mãi thành công!"
        ];
    }
    
    

    public function deleteDiscount($id) {
        $sql = "DELETE FROM DISCOUNTS WHERE ID = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function __destruct() {
        if ($this->connection) {
            $this->connection->close();
        }
    }

}

?>