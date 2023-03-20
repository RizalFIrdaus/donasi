<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "campaign_transaction";
    protected $fillable = [
        "campaign_id",
        "done",
        "current_amount"
    ];
}
