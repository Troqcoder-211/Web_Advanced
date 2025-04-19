
<?php
include __DIR__ . "/../../../controllers/IngredientController.php";
include __DIR__ . "/../../../controllers/UnitController.php";
include __DIR__ . "/../../../controllers/ProducerController.php";

$ingredientController = new IngredientController();
$ingredients = $ingredientController->getAllIngredients();
$unitController = new UnitController();
$producerController = new ProducerController();
$i = 1;
$tableContent = '';
foreach ($ingredients as $ingr) {
    $rowColor = "bg-white";
    if (!($i & 1)) {
        $rowColor = "bg-gray-200";
    }
    $i++;

    $tableContent .=
        '<tr class="' . $rowColor . ' text-center" >

    <td class="p-3">' . $ingr->getId() . ' </td>
    <td class="p-3">' . $producerController->getProducerNameById($ingr->getProducerId()) . ' </td>
    <td class="p-3">' . $ingr->getIngredientName() . ' </td>
    <td class="p-3">' . $ingr->getQuantity() . ' </td>
    <td class="p-3">' . $unitController->getNameById($ingr->getUnitId()) . ' </td>
    <td class="p-3">' . $ingr->getCost() . ' </td> 
    <td class="py-2">
<i class="fas fa-edit text-blue-500"></i>
</td>
    </tr>
    ';
}
echo $tableContent;
