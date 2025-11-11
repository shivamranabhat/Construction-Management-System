<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
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
}