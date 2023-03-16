<?php

namespace App\Models;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $table = "profile";
    protected $fillable = [
        "user_id",
        "fullname",
        "photo",
        "gender",
        "birthday",
        "number_phone",
        "address",
        "description",
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'id', 'profile_id');
    }
}
