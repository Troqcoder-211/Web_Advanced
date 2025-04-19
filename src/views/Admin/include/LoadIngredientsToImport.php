
<?php
include __DIR__ . "/../../../controllers/IngredientController.php";
include __DIR__ . "/../../../controllers/ImportController.php";
include __DIR__ . "/../../../controllers/UnitController.php";
include __DIR__ . "/../../../controllers/ProducerController.php";
$ingredientController = new IngredientController();
$importController = new ImportController();
$unitController = new UnitController();
$producerController = new ProducerController();
$imports;
$units;
$producers;
$i = 1;
$ingredients = $ingredientController->getAllIngredients();
$str = "";
foreach ($ingredients as $ingr) {
    $rowColor = "bg-white";
    if (!($i & 1)) {
        $rowColor = "bg-gray-200";
    }
    $i++;
    $str .= '<tr class="' . $rowColor . '"> 
                            <td class="p-2">' . $ingr->getId() . '</td>
                            <td class="p-2">' . $ingr->getIngredientName() . '</td>
                            <td class="p-2">' . $ingr->getQuantity() . '</td>
                            <td class="p-2">' . $unitController->getUnitById($ingr->getUnitId())->getType() . '</td>
                            <td class="p-2">' . $ingr->getCost() . '</td>
                            <td class="p-2">

                            <button type="button" class="text-blue-700  font-medium rounded-lg text-sm px-1 py-1 me-1 mb-1 focus:outline-none " onclick="quantityPopup(' . $ingr->getId() . ',1)">Thêm</button>
                             </td>

                        </tr>';
}
echo $str;
