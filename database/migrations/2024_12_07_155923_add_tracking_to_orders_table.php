<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add columns for tracking
            $table->string('status')->default('Pending'); // Order status
            $table->unsignedBigInteger('partner_id')->nullable(); // Foreign key for partner
            $table->foreign('partner_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('volunteer_id')->nullable(); // Foreign key for volunteer
            $table->foreign('volunteer_id')->references('id')->on('users')->onDelete('set null');
            $table->string('pickup_location')->nullable(); // Pickup location
            $table->string('delivery_location')->nullable(); // Delivery location
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the new columns if rolling back
            $table->dropColumn(['status', 'partner_id', 'volunteer_id', 'pickup_location', 'delivery_location']);
        });
    }
};
