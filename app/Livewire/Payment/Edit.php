<?php

namespace App\Livewire\Payment;

use App\Models\Payment;
use App\Models\Bill;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Edit extends Component
{
    public $slug;
    public $payment;
    public $bill_id, $amount, $payment_date, $payment_method, $reference, $notes;

    public $bill; // For validation

    public function mount( $slug)
    {
        $payment = Payment::where('slug', $slug)->firstOrFail();
        $this->payment = $payment;
        $this->bill = $this->payment->bill;

        $this->bill_id = $this->payment->bill_id;
        $this->amount = $this->payment->amount;
        $this->payment_date = $this->payment->payment_date->format('Y-m-d');
        $this->payment_method = $this->payment->payment_method;
        $this->reference = $this->payment->reference;
        $this->notes = $this->payment->notes;
    }

    public function updatedAmount()
    {
        $this->validateAmount();
    }

    public function validateAmount()
    {
        $currentPaid = $this->bill->total_paid - $this->payment->amount; // exclude current payment
        $newTotalPaid = $currentPaid + $this->amount;
        $billTotal = $this->bill->total;

        if ($this->amount < 0.01) {
            $this->addError('amount', 'Amount must be at least £0.01.');
        } elseif ($newTotalPaid > $billTotal + 0.01) {
            $this->addError('amount', "Cannot exceed bill total. Max: £" . number_format($billTotal - $currentPaid, 2));
        }
    }

    public function save()
    {
        $this->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:bank_transfer,cash,card,cheque',
            'reference' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $this->validateAmount();

        DB::transaction(function () {
            // Update payment
            $this->payment->update([
                'amount' => $this->amount,
                'payment_date' => $this->payment_date,
                'payment_method' => $this->payment_method,
                'reference' => $this->reference,
                'notes' => $this->notes,
            ]);

            // Manually update bill status
            $this->updateBillStatus();
        });

        return redirect()->route('payment.index');
    }

    protected function updateBillStatus()
    {
        $totalPaid = $this->bill->payments()->sum('amount');
        $total = $this->bill->total;

        $status = 'draft';
        if ($totalPaid >= $total - 0.01) {
            $status = 'paid';
        } elseif ($totalPaid > 0.01) {
            $status = 'partially_paid';
        }

        $this->bill->update(['status' => $status]);
    }

    public function render()
    {
        return view('livewire.payment.edit');
    }
}