<?php

include __DIR__ . "/../../../controllers/IngredientController.php";
include __DIR__ . "/../../../controllers/UnitController.php";
include __DIR__ . "/../../../controllers/ProducerController.php";
$search = $_GET["table_search"] ?? "";

$filter = $_GET['table_filter'] ?? 'INGREDIENTNAME';
$sortBy = $_GET['sort_by'] ?? "ASC";
$unitController = new UnitController();
$ingredientController = new IngredientController();
$producerController = new ProducerController();
$ingredients = $ingredientController->getSortIngredientFilter($filter, $sortBy);


if ($search != "") {

    $ingredients = $ingredientController->getSortIngredientSearchFilter($search, $filter, $sortBy);
}


$i = 1;
foreach ($ingredients as $ingr) {
    $rowColor = "bg-white";
    if (!($i & 1)) {
        $rowColor = "bg-gray-200";
    }
    $i++;

    echo (
        '<tr class="' . $rowColor . ' text-center" >

        <td class="p-3">' . $ingr->getId() . ' </td>
        <td class="p-3">' . $producerController->getProducerNameById($ingr->getProducerId()) . ' </td>
        <td class="p-3">' . $ingr->getIngredientName() . ' </td>
        <td class="p-3">' . $ingr->getQuantity() . ' </td>
        <td class="p-3">' . $unitController->getNameById($ingr->getUnitId()) . ' </td>
        <td class="py-2"><i class="fas fa-edit text-blue-500"></i></td>
    </tr>
                            ');
}
