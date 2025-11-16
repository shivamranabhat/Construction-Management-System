<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;
use App\Models\Scopes\ActiveProjectScope;

class Bill extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
        static::addGlobalScope(new ActiveProjectScope);
    }
    protected $fillable = [
        'vendor_id', 'purchase_id', 'project_id', 'company_id',
        'bill_number', 'bill_date', 'due_date', 'subtotal', 'tax', 'total',
        'status', 'notes', 'slug'
    ];

    public function vendor() { return $this->belongsTo(Vendor::class); }
    public function project() { return $this->belongsTo(Project::class); }
    public function purchase() { return $this->belongsTo(Purchase::class); }
    public function items() { return $this->hasMany(BillItem::class); }

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($b) => $b->slug = \Str::slug($b->bill_number));
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments->sum('amount');
    }

    public function getRemainingAmountAttribute()
    {
        return max(0, $this->total - $this->total_paid);
    }

    public function updatePaymentStatus()
    {
        $totalPaid = $this->total_paid;
        $total = $this->total;

        if ($totalPaid >= $total - 0.01) {
            $this->update(['status' => 'paid']);
        } elseif ($totalPaid > 0.01) {
            $this->update(['status' => 'partially_paid']);
        } else {
            $this->update(['status' => 'draft']);
        }
    }
    
}