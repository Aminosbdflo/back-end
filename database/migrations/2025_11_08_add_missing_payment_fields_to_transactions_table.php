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
            if (!Schema::hasColumn('transactions', 'payment_id')) {
                $table->string('payment_id')->nullable()->after('amount');
            }
            if (!Schema::hasColumn('transactions', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('payment_id');
            }
            if (!Schema::hasColumn('transactions', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending')->after('payment_method');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'payment_id')) {
                $table->dropColumn('payment_id');
            }
            if (Schema::hasColumn('transactions', 'payment_method')) {
                $table->dropColumn('payment_method');
            }
            if (Schema::hasColumn('transactions', 'payment_status')) {
                $table->dropColumn('payment_status');
            }
        });
    }
};
