<?php
extract(($data));
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f8f8f8;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #d9534f;
        }

        p {
            color: #333;
        }

        .code {
            font-size: 24px;
            font-weight: bold;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Error <span class="code"><?= $code ?></span></h1>
        <p><?= $message ?></p>
    </div>

</body>

</html>