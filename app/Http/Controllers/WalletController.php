<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class WalletController extends Controller
{
    public function index()
    {
        $userWallets = auth()->user()->wallets;
        return view('wallet.index', compact('userWallets'));
    }

    public function create()
    {
        return view('wallet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:wallets,name',
        ]);

        $wallet = new Wallet([
            'name' => $request->input('name'),
            'balance' => 0,
        ]);

        auth()->user()->wallets()->save($wallet);

        return redirect()->route('wallet.index')->with('success', 'Wallet created successfully!');
    }

    public function edit(Wallet $wallet)
    {
        return view('wallet.edit', compact('wallet'));
    }

    public function update(Request $request, Wallet $wallet)
    {
        $request->validate([
            'name' => 'required|string|unique:wallets,name,' . $wallet->id,
        ]);

        $oldName = $wallet->name;

        $wallet->update([
            'name' => $request->input('name'),
        ]);

        Transaction::where('sender_account_name', $oldName)
            ->update(['sender_account_name' => $wallet->name]);

        Transaction::where('receiver_account_name', $oldName)
            ->update(['receiver_account_name' => $wallet->name]);

        return redirect()->route('wallet.index')->with('success', 'Wallet updated successfully!');
    }


    public function destroy(Wallet $wallet)
    {
        $wallet->delete();

        return redirect()->route('wallet.index')->with('success', 'Wallet deleted successfully!');
    }

    public function transactions($accountName)
    {
        $wallet = Wallet::where('name', $accountName)->firstOrFail();

        $transactions = $wallet->senderTransactions()
            ->orWhere('receiver_account_name', $accountName)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $incomingSum = $wallet->receiverTransactions()->sum('amount');
        $outgoingSum = $wallet->senderTransactions()->sum('amount');

        Paginator::useBootstrap();

        return view('wallet.transactions', compact('wallet', 'transactions', 'incomingSum', 'outgoingSum'));
    }

    public function deleteTransaction(Transaction $transaction)
    {
        $transaction->delete();

        return back()->with('success', 'Transaction deleted successfully!');
    }

}
