<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('bank_books', function (Blueprint $table) {
            $table->id();
            $table->string('vname')->unique();
            $table->string('account_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->foreignId('bank_id')->references('id')->on('commons');
            $table->foreignId('account_type_id')->references('id')->on('commons');
            $table->string('branch')->nullable();
            $table->decimal('opening_balance', 10, 3)->default(0);
            $table->date('opening_date')->nullable();
            $table->longText('notes')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->decimal('active_id', 3)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_books');
    }
};
