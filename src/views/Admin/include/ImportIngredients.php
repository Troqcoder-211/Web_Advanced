<?php
include __DIR__ . "/../../../controllers/IngredientController.php";
include __DIR__ . "/../../../controllers/UnitController.php";
include __DIR__ . "/../../../controllers/ProducerController.php";
include __DIR__ . "/../../../controllers/ImportController.php";

$ingredientController = new IngredientController();
$importController = new ImportController();
$json = file_get_contents("php://input");
$data = json_decode($json, true);

$ingr = $data['ingredients'];
$producer = $data['producer'];
$total = $data['total'];

$imp = new Import(null, $producer, null, $total);
$importDetails = [];

for ($i = 0; $i < count($ingr); $i++) {
    $ingredientId = $ingr[$i]['id'];
    $quantity = $ingr[$i]['quantity'];
    $price = $ingr[$i]['price'];
    $totalItem = $price * $quantity;
    $ingre = $ingredientController->getIngredientById($ingredientId);
    if (! $ingre) {
        error_log("⚠️ Ingredient #{$ingredientId} not found");
        continue;
    }
    $ingre->setQuantity($ingre->getQuantity() + $quantity);
    $ingredientController->updateIngredient($ingre);
    $importDetails[] = [
        'ingredientId' => $ingredientId,
        'quantity' => $quantity,
        'price' => $price,
        'total' => $totalItem
    ];
}
$importController->addImport($imp, $importDetails);
