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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('payment_id')->nullable()->after('amount');
            $table->string('payment_method')->nullable()->after('payment_id');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending')->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['payment_id', 'payment_method', 'payment_status']);
        });
    }
};
