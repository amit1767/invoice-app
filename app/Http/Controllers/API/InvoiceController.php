<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Transaction;
use Validator;
use Auth;

class InvoiceController extends Controller
{
    public function index(Request $request){
        $invoices = Auth::user()->invoices()->with('transactions')->get();

        return response()->json(['status' => 'success', 'data' => $invoices,]);
    }
}
