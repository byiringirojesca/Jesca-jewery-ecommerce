<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number', 'user_id', 'total_price', 'status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusColorAttribute(): string
    {
        return match (ucfirst($this->status)) {
            'Pending'    => 'bg-amber-50 text-amber-700 border-amber-200',
            'Processing' => 'bg-blue-50 text-blue-700 border-blue-200',
            'Shipped'    => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'Cancelled'  => 'bg-red-50 text-red-700 border-red-200',
            default      => 'bg-neutral-50 text-neutral-700 border-neutral-200',
        };
    }
}
