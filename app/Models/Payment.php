<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_date',
        'user_id',
        'qty'
    ];

    public function getUser() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
