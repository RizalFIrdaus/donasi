<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaign', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("visible");
            $table->string("donation_user");
            $table->string("user_phone");
            $table->string("patient_phone")->nullable();
            $table->string("patient_name");
            $table->string("patient_diagnose");
            $table->string("inpatient");
            $table->string("hospital");
            $table->longText("effort");
            $table->string("resource");
            $table->string("donation_duration");
            $table->string("donation_amount");
            $table->longText("donation_detail");
            $table->string("donation_title");
            $table->string("donation_slug");
            $table->longText("donation_story");
            $table->longText("donation_support");
            $table->string("donation_photo", 1000);
            $table->string("donation_photo_file");
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign');
    }
};
