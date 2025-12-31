<!DOCTYPE html>
<html>

<head>
    <title>All Orders</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            background: #f4f4f4;
        }

        .box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #045cb4;
            color: white;
        }

        /* এডিট বাটনের জন্য কাস্টম স্টাইল */
        .edit-btn {
            background-color: #3b82f6;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            margin-right: 5px;
        }

        .delete-btn {
            background-color: #ef4444;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="box">
        <h2 class="text-2xl font-bold mb-4">All Submitted Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="loadData">
            </tbody>
        </table>
        <br>
        <a href="index.html" class="text-blue-600 underline">Add New Order</a>
    </div>

    <div id="editModal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 transition-opacity">
        <div class="bg-white w-full max-w-md mx-auto rounded-xl shadow-2xl p-6 relative">
            <button onclick="closeModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-2xl">&times;</button>

            <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Edit Order Info</h3>

            <form id="editForm" class="space-y-4">
                <input type="hidden" id="edit_id" name="id">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" id="edit_fname" name="firstName"
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" id="edit_lname" name="lastName"
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="edit_email" name="email"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" id="edit_city" name="city"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 shadow-md">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // ডাটা লোড করার ফাংশন
        function loadData() {
            $.ajax({
                url: "process.php",
                type: "POST",
                data: {
                    action: "fetch"
                },
                success: function(data) {
                    $("#loadData").html(data);
                }
            });
        }

        $(document).ready(function() {
            loadData();
        });

        // Delete button click
        $(document).on("click", ".delete-btn", function() {
            let id = $(this).data("id");
            if (confirm("Are you sure to delete?")) {
                $.ajax({
                    url: "process.php", // আপনার প্রসেস ফাইলে অ্যাকশন পাঠাচ্ছি
                    type: "POST",
                    data: {
                        action: "delete",
                        id: id
                    },
                    success: function(response) {
                        alert(response);
                        loadData();
                    }
                });
            }
        });

        // Edit button click - ওপেন মডাল
        $(document).on("click", ".edit-btn", function() {
            // বাটন থেকে ডাটা নেওয়া
            let id = $(this).data("id");
            let fname = $(this).data("fname");
            let lname = $(this).data("lname");
            let email = $(this).data("email");
            let city = $(this).data("city");

            // মডালের ইনপুটে ডাটা বসানো
            $("#edit_id").val(id);
            $("#edit_fname").val(fname);
            $("#edit_lname").val(lname);
            $("#edit_email").val(email);
            $("#edit_city").val(city);

            // মডাল দেখানো
            $("#editModal").removeClass("hidden");
        });

        // মডাল বন্ধ করার ফাংশন
        function closeModal() {
            $("#editModal").addClass("hidden");
        }

        // এডিট ফর্ম সাবমিট (Update AJAX)
        $("#editForm").on("submit", function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            formData += "&action=update";

            $.ajax({
                url: "update.php",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.trim() == "success") {
                        alert("Updated Successfully!");
                        closeModal();
                        loadData();
                    } else {
                        alert("Update failed: " + response);
                    }
                }
            });
        });
    </script>

</body>

</html>