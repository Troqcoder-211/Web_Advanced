<?php
include __DIR__ . "/../../../controllers/IngredientController.php";
include __DIR__ . "/../../../controllers/ImportController.php";
include __DIR__ . "/../../../controllers/UnitController.php";
include __DIR__ . "/../../../controllers/ProducerController.php";
$ingredientController = new IngredientController();
$importController = new ImportController();
$unitController = new UnitController();
$producerController = new ProducerController();
$ingredients;
$imports;
$units;
$producers;
?>
<div class="grid grid-cols-2 gap-10" id="import_main">
    <!-- Left Side -->
    <div class="bg-white p-4 grid-cols-[2fr] border border-white rounded-lg">
        <div class="text-center">
            <h1 class="font-bold text-xl">Nguyên liệu còn lại trong kho: </h1>
        </div>
        <div class="border-0 rounded-md overflow-hidden mt-4">
            <div class="bg-white  overflow-y-auto text-[0.7rem]" style="height: 75vh;">
                <table class="table-auto w-full border-collapse ">
                    <thead class="bg-gray-100 sticky top-0">
                        <tr>
                            <th class="p-2 ">Mã</th>
                            <th class="p-2 ">Tên</th>
                            <th class="p-2 ">Còn lại</th>
                            <th class="p-2 ">Đơn vị</th>
                            <th class="p-2 ">Giá nhập</th>
                            <th class="p-2 ">&nbsp;</th>

                        </tr>
                    </thead>
                    <tbody class="text-center" id="table_ingredients_body" onload="reloadIngredientsTable()">
                        <?php
                        $i = 1;
                        $ingredients = $ingredientController->getAllIngredients();
                        foreach ($ingredients as $ingr) {
                            $rowColor = "bg-white";
                            if (!($i & 1)) {
                                $rowColor = "bg-gray-200";
                            }
                            $i++;
                            echo '<tr class="' . $rowColor . '"> 
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
                        ?>
                        <script>
                            function turnOffImportOverlay() {
                                document.getElementById("div_import_add").remove();
                                document.getElementById("overlay_import").remove();


                            }

                            function validQuantity(id, type) {
                                let inp = document.getElementById("input_quantity_add_import");
                                if (inp.value == '' || inp.value <= 0) {
                                    alert("Số lượng nhập lớn hơn 0");
                                    return;
                                }
                                addIngredientToTable(id, type);
                            }

                            function quantityPopup(id, type) {
                                let import_main = document.getElementById("import_main");
                                import_main.insertAdjacentHTML("beforeend", `    
    <div class="z-50 flex flex-col justify-center  w-1/3 pb-3 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4 rounded-md shadow-lg" id="div_import_add">
        <h1 class="text-center font-bold text-md pb-10">Số lượng cần nhập thêm</h1>
        <form action="" class=" pb-5">

            <div class="flex gap-5 ">
                <label for="">Số lượng:</label>
                <input type="number" name="" class="border-2 border-dark rounded-md h-[30px]" id="input_quantity_add_import" min=1> 
            </div>
        </form>
        <div class="flex justify-center w-full">
            <button type="button" class="w-fit focus:outline-none text-white hover:bg-green-800 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700" onclick="validQuantity(${id},${type})">Thêm</button>
        </div>
    </div>


    <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40" id="overlay_import" onclick="turnOffImportOverlay()"></div> `);

                                return;

                            }

                            function removeFromImportTable(id) {
                                let exist = document.querySelector(`#table_import tr[data-value="${id}"`);
                                let cost = exist.querySelector(".ingredient_total");
                                let total_import = document.getElementById("total_import");
                                total_import.textContent = parseInt(total_import.textContent) - parseInt(cost.textContent);
                                exist.remove();

                            }

                            function addIngredientToTable(id, type) {
                                let importTable = document.getElementById("table_import_body");
                                let exist = document.querySelector(`#table_import tr[data-value="${id}"]`);

                                if (exist) {
                                    let quantityRow = exist.querySelector(`.quantity_import`);
                                    if (type == 1) {
                                        quantityRow.textContent = parseInt(quantityRow.textContent) + parseInt(document.getElementById("input_quantity_add_import").value);
                                    } else {
                                        quantityRow.textContent = parseInt(document.getElementById("input_quantity_add_import").value);

                                    }
                                    let total_import = document.getElementById("total_import");
                                    let totalPrice = exist.querySelector(".ingredient_total");
                                    let cost = exist.querySelector(".ingredient_cost");
                                    total_import.textContent = parseInt(total_import.textContent) - parseInt(totalPrice.textContent);
                                    totalPrice.textContent = parseInt(quantityRow.textContent) * parseInt(cost.textContent);
                                    total_import.textContent = parseInt(total_import.textContent) + parseInt(totalPrice.textContent);

                                    turnOffImportOverlay();
                                    return;
                                }
                                let color = "bg-white";
                                if ((document.querySelectorAll("#table_import tr").length) % 2 == 0) color = "bg-gray-200";
                                $.ajax({
                                    url: "include/AddToImportTable.php",
                                    method: "POST",
                                    data: JSON.stringify({
                                        "id": id,
                                        "color": color,
                                        "quantity": document.getElementById("input_quantity_add_import").value,
                                    }),
                                    success: function(response) {
                                        importTable.insertAdjacentHTML("beforeend", response);

                                        let total_import = document.getElementById("total_import");
                                        let exist = document.querySelector(`#table_import tr[data-value="${id}"]`);
                                        let total_cost = exist.querySelector(`.ingredient_total`);
                                        total_import.textContent = parseInt(total_import.textContent) + parseInt(total_cost.textContent);

                                        turnOffImportOverlay();
                                    }
                                });
                            }
                        </script>
                    </tbody>
                </table>

            </div>
        </div>
        <hr>
        <div class="flex justify-end pt-2">


        </div>

    </div>


    <!-- Right Side -->
    <div class="bg-white p-4 grid-cols-[3fr] border border-white rounded-md">
        <!-- Form/Header Section -->
        <div>
            <h1 class="font-bold text-center pb-2 text-xl">Phiếu nhập hàng</h1>


            <div class="flex items-center gap-2 text-sm">
                <h1 class="">Nhà cung cấp:</h1>
                <form class="">
                    <label for="" class="sr-only">Nhà cung cấp</label>
                    <select class="border border-1 border-black rounded-lg" id="select_import_producer">
                        <?php
                        $producers = $producerController->getAllProducers();
                        foreach ($producers as $pr) {
                            echo '<option value="' . $pr->getId() . '" selected>' . $pr->getProducerName() . '</option>';
                        }
                        ?>

                    </select>
                </form>
            </div>
            <div class="flex flex-row justify-between text-sm">
                <p class="">Mã phiếu:0213CSA</p>
                <p class="">Ngày lập:01/02/2025</p>
            </div>
        </div>

        <!-- Table Container: Its height is the remaining viewport height -->
        <div class="border-0 rounded-md overflow-hidden mt-3 ">
            <div class="overflow-y-auto text-[0.7rem]" style="height: calc(92vh - 150px);">
                <table class="table-auto w-full border-collapse text-center " id="table_import">
                    <thead class="bg-gray-100 sticky top-0">
                        <tr>
                            <th class="p-2 ">Mã</th>
                            <th class="p-2 ">Tên</th>
                            <th class="p-2 ">SL</th>
                            <th class="p-2 ">ĐVT</th>
                            <th class="p-2 ">Giá</th>
                            <th class="p-2 ">Tổng</th>
                            <th class="p-2 ">&nbsp;</th>
                            <th class="p-2 ">&nbsp;</th>

                        </tr>
                    </thead>
                    <tbody id="table_import_body">

                    </tbody>
                </table>

            </div>
        </div>
        <div class="flex justify-between pt-2">
            <div class="flex items-center">
                <h>Thành tiền: <span id="total_import" class="font-bold">0</span></h>
            </div>
            <div>

                <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" onclick="importIngredients()">Nhập hàng</button>

                <script>
                    function reloadIngredientsTable() {
                        $.ajax({
                            url: "include/LoadIngredientsToImport.php",
                            success: function(data) {
                                document.getElementById("table_ingredients_body").innerHTML = "";
                                document.getElementById("table_ingredients_body").insertAdjacentHTML("beforeend", data);

                            },
                        })
                    }

                    function importIngredients() {
                        let allItemId = document.querySelectorAll(".import_item_id");
                        let allItemQuantity = document.querySelectorAll(".import_item_quantity");
                        let allItemCost = document.querySelectorAll(".import_item_cost");
                        let allItemTotal = document.querySelectorAll(".import_item_total");
                        let allItemUnit = document.querySelectorAll(".import_item_unit");
                        console.log(allItemUnit);
                        let ingredients = [];


                        for (let i = 0; i < allItemId.length; i++) {
                            ingredients.push({
                                id: parseInt(allItemId[i].innerText.trim()),
                                quantity: parseInt(allItemQuantity[i].innerText.trim()),
                                price: parseInt(allItemCost[i].innerText.trim()),
                                unit: parseInt(allItemUnit[i].getAttribute("data-id")),
                            });
                        }
                        console.log(ingredients);
                        const producer = document.getElementById("select_import_producer").value;
                        const totalImport = parseInt(document.getElementById("total_import").textContent);
                        // console.log(total);
                        $.ajax({
                            url: "include/ImportIngredients.php",
                            method: "POST",
                            contentType: "application/json",
                            data: JSON.stringify({
                                producer: producer,
                                total: totalImport,
                                ingredients: ingredients,
                            }),
                            success: function(response) {
                                document.getElementById("table_import_body").innerHTML = "";
                                reloadIngredientsTable();
                                console.log("success");
                            },
                            error: function(err) {
                                console.error("Error during import:", err);
                            }
                        });
                    }
                </script>

            </div>
        </div>
    </div>

</div>