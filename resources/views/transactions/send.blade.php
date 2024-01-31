<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Transaction</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select,
        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #6c757d;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #495057;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .success {
            color: green;
            text-align: center;
        }
    </style>
</head>

<body>

<h1>Send Transaction</h1>

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('transactions.send') }}">
    @csrf

    <label for="sender_wallet_name">Sender Wallet:</label>
    <select name="sender_wallet_name" required>
        @foreach($userWallets as $wallet)
            <option value="{{ $wallet->name }}">{{ $wallet->name }}</option>
        @endforeach
    </select>

    <label for="receiver_wallet_name">Receiver Wallet (Name):</label>
    <input type="text" name="receiver_wallet_name" required>

    <label for="amount">Amount:</label>
    <input type="number" name="amount" step="0.01" required>

    <label for="reason">Reason (optional):</label>
    <textarea name="reason"></textarea>

    <button type="submit">Send Transaction</button>
</form>

<a href="{{ route('dashboard') }}">Back to Dashboard</a>

</body>

</html>
