<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'surname', 'address', 'message', 'user_id', 'total_price', 'payment_method', 'is_success', 'failed_reason_msg'];

    public function details() {
        return $this->hasMany(OrderDetail::class);
    }
}
