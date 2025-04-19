<?php

class Ingredient
{
    private $id;
    private $producerId;
    private $ingredientName;
    private $quantity;
    private $unitId;
    private $cost;
    public function __construct($id = null, $producerId = null, $ingredientName = null, $quantity = null, $unitId = null, $cost = null)
    {
        $this->id = $id;
        $this->producerId = $producerId;
        $this->ingredientName = $ingredientName;
        $this->quantity = $quantity;
        $this->unitId = $unitId;
        $this->cost = $cost;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getProducerId()
    {
        return $this->producerId;
    }

    public function setProducerId($producerId)
    {
        $this->producerId = $producerId;
    }

    public function getIngredientName()
    {
        return $this->ingredientName;
    }

    public function setIngredientName($ingredientName)
    {
        $this->ingredientName = $ingredientName;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getUnitId()
    {
        return $this->unitId;
    }

    public function setUnitId($unitId)
    {
        $this->unitId = $unitId;
    }
    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
    }
}
