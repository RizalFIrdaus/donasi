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
        Schema::create('campaign_transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("campaign_id");
            $table->integer("done");
            $table->integer("current_amount");
            $table->timestamps();
            $table->foreign("campaign_id")->references("id")->on("campaign")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_transaction');
    }
};
