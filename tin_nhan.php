<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tin nhắn</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .admin-container {
            display: flex;
            padding: 20px;
            flex-wrap: wrap;
        }

        .sidebar {
            width: 250px;
            padding: 20px;
            background-color: #3594d3;
            color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #ffdd57;
        }

        .content {
            flex: 1;
            margin-left: 20px;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .content h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            font-size: 1rem;
        }

        td {
            font-size: 0.95rem;
        }

        td select {
            padding: 6px;
            border-radius: 4px;
            font-size: 0.9rem;
            width: 150px;
            border: 1px solid #ddd;
        }

        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            font-size: 0.9rem;
            display: inline-block;
        }

        .btn-edit {
            background-color: #28a745;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        /* Add media query for responsiveness */
        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                margin-bottom: 20px;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <?php include('header_admin.php') ?>
    <main class="admin-container">
        
        <section class="content">
            <h1>Phản hồi người dùng</h1>
            <table>
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Tin nhắn</th>
                        <th>Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'database.php';
                        $sql = "SELECT * FROM lienhe";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['ten'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['sdt'] . "</td>";
                                echo "<td>" . $row['tin_nhan'] . "</td>";

                                // Dropdown for updating response status
                                $status = $row['status']; 
                                echo "<td>
                                        <form action='update_status.php' method='POST' class='status'>
                                            <select name='status' onchange='this.form.submit()'>
                                                <option value='0' " . ($status == 0 ? 'selected' : '') . ">Chưa phản hồi</option>
                                                <option value='1' " . ($status == 1 ? 'selected' : '') . ">Đã phản hồi</option>
                                            </select>
                                            <input type='hidden' name='id' value='" . $row['id'] . "' />
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Không có tin nhắn nào!</td></tr>";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <?php include('footer.php') ?>
</body>
</html>
