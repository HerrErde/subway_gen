<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            text-align: center;
            padding: 50px;
        }

        .error-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #dc3545;
        }

        p {
            margin-bottom: 20px;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <h1>Error</h1>
        <p><?php echo isset($_SESSION["error"]) ? $_SESSION["error"] : "An error occurred."; ?></p>
        <a href="#" onclick="history.go(-1);" class="back-button">Go Back to Safety</a>
    </div>
</body>

</html>