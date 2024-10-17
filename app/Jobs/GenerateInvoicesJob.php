<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;

class GenerateInvoicesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Invoice::create([
                'user_id' => $user->id,
                'invoice_number' => str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'total_amount' => 250.50,
                'due_date' => Carbon::now()->addDays(1),
                'status' => 'Pending',
                'transaction_count' => 0,
                'amount_paid' => 0,
                'remaining_balance' => 250.50,
                'late_fee' => 0,
                'interest' => 0,
            ]);
        }
    }
}
