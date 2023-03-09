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
            $table->unsignedBigInteger("user_id")->nullable();
            $table->string("visible")->nullable();
            $table->string("donation_user")->nullable();
            $table->string("user_phone")->nullable();
            $table->string("patient_phone")->nullable();
            $table->string("patient_name")->nullable();
            $table->string("patient_diagnose")->nullable();
            $table->string("inpatient")->nullable();
            $table->string("hospital")->nullable();
            $table->longText("effort")->nullable();
            $table->string("resource")->nullable();
            $table->string("donation_duration")->nullable();
            $table->string("donation_amount")->nullable();
            $table->longText("donation_detail")->nullable();
            $table->string("donation_title")->nullable();
            $table->string("donation_slug")->nullable();
            $table->longText("donation_story")->nullable();
            $table->longText("donation_support")->nullable();
            $table->string("donation_photo", 1000)->nullable();
            $table->string("donation_photo_file")->nullable();
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
