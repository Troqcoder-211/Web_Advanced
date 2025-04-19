<?php
include __DIR__ . "/../../../controllers/IngredientController.php";
include __DIR__ . "/../../../controllers/UnitController.php";
include __DIR__ . "/../../../controllers/ProducerController.php";



$unitController = new UnitController();
$units = $unitController->getAllUnits();
$unitsString = "";

foreach ($units as $un) {
    $unitsString .= '<option value="' . $un->getId() . '">' . $un->getType() . '</option>';
}

$producerController = new ProducerController();
$producers = $producerController->getAllProducers();
$producersString = "";
foreach ($producers as $pr) {
    $producersString .= '<option value="' . $pr->getId() . '">' . $pr->getProducerName() . '</option>';
}

echo json_encode([
    'producer' => $producersString,
    'unit' => $unitsString,
]);
