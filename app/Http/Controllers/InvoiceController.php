<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Transaction;
use Validator;

class InvoiceController extends Controller
{
    public function show($id){
        $invoice = Invoice::with('transactions')->findOrFail($id);

        return view('invoices.show', compact('invoice'));
    }

    public function pay(Request $request, $id){
        $invoice = Invoice::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
            'payment_mode' => 'required|in:cash,online',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $paymentAmount = $request->amount;
    
        if($paymentAmount > $invoice->remaining_balance){
            return redirect()->back()->withErrors(['amount' => 'Payment amount cannot exceed remaining balance.'])->withInput();
        }
    
        Transaction::create([
            'invoice_id' => $invoice->id,
            'amount' => $paymentAmount,
            'payment_mode' => $request->payment_mode,
        ]);
    
        $invoice->amount_paid += $paymentAmount;
        $invoice->remaining_balance -= $paymentAmount;
        $invoice->transaction_count += 1;
    
        if($invoice->remaining_balance === 0){
            $invoice->status = 'Paid';
        }elseif($paymentAmount > 0){
            $invoice->status = 'Partially Paid';
        }
    
        $invoice->save();
    
        return redirect()->route('invoices.show', $invoice->id)->with('status', 'Payment successful!');
    }
    
    


}
