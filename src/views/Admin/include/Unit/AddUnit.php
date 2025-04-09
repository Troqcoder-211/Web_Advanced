<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Thêm Đơn Vị Tính</h2>

        <form id="unit-form" class="space-y-6">
            <!-- Mã đơn vị -->
            <!-- <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Mã đơn vị</label>
                <input type="text" name="unit_code" placeholder="VD: DV001"
                    class="w-full border rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div> -->

            <!-- Tên đơn vị -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Tên đơn vị</label>
                <input type="text" name="unit_name" placeholder="VD: Cup, ml, ..."
                    class="w-full border rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Mô tả -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Mô tả (tùy chọn)</label>
                <textarea name="unit_description" maxlength="255" rows="3" placeholder="Nhập mô tả cho đơn vị "
                    maxlength="255"
                    class="w-full border rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Nút lưu -->
            <div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:outline-none">
                    Lưu đơn vị
                </button>
            </div>
        </form>
    </div>

    <!-- Script demo xử lý submit form -->
    <script>
    document.getElementById("unit-form").addEventListener("submit", function(e) {
        e.preventDefault();
        alert("Đơn vị đã được lưu!");
        // Tại đây bạn có thể tích hợp gọi API hoặc chuyển hướng trang sau khi lưu.
    });
    </script>
</body>

</html>