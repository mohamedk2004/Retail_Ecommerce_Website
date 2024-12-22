<?php
// Variable to store the chatbot response
$chatbot_response = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the message from the form input
    $message = $_POST['message'];

    // Prepare the data to be sent in JSON format
    $data = json_encode(array("prompt" => $message));

    // Set the URL of your Flask server's endpoint
    $url = 'http://127.0.0.1:5000/generate';  // Adjust if your Flask app is running on a different URL or port

    // Initialize cURL session
    $ch = curl_init($url);

    // Set the cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        $chatbot_response = 'Error: ' . curl_error($ch);
    } else {
        // Decode the JSON response from the Flask server
        $response_data = json_decode($response, true);
        if (isset($response_data['response'])) {
            $chatbot_response = "Chatbot response: " . $response_data['response'];
        } else {
            $chatbot_response = "Error: " . $response_data['error'];
        }
    }

    // Close the cURL session
    curl_close($ch);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Interface</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .chat-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            font-size: 32px;
            color: #28a745; /* Green color */
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-size: 16px;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"] {
            width: 80%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 12px 20px;
            background-color: #28a745; /* Green color */
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .response {
            margin-top: 20px;
            font-size: 18px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #ddd;
            color: #333;
        }

        .error {
            color: #e74c3c; /* Red color for errors */
        }

        .success {
            color: #2ecc71; /* Green color for success */
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h1>Chatbot</h1>

        <!-- Form for user input -->
        <form action="test_chatbot.php" method="POST">
            <label for="message">Enter your message:</label>
            <input type="text" id="message" name="message" required>
            <input type="submit" value="Send">
        </form>

        <?php if ($chatbot_response !== ''): ?>
            <div class="response <?php echo (strpos($chatbot_response, 'Error') !== false) ? 'error' : 'success'; ?>">
                <strong><?php echo $chatbot_response; ?></strong>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>