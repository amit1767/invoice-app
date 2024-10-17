@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Invoice Details') }}</div>

                <div class="card-body">
                    <h4 class="text-primary">Invoice Number: {{ $invoice->invoice_number }}</h4>
                    <p><strong>Total Amount:</strong> ${{ number_format($invoice->total_amount, 2) }}</p>
                    <p><strong>Amount Paid:</strong> ${{ number_format($invoice->amount_paid, 2) }}</p>
                    <p><strong>Remaining Balance:</strong> ${{ number_format($invoice->remaining_balance, 2) }}</p>
                    <p><strong>Status:</strong> {{ $invoice->status }}</p>
                    <p><strong>Due Date:</strong> {{ date('Y-m-d', strtotime($invoice->due_date)) }}</p>

                    <h5 class="mt-4">Transactions</h5>
                    @if($invoice->transactions->isEmpty())
                        <p class="text-muted">No transactions found for this invoice.</p>
                    @else
                        <ul class="list-group">
                            @foreach($invoice->transactions as $transaction)
                                <li class="list-group-item">
                                    Amount: ${{ number_format($transaction->amount, 2) }} ({{ ucfirst($transaction->payment_mode) }})
                                    <small class="text-muted">Date: {{ date('Y-m-d H:i', strtotime($transaction->created_at)) }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <h5 class="mt-4">Make a Payment</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (date('Y-m-d') <= $invoice->due_date)
                        <form action="{{ route('invoices.pay', $invoice->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Payment Amount:</label>
                                <input type="number" name="amount" id="amount" class="form-control" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="payment_mode">Payment Mode:</label>
                                <select name="payment_mode" id="payment_mode" class="form-control" required>
                                    <option value="cash">Cash</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Submit Payment</button>
                        </form>
                    @else
                        <p class="text-danger">Payment option is no longer available as the due date has passed.</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
