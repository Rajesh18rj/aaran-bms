<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        if (Aaran\Assets\Features\Customise::hasCore()) {

            Schema::create('role_user', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
                $table->timestamps();

                // Composite primary key for optimization
                $table->primary(['user_id', 'role_id']);

                // Indexing for faster queries
                $table->index(['user_id', 'role_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
