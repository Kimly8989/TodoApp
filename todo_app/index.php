<?php
include 'db.php';

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #2f3640;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #44bd32;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #4cd137;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            max-width: 800px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #dcdde1;
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #f1f2f6;
            color: #2f3640;
        }

        td {
            color: #353b48;
        }

        a.action-link {
            color: #2980b9;
            text-decoration: none;
            margin-right: 10px;
        }

        a.action-link:hover {
            text-decoration: underline;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            color: white;
            font-size: 0.85em;
            font-weight: bold;
        }

        .status-pending {
            background-color: #e67e22;
        }

        .status-done {
            background-color: #27ae60;
        }

        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            tr {
                margin-bottom: 15px;
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }

            th {
                display: none;
            }
        }
    </style>
</head>
<body>
    <h2>To-Do List</h2>
    <a href="create.php" class="btn">+ Add New Task</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td data-label="ID"><?php echo $row['id']; ?></td>
            <td data-label="Title"><?php echo htmlspecialchars($row['title']); ?></td>
            <td data-label="Status">
                <span class="status-badge <?php echo strtolower($row['status']) === 'done' ? 'status-done' : 'status-pending'; ?>">
                    <?php echo $row['status']; ?>
                </span>
            </td>
            <td data-label="Actions">
                <a class="action-link" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a class="action-link" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>
