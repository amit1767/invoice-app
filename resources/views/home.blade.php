@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <h4 class="mt-4">Your Invoices</h4>
                    @if($invoices->isEmpty())
                        <p>No invoices found.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Total Amount</th>
                                    <th>Amount Paid</th>
                                    <th>Remaining Balance</th>
                                    <th>Status</th>
                                    <th>Total Transactions</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>${{ number_format($invoice->total_amount, 2) }}</td>
                                        <td>${{ number_format($invoice->amount_paid, 2) }}</td>
                                        <td>${{ number_format($invoice->remaining_balance, 2) }}</td>
                                        <td>{{ $invoice->status }}</td>
                                        <td>{{ $invoice->transaction_count }}</td>
                                        <td>{{ date('Y-m-d', strtotime($invoice->due_date)) }}</td>
                                        <td>
                                            <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
