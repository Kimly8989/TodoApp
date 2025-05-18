<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Task ID not provided.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tasks SET title = ?, status = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $status, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();
$stmt->close();

if (!$task) {
    die("Task not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: #fff;
            padding: 30px 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #2f3640;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            color: #2f3640;
        }

        input[type="text"],
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #dcdde1;
            border-radius: 4px;
        }

        button {
            background-color: #0097e6;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #00a8ff;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #273c75;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Task</h2>
        <form method="POST" action="">
            <label for="title">Task Title:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>

            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="Pending" <?php if ($task['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="Done" <?php if ($task['status'] == 'Done') echo 'selected'; ?>>Done</option>
            </select>

            <button type="submit">Update Task</button>
        </form>
        <a class="back-link" href="index.php">Back to List</a>
    </div>
</body>
</html>
