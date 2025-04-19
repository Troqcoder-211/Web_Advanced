<?php
include __DIR__ . "/../../../controllers/IngredientController.php";
include __DIR__ . "/../../../controllers/UnitController.php";
include __DIR__ . "/../../../controllers/ProducerController.php";
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$ingredientsController = new IngredientController();
$producerController = new ProducerController();
$unitController = new UnitController();
$ingredient = new Ingredient(0, $data['producer'], $data['name'], 0, $data['unit'], $data['cost']);
$ingredientsController->createIngredient($ingredient);
