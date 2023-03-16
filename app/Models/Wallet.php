<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;
    protected $table = "wallet";
    protected $fillable = [
        "profile_id",
        "wallet",
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id', 'wallet_id');
    }
}
