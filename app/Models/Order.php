<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullName',
        'email',
        'phone',
        'additionalPhone',
        'location',
        'address',
        'user_id',
        'product_id',
        'qty',
        'total_price',
        'discount',
        'advance',
        'gateway',
        'payment_status',
        'order_status',
        'note',
    ];
    
    public function getProducts() {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    
    public function getUser() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
