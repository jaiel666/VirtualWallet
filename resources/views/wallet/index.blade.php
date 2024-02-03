<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallets</title>
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

        .wallet {
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .wallet p {
            margin: 0;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .edit-button, .delete-button, .history-button {
            padding: 8px 16px;
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            line-height: 1;
        }

        .edit-button:hover, .delete-button:hover, .history-button:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Wallets</h1>
        </div>

        <div class="card-body">
            @foreach($userWallets as $wallet)
                <div class="wallet">
                    <p>Name: {{ $wallet->name }}</p>
                    <p>Balance: {{ $wallet->balance }}</p>
                    <div class="action-buttons">
                        <a class="edit-button" href="{{ route('wallet.edit', $wallet->id) }}">Edit</a>
                        <form method="POST" action="{{ route('wallet.destroy', $wallet->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        <a class="history-button" href="{{ route('wallet.transactions', $wallet->name) }}">History</a>
                    </div>
                </div>
            @endforeach
            <a href="{{ route('dashboard') }}">Back to Wallets</a>
        </div>
    </div>
</div>

</body>
</html>
