<?php

namespace App\Livewire\Payment;

use App\Models\Payment;
use App\Models\Bill;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function delete($slug)
    {
        $payment = Payment::where('slug', $slug)->firstOrFail();
        $bill = Bill::find($payment->bill_id);
        $bill->update(['status'=>'draft']);
        $payment->delete();
    }

    public function render()
    {
        $payments = Payment::with(['bill', 'company'])
            ->whereHas('bill', fn($q) => $q->where('bill_number', 'like', "%{$this->search}%"))
            ->orWhere('reference', 'like', "%{$this->search}%")
            ->orWhere('payment_method', 'like', "%{$this->search}%")
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.payment.index', compact('payments'));
    }
}