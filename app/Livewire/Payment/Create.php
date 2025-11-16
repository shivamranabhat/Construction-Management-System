<?php

namespace App\Livewire\Payment;

use App\Models\Bill;
use App\Models\Payment;
use Livewire\Component;

class Create extends Component
{
    public $bill_id;
    public $amount;
    public $payment_date;
    public $payment_method = 'bank_transfer';
    public $reference;
    public $notes;

    public $bills;

    public function mount()
    {
        $this->bills = Bill::whereIn('status', ['draft', 'partially_paid'])
            ->where('company_id', auth()->user()->company_id)
            ->with('vendor')
            ->get();

        $this->payment_date = now()->format('Y-m-d');
    }

    public function updatedBillId()
    {
        $bill = Bill::find($this->bill_id);
        if ($bill) {
            $this->amount = $bill->remaining_amount;
        }
    }

    public function save()
    {
        $this->validate([
            'bill_id' => 'required|exists:bills,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:bank_transfer,cash,card,cheque',
            'reference' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $bill = Bill::find($this->bill_id);
        if ($this->amount > $bill->remaining_amount) {
            $this->addError('amount', "Cannot pay more than £" . number_format($bill->remaining_amount, 2));
            return;
        }

        Payment::create([
            'bill_id' => $this->bill_id,
            'project_id' => $bill->project_id,
            'company_id' => auth()->user()->company_id,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
            'payment_method' => $this->payment_method,
            'reference' => $this->reference,
            'notes' => $this->notes,
            'slug'=>'pay'.uniqid(),
        ]);



        return redirect()->route('payment.index');
    }

    public function render()
    {
        return view('livewire.payment.create');
    }
}