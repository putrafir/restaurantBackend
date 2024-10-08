<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['queue_number', 'total_price', 'status', 'order_date'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
