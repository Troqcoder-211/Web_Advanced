<header class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-semibold">Products</h2>
        <p class="text-xs text-gray-500">Home / Products / Product List</p>
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

<div class="flex justify-between items-center mb-6">
    <div class="flex items-center border rounded">
        <input type="text" placeholder="Search" class="border-0 p-2 focus:outline-none">
        <i class="fas fa-search text-gray-500 mr-2"></i>
    </div>
    <div class="flex items-center">
        <button class="bg-gray-200 px-4 py-2 rounded mr-2">Filter</button>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Add New Product</button>
    </div>
</div>

<table class="w-full">
    <thead>
        <tr>
            <th class="text-left py-2">No</th>
            <th class="text-left py-2">Product</th>
            <th class="text-left py-2">Price</th>
            <th class="text-left py-2">Stock</th>
            <th class="text-left py-2">Status</th>
            <th class="text-left py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="py-2">1</td>
            <td class="py-2 flex items-center">
                <img src="path/to/product1.jpg" alt="Product 1" class="w-10 h-10 rounded mr-2">
                <div>
                    <span class="block">Ristretto Bianco</span>
                    <span class="block text-xs text-gray-500">Coffee and Beverage</span>
                </div>
            </td>
            <td class="py-2">$5.00</td>
            <td class="py-2">Several variants are out of stock</td>
            <td class="py-2">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                    </div>
                </label>
            </td>
            <td class="py-2">
                <button class="text-blue-500 focus:outline-none">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="text-red-500 focus:outline-none ml-2">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        <tr>
            <td class="py-2">2</td>
            <td class="py-2 flex items-center">
                <img src="path/to/product2.jpg" alt="Product 2" class="w-10 h-10 rounded mr-2">
                <div>
                    <span class="block">Iced creamy latte</span>
                    <span class="block text-xs text-gray-500">Coffee and Beverage</span>
                </div>
            </td>
            <td class="py-2">$5.00</td>
            <td class="py-2">120</td>
            <td class="py-2">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer" checked>
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline
                                peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                    </div>
                </label>
            </td>
            <td class="py-2">
                <button class="text-blue-500 focus:outline-none">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="text-red-500 focus:outline-none ml-2">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        <tr>
            <td class="py-2">3</td>
            <td class="py-2 flex items-center">
                <img src="path/to/product3.jpg" alt="Product 3" class="w-10 h-10 rounded mr-2">
                <div>
                    <span class="block">Cappuccino</span>
                    <span class="block text-xs text-gray-500">Coffee and Beverage</span>
                </div>
            </td>
            <td class="py-2">$5.00</td>
            <td class="py-2">120</td>
            <td class="py-2">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                    </div>
                </label>
            </td>
            <td class="py-2">
                <button class="text-blue-500 focus:outline-none">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="text-red-500 focus:outline-none ml-2">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        <tr>
            <td class="py-2">4</td>
            <td class="py-2 flex items-center">
                <img src="path/to/product4.jpg" alt="Product 4" class="w-10 h-10 rounded mr-2">
                <div>
                    <span class="block">Milk coffee with regal</span>
                    <span class="block text-xs text-gray-500">Coffee and Beverage</span>
                </div>
            </td>
            <td class="py-2">$5.00</td>
            <td class="py-2">120</td>
            <td class="py-2">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                    </div>
                </label>
            </td>
            <td class="py-2">
                <button class="text-blue-500 focus:outline-none">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="text-red-500 focus:outline-none ml-2">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        <tr>
            <td class="py-2">5</td>
            <td class="py-2 flex items-center">
                <img src="path/to/product5.jpg" alt="Product 5" class="w-10 h-10 rounded mr-2">
                <div>
                    <span class="block">Orange juice</span>
                    <span class="block text-xs text-gray-500">Coffee and Beverage</span>
                </div>
            </td>
            <td class="py-2">$5.00</td>
            <td class="py-2">120</td>
            <td class="py-2">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                    </div>
                </label>
            </td>
            <td class="py-2">
                <button class="text-blue-500 focus:outline-none">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="text-red-500 focus:outline-none ml-2">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        <tr>
            <td class="py-2">6</td>
            <td class="py-2 flex items-center">
                <img src="path/to/product6.jpg" alt="Product 6" class="w-10 h-10 rounded mr-2">
                <div>
                    <span class="block">Seafood Lunch</span>
                    <span class="block text-xs text-gray-500">Food and Snack</span>
                </div>
            </td>
            <td class="py-2">$5.00</td>
            <td class="py-2">120</td>
            <td class="py-2">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                    </div>
                </label>
            </td>
            <td class="py-2">
                <button class="text-blue-500 focus:outline-none">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="text-red-500 focus:outline-none ml-2">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        <tr>
            <td class="py-2">7</td>
            <td class="py-2 flex items-center">
                <img src="path/to/product7.jpg" alt="Product 7" class="w-10 h-10 rounded mr-2">
                <div>
                    <span class="block">French toast with sugar</span>
                    <span class="block text-xs text-gray-500">Food and Snack
                </div>
            </td>
            <td class="py-2">$5.00</td>
            <td class="py-2">120</td>
            <td class="py-2">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                    </div>
                </label>
            </td>
            <td class="py-2">
                <button class="text-blue-500 focus:outline-none">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="text-red-500 focus:outline-none ml-2">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
    </tbody>
</table>