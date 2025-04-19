<?php

require_once '/xampp/htdocs/web/Web_Advanced/src/config/DatabaseConnection.php';
require_once '/xampp/htdocs/web/Web_Advanced/src/models/Import.php';
require_once '/xampp/htdocs/web/Web_Advanced/src/models/ImportDetail.php';
require_once '/xampp/htdocs/web/Web_Advanced/src/models/Ingredient.php';



class ImportController
{
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
    }

    // Lấy danh sách imports
    public function getImports()
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM IMPORTS";
        $result = $conn->query($sql);

        $imports = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $import = new Import(
                    $row['ID'],
                    $row['PRODUCERID'],
                    $row['DATE'],
                    $row['TOTAL']
                );
                $imports[] = $import;
            }
        }
        $conn->close();
        return $imports;
    }

    // Lấy import theo ID
    public function getImportById($id)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM IMPORTS WHERE ID = $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $import = new Import(
                $row['ID'],
                $row['PRODUCERID'],
                $row['DATE'],
                $row['TOTAL']
            );
            $conn->close();
            return $import;
        } else {
            $conn->close();
            return null;
        }
    }

    // Thêm import mới
    public function addImport(Import $import, $importDetails)
    {
        $conn = $this->db->getConnection();

        $sql = "INSERT INTO IMPORTS (PRODUCERID, DATE, TOTAL) VALUES (?, CURRENT_DATE, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("id", $import->getProducerId(), $import->getTotal());
        if ($stmt->execute()) {
            $importId = $conn->insert_id;

            // Insert import details
            foreach ($importDetails as $detail) {
                $sqlDetail = "INSERT INTO IMPORTDETAILS (IMPORTID, INGREDIENTID, QUANTITY, PRICE, TOTAL,UNITID) VALUES (?, ?, ?, ?, ?,?)";
                $stmtDetail = $conn->prepare($sqlDetail);
                $stmtDetail->bind_param("iiiddi", $importId, $detail['ingredientId'], $detail['quantity'], $detail['price'], $detail['total'], $detail['unitId']);
                $stmtDetail->execute();
                $stmtDetail->close();
            }

            $stmt->close();
            $conn->close();
            return true;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }


    // Cập nhật import
    public function updateImport(Import $import)
    {
        $conn = $this->db->getConnection();
        $sql = "UPDATE IMPORTS SET PRODUCERID = ?, DATE = ?, TOTAL = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issi", $import->getProducerId(), $import->getDate(), $import->getTotal(), $import->getId());

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }

    // Xóa import
    public function deleteImport($id)
    {
        $conn = $this->db->getConnection();
        $sql = "DELETE FROM IMPORTS WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }

    // Lấy chi tiết import theo import ID
    public function getImportDetails($importId)
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM IMPORTDETAILS WHERE IMPORTID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $importId);
        $stmt->execute();
        $result = $stmt->get_result();

        $details = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $detail = new ImportDetails(
                    $row['ID'],
                    $row['IMPORTID'],
                    $row['INGREDIENTID'],
                    $row['QUANTITY'],
                    $row['PRICE'],
                    $row['TOTAL'],
                    $row['UNITID']
                );
                $details[] = $detail;
            }
        }
        $stmt->close();
        $conn->close();
        return $details;
    }

    // Lấy danh sách nguyên liệu
    public function getIngredients()
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM INGREDIENTS";
        $result = $conn->query($sql);

        $ingredients = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ingredient = new Ingredient(
                    $row['ID'],
                    $row['PRODUCERID'],
                    $row['INGREDIENTNAME'],
                    $row['QUANTITY'],
                    $row['UNITID']
                );
                $ingredients[] = $ingredient;
            }
        }
        $conn->close();
        return $ingredients;
    }
}
