<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];

    $stmt = $conn->prepare("INSERT INTO tasks (title) VALUES (?)");
    $stmt->bind_param("s", $title);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

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
            background-color: #ffffff;
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

        input[type="text"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #dcdde1;
            border-radius: 4px;
        }

        button {
            background-color: #44bd32;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cd137;
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

        @media (max-height: 500px) {
            body {
                align-items: flex-start;
                padding-top: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Task</h2>
        <form method="POST" action="">
            <label for="title">Task Title:</label>
            <input type="text" name="title" id="title" required>
            <button type="submit">Add Task</button>
        </form>
        <a class="back-link" href="index.php">Back to List</a>
    </div>
</body>
</html>
