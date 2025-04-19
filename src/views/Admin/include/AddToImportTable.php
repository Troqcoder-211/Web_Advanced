<?php
include __DIR__ . "/../../../controllers/IngredientController.php";
include __DIR__ . "/../../../controllers/UnitController.php";
include __DIR__ . "/../../../controllers/ProducerController.php";
$json = file_get_contents("php://input");
$data = json_decode($json, true);
if (!isset($data['id'])) {
        http_response_code(400);
        echo "Missing 'id' in input data.";
        exit;
}
$ingredientsController = new IngredientController();
$producerController = new ProducerController();
$unitController = new UnitController();
$ing = $ingredientsController->getIngredientById($data['id']);
$unit = $unitController->getUnitById($ing->getUnitId());
echo
'<tr class="' . $data['color'] . '" data-value="' . $data['id'] . '">
        <td class="p-2 import_item_id" >' . $ing->getId() . '</td>
        <td class="p-2">' . $ing->getIngredientName() . '</td>
        <td class="p-2 quantity_import import_item_quantity">' . $data['quantity'] . '</td>
        <td class="p-2 import_item_unit" data-id="' . $unit->getId() . '">' . $unit->getType() . '</td>
        <td class="p-2 ingredient_cost import_item_cost">' . $ing->getCost() . '</td>
        <td class="p-2 ingredient_total import_item_total">' . $ing->getCost() * $data['quantity'] . '</td>

        <td class="p-2">
                <button type="button" class="text-blue-700   font-medium rounded-lg text-sm px-1 py-1 me-1 mb-1    focus:outline-none " onclick="quantityPopup(' . $ing->getId() . ',2)">Sửa</button>
        </td>
            <td class="p-2">
                <button type="button" class="focus:outline-none text-red-700  font-medium rounded-lg text-sm px-1 py-1 me-1 mb-1    " onclick="removeFromImportTable(' . $ing->getId() . ')">Xóa</button>
        </td>
    </tr>';
