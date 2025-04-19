<?php

class ImportDetails
{
    private $id;
    private $importId;
    private $ingredientId;
    private $quantity;
    private $price;
    private $total;
    private $unitId;

    public function __construct($id, $importId, $ingredientId, $quantity, $price, $total, $unitId)
    {
        $this->id = $id;
        $this->importId = $importId;
        $this->ingredientId = $ingredientId;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->total = $total;
        $this->unitId = $unitId;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getImportId()
    {
        return $this->importId;
    }
    public function getIngredientId()
    {
        return $this->ingredientId;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getTotal()
    {
        return $this->total;
    }
    public function getUnitId()
    {
        return $this->unitId;
    }

    // Setters
    public function setImportId($importId)
    {
        $this->importId = $importId;
    }
    public function setIngredientId($ingredientId)
    {
        $this->ingredientId = $ingredientId;
    }
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setTotal($total)
    {
        $this->total = $total;
    }
    public function setUnitId($unitId)
    {
        $this->unitId = $unitId;
    }
}
