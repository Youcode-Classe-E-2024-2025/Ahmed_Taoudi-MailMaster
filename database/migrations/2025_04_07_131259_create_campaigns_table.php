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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('newsletter_id')->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->enum('status', ['en préparation', 'envoyée', 'échouée'])->default('en préparation');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });


        Schema::create('campaign_subscriber', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscriber_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('campaign_subscriber');
    }
};
