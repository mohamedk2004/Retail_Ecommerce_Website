<?php
// Save this as hover_button.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Chatbot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            height: 100vh;
        }

        .hover-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 15px 30px;
            background-color: #28a745;
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .hover-button:hover {
            background-color: #218838;
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <!-- PHP dynamically generates the button linking to the chatbot -->
    <a href="test_chatbot.php" class="hover-button">Open Chatbot</a>
</body>
</html>
