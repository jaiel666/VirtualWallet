<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wallet</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
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
            padding: 20px;
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
            margin-bottom: 5px;
            color: #495057;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        .error-message {
            color: red;
            margin-top: 5px;
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

        a {
            text-decoration: none;
            color: #007bff;
            margin-top: 10px;
            display: block;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h1>Edit Wallet</h1>
    </div>
    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('wallet.update', $wallet->id) }}">
        @csrf
        @method('PUT')
        <label for="name">Wallet Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $wallet->name) }}" required>
        @error('name')
        <span class="error-message">{{ $message }}</span>
        @enderror

        <button type="submit">Update Wallet</button>
    </form>

    <a href="{{ route('wallet.index') }}">Back to Wallets</a>
</div>

</body>
</html>
