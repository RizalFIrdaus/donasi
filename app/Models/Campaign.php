<?php

namespace App\Models;

use App\Models\Wallet;
use App\Models\Profile;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;
    protected $table = "campaign";
    protected $fillable = [
        "user_id",
        "donation_user",
        "user_phone",
        "review",
        "patient_phone",
        "patient_name",
        "patient_diagnose",
        "inpatient",
        "hospital",
        "effort",
        "resource",
        "donation_duration",
        "donation_amount",
        "donation_detail",
        "donation_title",
        "donation_slug",
        "donation_story",
        "donation_support",
        "donation_photo",
        "donation_photo_file"
    ];

    public function user()
    {
        return $this->belongsTo(Profile::class, 'user_id', 'user_id');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id', 'campaign_id');
    }
}
