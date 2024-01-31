<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .card-header {
            background-color: #6c757d;
            color: #fff;
            padding: 10px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            padding: 20px;
        }

        a {
            display: block;
            margin-top: 10px;
            padding: 10px;
            text-decoration: none;
            background-color: #6c757d;
            color: #fff;
            border-radius: 5px;
        }

        a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Main Page</h1>
        </div>

        <div class="card-body">
            <p>Welcome to the main page!</p>

            <div>
                <a href="{{ route('login') }}">Login</a>
            </div>

            <div>
                <a href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
