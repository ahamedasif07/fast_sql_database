<!DOCTYPE html>
<html>

<head>
    <title>All Orders</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </style>
</head>

<body>

    <div class="box">
        <h2>All Submitted Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Button</th>
                </tr>
            </thead>
            <tbody id="loadData">
            </tbody>
        </table>
        <br>
        <a href="index.html">Add New Order</a>
    </div>

    <script>
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

        // Page load হলে auto data load
        $(document).ready(function() {
            loadData();
        });

        // Delete button click
        $(document).on("click", ".delete-btn", function() {
            let id = $(this).data("id");

            if (confirm("Are you sure to delete?")) {
                $.ajax({
                    url: "process.php",
                    type: "POST",
                    data: {
                        action: "delete",
                        id: id
                    },
                    success: function(response) {
                        alert(response);
                        loadData(); // delete পরে আবার load
                    }
                });
            }
        });
    </script>


</body>

</html>