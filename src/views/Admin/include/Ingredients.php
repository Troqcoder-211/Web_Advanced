<?php
include __DIR__ . "/../../../controllers/IngredientController.php";
include __DIR__ . "/../../../controllers/UnitController.php";
include __DIR__ . "/../../../controllers/ProducerController.php";
?>
<div class="flex flex-col  gap-5 bg-white h-screen border-0 rounded-md relative" id="body_ingredients">
    <div class="">
        <h1 class="font-bold text-center pt-2">Quản lý nguyên liệu </h1>
    </div>
    <div class=" bg-white flex justify-between">
        <div class="px-5">
            <div class="flex  border rounded-sm bg-black-500 ">
                <input type="text" placeholder="Search" class="border-0 p-2 focus:outline-none" id="table_search">
                <button class="text-sm px-4 bg-gray-200 w-full" onclick="searchIngredients()" id="btn_search">
                    <i class="fas fa-search text-gray-500"></i>
                </button>
                <script>
                    function searchIngredients() {
                        sortIngredients();
                    }
                </script>
            </div>
        </div>

        <div class=" grid grid-cols-3 gap-3">
            <select name="" id="table_filter" class="px-3 py-2  me-2 mb-2 bg-gray-100 border-0 rounded-md text-black">
                <option value="" disabled selected>Sort by</option>
                <option value="INGREDIENTNAME">Name</option>
                <option value="QUANTITY">Quantity</option>

            </select>
            <button class="focus:outline-none text-white bg-orange-500  font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2  dark:hover:opacity-75 " onclick="sortIngredients()" value="" id="btn_sort">Sort &nbsp;</button>
            <script>
                function sortIngredients() {
                    let table_search = document.getElementById("table_search").value;
                    let table_filter = document.getElementById("table_filter").value;
                    let table_body = document.getElementById("table_body");
                    let btn_sort = document.getElementById("btn_sort");
                    let order = btn_sort.value;
                    $.ajax({
                        url: "include/SortIngredients.php",

                        method: "GET",
                        data: {
                            table_search: table_search,
                            table_filter: table_filter,
                            sort_by: order
                        },
                        success: function(data) {
                            $('#table_body').html(data);
                        }
                    });
                    if (btn_sort.value == "" || btn_sort.value == "ASC") {
                        btn_sort.innerHTML = `Sort &nbsp;<i class="fa-solid fa-down-long"></i>`;
                        btn_sort.value = "DESC";
                    } else if (btn_sort.value = "DESC") {
                        btn_sort.innerHTML = `Sort &nbsp;<i class="fa-solid fa-up-long"></i>`;
                        btn_sort.value = "ASC";
                    }
                }
            </script>
            <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 " onclick="displayAddIngredients()">Thêm</button>
            <script>
                function addIngredients() {
                    // Create an object with the data to be sent
                    let cost = document.getElementById("input_cost_add_ingredients").value

                    if (cost == "" || cost <= 0) {
                        alert("Giá phải >0 và không được rỗng");
                        return;
                    }
                    const data = {
                        "name": document.getElementById("input_name_add_ingredients").value,
                        "producer": document.getElementById("select_producer_add_ingredients").value,
                        "unit": document.getElementById("select_unit_add_ingredients").value,
                        "cost": document.getElementById("input_cost_add_ingredients").value
                    };
                    console.log(data);
                    // Send data as JSON
                    $.ajax({
                        url: "include/AddIngredients.php",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify(data),
                        success: function(response) {
                            loadIngredientsTable();
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error);
                        }
                    });
                    turnOffIngredientOverlay();
                }

                function turnOffIngredientOverlay() {
                    document.getElementById("overlay_ingredient").remove();
                    document.getElementById("div_ingredient_add").remove();
                }


                function displayAddIngredients() {
                    let bodyIngredient = document.getElementById("body_ingredients");

                    bodyIngredient.insertAdjacentHTML("beforeend", `
        <div class="z-50 flex flex-col justify-center w-1/2 pb-10 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4 rounded-md shadow-lg" id="div_ingredient_add">
            <h1 class="text-center font-bold text-md">Thêm nguyên liệu</h1>
            <form action="" class="grid grid-rows-5 gap-3">
                <div class="grid grid-rows-2">
                    <label for="">Tên NL</label>
                    <input type="text" name=""  class="border-2 border-dark rounded-md h-[30px]" id="input_name_add_ingredients">
                </div>
                <div class="grid grid-rows-2">
                    <label for="">Chọn NCC</label>
                    <select name="producer_id" class="border-2 border-dark rounded-md h-[30px] " id="select_producer_add_ingredients" id="select_producer_add_ingredients"></select>
                </div>
                <div class="grid grid-rows-2">
                    <label for="">DVT</label>
                    <select name="unit_id" class="border-2 border-dark rounded-md h-[30px] " id="select_unit_add_ingredients" id="select_unit_add_ingredients"></select>
                </div>
                   <div class="grid grid-rows-2">
                    <label for="">Giá trên 1 DVT</label>
                    <input type="number" name=""  class="border-2 border-dark rounded-md h-[30px]" id="input_cost_add_ingredients">
                </div>
            </form>
            <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700" onclick="addIngredients()">Thêm</button>
        </div>
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40" id="overlay_ingredient" onclick="turnOffIngredientOverlay()"></div>
    `);

                    fetch("include/DisplayAddIngredients.php")
                        .then(res => res.json())
                        .then(data => {
                            document.getElementById("select_producer_add_ingredients").innerHTML = data.producer;
                            document.getElementById("select_unit_add_ingredients").innerHTML = data.unit;
                        });
                }
            </script>

        </div>
    </div>
    <div class="px-3">
        <div class="border-0 border-black rounded-md overflow-hidden ">
            <div class=" overflow-y-auto text-[0.8rem]" style="height: calc(97vh - 150px);">
                <table class="table-auto w-full border-collapse ">
                    <thead class="bg-gray-100 sticky top-0 ">
                        <tr>
                            <th class="p-2 ">Mã</th>
                            <th class="p-2 ">NCC</th>
                            <th class="p-2 ">Tên</th>
                            <th class="p-2 ">SL</th>
                            <th class="p-2 ">ĐVT</th>
                            <th class="p-2 ">Giá trên 1 DVT</th>

                            <th class="p-2 ">&nbsp;Sửa </th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        <!-- Generate a lot of rows to test scrolling -->

                        <?php

                        $ingredientController = new IngredientController();
                        $ingredients = $ingredientController->getAllIngredients();
                        $unitController = new UnitController();
                        $producerController = new ProducerController();
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
                            <td class="p-3">' . $ingr->getCost() . ' </td> 
                            <td class="py-2">
                        <i class="fas fa-edit text-blue-500"></i>
                    </td>
                            </tr>
                            ');
                        }
                        ?>

                    </tbody>
                </table>
                <script>
                    function loadIngredientsTable() {
                        fetch("include/LoadIngredients.php")
                            .then(res => res.text())
                            .then(data => {
                                document.getElementById("table_body").innerHTML = data;
                            });
                    }
                </script>
            </div>
        </div>
    </div>

</div>