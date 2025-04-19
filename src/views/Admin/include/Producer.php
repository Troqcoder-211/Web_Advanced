<div class="flex flex-col  gap-5 bg-white h-screen border-0 rounded-md">
    <div class="">
        <h1 class="font-bold text-center pt-2">Nhà cung cấp </h1>
    </div>
    <div class=" bg-white flex justify-between">
        <div class="px-5">
            <div class="flex  border rounded-sm bg-black-500 ">
                <input type="text" placeholder="Search" class="border-0 p-2 focus:outline-none">
                <button class="text-sm px-4 bg-gray-200 w-full">
                    <i class="fas fa-search text-gray-500"></i>
                </button>
            </div>
        </div>

        <div class=" grid grid-cols-3 gap-3">
            <select name="" id="" class="px-3 py-2  me-2 mb-2 bg-gray-100 border-0 rounded-md text-black">
                <option value="" disabled selected>Filter by</option>
                <option value="">Id</option>
                <option value="">Name</option>
            </select>
            <button class="focus:outline-none text-white bg-orange-500  font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2  dark:hover:opacity-75  ">Sort &nbsp;<i class="fa-solid fa-up-long"></i></button>
            <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 ">Thêm</button>

        </div>
    </div>
    <div class="px-3">
        <div class="border-0 border-black rounded-md overflow-hidden ">
            <div class=" overflow-y-auto text-[0.8rem]" style="height: calc(97vh - 150px);">
                <table class="table-auto w-full border-collapse ">
                    <thead class="bg-gray-100 sticky top-0 ">
                        <tr>
                            <th class="p-2 ">Mã</th>
                            <th class="p-2 ">Tên</th>
                            <th class="p-2 ">Địa chỉ</th>
                            <th class="p-2 ">SDT</th>
                            <th class="p-2 ">&nbsp;</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- Generate a lot of rows to test scrolling -->

                        <script>
                            for (let i = 1; i <= 50; i++) {
                                let rowColor = "bg-white";
                                if (!(i & 1)) rowColor = "bg-gray-200";

                                document.write(`
                <tr class="${rowColor} text-center">
                  <td class="p-3 ">Mã ${i}</td>
 
                  <td class="p-3">Cái</td>
                <td class="p-3">10000VND</td>
                <td class="p-3">${Math.floor(Math.random() * 100000000)} </td>
                <td> <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-2 py-1.5 me-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">&nbsp; Sửa &nbsp;</button> <button type="button" class="text-white bg-red-300 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-2 py-1.5 me-2  dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">&nbsp; Xóa &nbsp;</button></td>
              

                                  </tr>
              `);
                            }
                        </script>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>