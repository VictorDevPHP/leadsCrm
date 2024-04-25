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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('id_meta')->nullable();
            $table->string('id_google')->nullable();
            $table->decimal('monthly_payment', 8, 2)->nullable();
            $table->string('type_payment')->nullable();
            $table->decimal('budget_monthly', 8, 2)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
