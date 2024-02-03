<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $wallet->name }} Transactions</title>
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
            width: 800px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #6c757d;
            color: #fff;
        }

        .back-button {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        .delete-button {
            background-color: #dc3545;
            color: #fff;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #bd2130;
        }

        .toggle-fraudulent {
            background-color: #28a745;
            color: #fff;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .toggle-fraudulent.marked {
            background-color: #dc3545;
        }

        .toggle-fraudulent:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{ $wallet->name }} Transactions</h1>
        </div>

        <div class="card-body">
            @if($transactions->isEmpty())
                <p>No transactions available.</p>
            @else
                <p>Total Incoming: ${{ number_format($incomingSum, 2) }} | Total Outgoing: ${{ number_format($outgoingSum, 2) }}</p>
                <table>
                    <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Amount</th>
                        <th>Reason</th>
                        <th>Type</th>
                        <th>Action</th>
                        <th>Mark as Fraudulent</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->sender_account_name }}</td>
                            <td>{{ $transaction->receiver_account_name }}</td>
                            <td>${{ number_format($transaction->amount, 2) }}</td>
                            <td>{{ $transaction->reason }}</td>
                            <td>{{ $transaction->sender_account_name === $wallet->name ? 'Outgoing' : 'Incoming' }}</td>
                            <td>
                                <form method="POST" action="{{ route('transaction.delete', $transaction->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Delete</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('transaction.toggle-fraudulent', $transaction->id) }}">
                                    @csrf
                                    <button type="submit" class="toggle-fraudulent @if($transaction->fraudulent) marked @endif">
                                        @if($transaction->fraudulent)
                                            Unmark as Fraudulent
                                        @else
                                            Mark as Fraudulent
                                        @endif
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <a class="back-button" href="{{ route('wallet.index') }}">Back to Dashboard</a>
        </div>
    </div>
</div>

</body>

</html>
