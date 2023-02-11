<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Mail\TrxMail;
use App\Mail\Invoiced;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class TransactionController extends Controller
{
    public function show($reference)
    {
        $tripay = new PaymentController();
        $detail = $tripay->detailTrx($reference);
        return view('show', compact('detail'));
    }

    public function store(Request $request)
    {

        $product = Shop::find($request->product_id);
        $method = $request -> method;

        $stock = $product->stock;
        $stock = $stock-1;
        $product->update([
            'stock'=>$stock
        ]);

        $req = new PaymentController();
        $transaction = $req->ReqPayment($method, $product);

        Transaction::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'reference' => $transaction->reference,
            'merchant_ref' => $transaction->merchant_ref,
            'total_amount' => $transaction->amount,
            'status' => $transaction->status,
        ]);
        $mail = Transaction::latest()->get();
        $email = auth()->user()->email;

        Mail::to($email)->send(new TrxMail($mail));

        return redirect()->route('transaction.show', ['reference' => $transaction->reference]);


    }

    public function history()
    {
        $trx = Transaction::latest()->get();
        return view('dashboard.trx.index', compact('trx'));
    }

    public function mail()
    {
        return view('emails.invoice.index');
    }


}
