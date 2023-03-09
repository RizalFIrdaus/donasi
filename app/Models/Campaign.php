<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $table = "campaign";
    protected $fillable = [
        "user_id",
        "donation_user",
        "user_phone",
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
}
