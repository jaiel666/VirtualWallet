<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $userWallets = auth()->user()->wallets;

        return view('transactions.send', compact('userWallets'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'sender_wallet_name' => 'required',
            'receiver_wallet_name' => 'required',
            'amount' => 'required|numeric|min:0.01',
            'reason' => 'nullable|string',
        ]);

        $senderWallet = auth()->user()->wallets()->where('name', $request->input('sender_wallet_name'))->first();

        $receiverWallet = Wallet::where('name', $request->input('receiver_wallet_name'))->first();

        if ($senderWallet && $receiverWallet) {
            if ($senderWallet->balance >= $request->input('amount')) {
                $senderWallet->decrement('balance', $request->input('amount'));
                $receiverWallet->increment('balance', $request->input('amount'));

                Transaction::create([
                    'sender_account_name' => $senderWallet->name,
                    'receiver_account_name' => $receiverWallet->name,
                    'amount' => $request->input('amount'),
                    'reason' => $request->input('reason'),
                    'fraudulent' => false,
                ]);

                return redirect()->route('dashboard')->with('success', 'Transaction sent successfully.');
            } else {
                return redirect()->route('dashboard')->with('error', 'Insufficient funds.');
            }
        } else {
            return redirect()->route('dashboard')->with('error', 'Sender or receiver wallet not found.');
        }
    }

    public function toggleFraudulent($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update(['fraudulent' => !$transaction->fraudulent]);

        $status = $transaction->fraudulent ? 'marked as fraudulent' : 'marked as not fraudulent';

        return redirect()->back()->with('success', "Transaction {$status}.");
    }
}
