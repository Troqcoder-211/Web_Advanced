<?php

require_once '/xampp/htdocs/web/Web_Advanced/src/config/DatabaseConnection.php';
require_once '/xampp/htdocs/web/Web_Advanced/src/models/Ingredient.php'; //

class IngredientController
{
    private $connection;

    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->connection = $db->getConnection();
    }


    public function getIngredientById($id)
    {
        $sql = "SELECT * FROM INGREDIENTS WHERE ID = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return new Ingredient(
                $row['ID'],
                $row['PRODUCERID'],
                $row['INGREDIENTNAME'],
                $row['QUANTITY'],
                $row['UNITID'],
                $row['COST']
            );
        }
        return null;
    }

    public function createIngredient($ingredient)
    {
        $sql = "INSERT INTO INGREDIENTS (PRODUCERID, INGREDIENTNAME, QUANTITY, UNITID,COST) VALUES (?, ?, ?, ?,?)";
        $stmt = $this->connection->prepare($sql);
        $producerId = $ingredient->getProducerId();
        $ingredientName = $ingredient->getIngredientName();
        $quantity = $ingredient->getQuantity();
        $unitId = $ingredient->getUnitId();
        $cost = $ingredient->getCost();
        $stmt->bind_param("isdii", $producerId, $ingredientName, $quantity, $unitId, $cost);

        if ($stmt->execute()) {
            return $this->connection->insert_id;
        } else {
            return false;
        }
    }

    public function updateIngredient($ingredient)
    {
        $sql = "
            UPDATE INGREDIENTS
            SET PRODUCERID = ?, 
                INGREDIENTNAME = ?, 
                QUANTITY = ?, 
                UNITID = ?, 
                COST = ?
            WHERE ID = ?
        ";

        $stmt = $this->connection->prepare($sql);

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->connection->error);
        }

        $producerId     = $ingredient->getProducerId();
        $ingredientName = $ingredient->getIngredientName();
        $quantity       = $ingredient->getQuantity();
        $unitId         = $ingredient->getUnitId();
        $cost           = $ingredient->getCost();
        $id             = $ingredient->getId();

        $stmt->bind_param("isiidi", $producerId, $ingredientName, $quantity, $unitId, $cost, $id);

        return $stmt->execute();
    }


    public function deleteIngredient($id)
    {
        $sql = "DELETE FROM INGREDIENTS WHERE ID = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function getAllIngredients()
    {
        $sql = "SELECT * FROM INGREDIENTS";
        $result = $this->connection->query($sql);

        $ingredients = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ingredient = new Ingredient(
                    $row['ID'],
                    $row['PRODUCERID'],
                    $row['INGREDIENTNAME'],
                    $row['QUANTITY'],
                    $row['UNITID'],
                    $row['COST']
                );
                $ingredients[] = $ingredient;
            }
        }
        return $ingredients;
    }
    public function getSortIngredientSearchFilter($search, $filter, $sortBy)
    {
        $validColumns = ['ID', 'PRODUCERID', 'INGREDIENTNAME', 'QUANTITY', 'UNITID', 'COST'];
        $validOrders = ['ASC', 'DESC'];
        if (!in_array(strtoupper($filter), $validColumns)) {
            $filter = 'INGREDIENTNAME';
        }
        if (!in_array(strtoupper($sortBy), $validOrders)) {
            $sortBy = 'ASC';
        }
        $searchEscaped = $this->connection->real_escape_string($search);
        $sql = "SELECT INGREDIENTS.*,PRODUCERS.ID AS PRODUCERSID, PRODUCERS.PRODUCERNAME  FROM INGREDIENTS  
        INNER JOIN PRODUCERS ON PRODUCERS.ID = INGREDIENTS.PRODUCERID 
        WHERE INGREDIENTNAME LIKE '%$searchEscaped%' 
           OR PRODUCERNAME LIKE '%$searchEscaped%' 
        ORDER BY " . $filter . " " . $sortBy;
        $result = $this->connection->query($sql);
        $ingredients = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ingredients[] = new Ingredient(
                    $row['ID'],
                    $row['PRODUCERID'],
                    $row['INGREDIENTNAME'],
                    $row['QUANTITY'],
                    $row['UNITID'],
                    $row['COST']
                );
            }
        }

        return $ingredients;
    }

    public function getSortIngredientFilter($filter, $sortBy)
    {

        $validColumns = ['ID', 'PRODUCERID', 'INGREDIENTNAME', 'QUANTITY', 'UNITID', 'COST'];
        $validOrders = ['ASC', 'DESC'];

        if (!in_array(strtoupper($filter), $validColumns)) {
            $filter = 'INGREDIENTNAME';
        }
        if (!in_array(strtoupper($sortBy), $validOrders)) {
            $sortBy = 'ASC';
        }

        $sql = "SELECT * FROM INGREDIENTS ORDER BY " . $filter . " " . $sortBy;

        $result = $this->connection->query($sql);
        $ingredients = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ingredients[] = new Ingredient(
                    $row['ID'],
                    $row['PRODUCERID'],
                    $row['INGREDIENTNAME'],
                    $row['QUANTITY'],
                    $row['UNITID'],
                    $row['COST']
                );
            }
        }

        return $ingredients;
    }
}
