<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 50px;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .container {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.5s ease-in-out;
            width: 90%;
            max-width: 500px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .display-1 {
            font-size: 4rem;
            color: #fff;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 10px;
            color: #fff;
        }

        p {
            margin-bottom: 20px;
            font-size: 1.1rem;
            color: #fff;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff; /* White text */
            background-color: #4d4d4d; /* Black button */
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #353434; /* Darker gray on hover */
        }

        img {
            width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="display-1">403</h1>
        <h2>Unauthorized Access</h2>
        <p>You do not have permission to access this page.</p>
    </div>
</body>
</html>
