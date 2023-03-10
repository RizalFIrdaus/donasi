<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempCampaign extends Model
{
    use HasFactory;
    protected $table = "temp_campaign";
    protected $fillable = [
        "user_id",
        "donation_photo",
        "donation_photo_file"
    ];
}
