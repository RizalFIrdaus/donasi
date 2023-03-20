<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationUser extends Model
{
    use HasFactory;
    protected $table = "donation_user";
    protected $fillable = [
        "user_id",
        "campaign_id",
        "donation_amount",
        "message",
    ];
    public function user()
    {
        return $this->belongsTo(Profile::class, 'user_id', 'user_id');
    }
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }
}
