<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        p {
            margin-bottom: 20px;
        }

        button {
            background-color: #6c757d;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #495057;
        }

        h2 {
            margin-top: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>


<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Welcome to Your Dashboard</h1>
        </div>
        <div class="card-body">
            @auth
                <p>Hello, {{ auth()->user()->name }}!</p>
            @endauth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>

            <h2>Your Wallets</h2>
            <ul>
                <li><a href="{{ route('wallet.index') }}">View Wallets</a></li>
                <li><a href="{{ route('wallet.create') }}">Create Wallet</a></li>
                <li><a href="{{ route('transactions.send') }}">Send Transaction</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
