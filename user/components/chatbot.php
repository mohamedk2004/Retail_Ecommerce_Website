<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Button</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Button style */
        .chatbot-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        /* Hover effect */
        .chatbot-button:hover {
            transform: scale(1.1);
            background-color: #0056b3;
        }
        
        /* Chatbox style */
        .chatbox {
            display: none;
            position: fixed;
            bottom: 100px;
            right: 20px;
            width: 300px;
            height: 400px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            padding: 10px;
            z-index: 1000;
        }
    </style>
</head>
<body>

    <!-- Chatbot Button -->
    <div id="chatbotButton" class="chatbot-button">
        <span>&#128172;</span> <!-- Chat icon -->
    </div>

    <!-- Chatbox (Hidden by default) -->
    <div id="chatbox" class="chatbox">
        <p>Welcome to our chat! How can we help you?</p>
        <!-- Add chat content here -->
    </div>

    <script>
        // JavaScript to toggle the chatbox visibility
        document.getElementById('chatbotButton').addEventListener('click', function() {
            const chatbox = document.getElementById('chatbox');
            if (chatbox.style.display === 'none' || chatbox.style.display === '') {
                chatbox.style.display = 'block';
            } else {
                chatbox.style.display = 'none';
            }
        });
    </script>

</body>
</html>
