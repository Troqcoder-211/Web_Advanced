<div class="bg-white border-0 rounded-md font-sans h-screen">
    <div class="p-6">

        <header class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-semibold">Orders</h2>
                <p class="text-xs text-gray-500">Home / Order </p>
            </div>
            <div class="flex items-center">
                <button class="text-gray-500 focus:outline-none mr-4">
                    <i class="fas fa-th-large"></i>
                </button>
                <button class="text-gray-500 focus:outline-none">
                    <i class="fas fa-bell"></i>
                </button>
            </div>
        </header>
        <div class="flex  gap-2">
            <div class="flex items-center border rounded">
                <input type="text" placeholder="Search" class="border-0 p-2 focus:outline-none">
                <button class="px-3 text-sm">
                    <i class="fas fa-search text-gray-500 mr-2"></i>
                </button>
            </div>
            <!-- <div class="flex items-center "> -->
            <div class="">
                <select class="border p-2 rounded pr-8">
                    <option>All Status</option>
                    <option>All</option>
                    <option>New Order</option>
                    <option>Processed</option>
                    <option>Shipped</option>
                    <option>Canceled</option>
                    <option>Delivered</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
            <div class="">
                <select class="border p-2 rounded  appearance-none pr-8">
                    <option>Today</option>
                    <option>Last 7 Day</option>
                    <option>Last 30 Day</option>
                    <option>This Month</option>
                    <option>Last Month</option>
                    <option>Custom Range</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
            <div class="relative">
                <input type="date" placeholder="Start date" class="border p-2  rounded appearance-none">

            </div>

            <div class="relative">
                <input type="date" placeholder="End date" class="border p-2 rounded appearance-none">

            </div>

            <div class="relative">
                <button class="bg-blue-500 text-white px-4 py-2 rounded">Export</button>
                <div class="absolute right-0 top-0 mt-8 bg-white rounded shadow-md w-48 hidden">
                    <ul class="list-none p-2">
                        <li class="py-2 px-4 hover:bg-gray-100 cursor-pointer">Ms. Excel</li>
                        <li class="py-2 px-4 hover:bg-gray-100 cursor-pointer">Export .CSV</li>
                        <li class="py-2 px-4 hover:bg-gray-100 cursor-pointer">Export .Pdf</li>
                    </ul>
                </div>
            </div>
            <!-- </div> -->
        </div>

        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left py-2">Order Id</th>
                    <th class="text-left py-2">Order date</th>
                    <th class="text-left py-2">Address</th>
                    <th class="text-left py-2">Items</th>

                    <th class="text-left py-2">Amount</th>
                    <th class="text-left py-2">Status</th>
                    <th class="text-left py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                ?>
                <tr class="pb-10">
                    <td class="py-2"> 001002</td>
                    <td class="py-2"> April 29, 2023</td>

                    <td class="py-2">
                        Santa Ana, Illinois 85486
                    </td>
                    <td class="py-2">5</td>
                    <td class="py-2">$ 854</td>
                    <td class="py-2 bg-gray-500">New Order</td>
                    <td class="py-2">
                        <i class="fas fa-edit text-blue-500"></i>
                    </td>
                </tr>

                <tr>
                    <td class="py-2"> 001002</td>
                    <td class="py-2"> April 29, 2023</td>

                    <td class="py-2">
                        Santa Ana, Illinois 85486
                    </td>
                    <td class="py-2">5</td>
                    <td class="py-2">$ 854</td>
                    <td class="py-2 bg-yellow-300">Processing</td>
                    <td class="py-2">
                        <i class="fas fa-edit text-blue-500"></i>
                    </td>
                </tr>

                <tr>
                    <td class="py-2"> 001002</td>
                    <td class="py-2"> April 29, 2023</td>

                    <td class="py-2">
                        Santa Ana, Illinois 85486
                    </td>
                    <td class="py-2">5</td>
                    <td class="py-2">$ 854</td>
                    <td class="py-2 bg-red-500">Canceled</td>
                    <td class="py-2">
                        <i class="fas fa"></i>
                    </td>
                </tr>
                <tr>
                    <td class="py-2"> 001002</td>
                    <td class="py-2"> April 29, 2023</td>

                    <td class="py-2">
                        Santa Ana, Illinois 85486
                    </td>
                    <td class="py-2">5</td>
                    <td class="py-2">$ 854</td>
                    <td class="py-2 bg-blue-500">Delivering</td>
                    <td class="py-2">
                        <i class="fas fa-edit text-blue-500"></i>
                    </td>
                </tr>
                <tr>
                    <td class="py-2"> 001002</td>
                    <td class="py-2"> April 29, 2023</td>

                    <td class="py-2">
                        Santa Ana, Illinois 85486
                    </td>
                    <td class="py-2">5</td>
                    <td class="py-2">$ 854</td>
                    <td class="py-2 bg-green-500">Delivered</td>
                    <td class="py-2">
                        <i class="fas fa-edit text-blue-500"></i>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const exportButton = document.querySelector('.bg-blue-500');
            const exportDropdown = document.querySelector('.absolute.right-0.top-0');

            exportButton.addEventListener('click', () => {
                exportDropdown.classList.toggle('hidden');
            });
        });
    </script>
</div>

</html>