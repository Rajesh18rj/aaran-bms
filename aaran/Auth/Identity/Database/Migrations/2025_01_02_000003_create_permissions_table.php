<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        if (Aaran\Assets\Features\Customise::hasCore()) {

            Schema::create('permissions', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->smallInteger('active_id')->nullable();
                $table->timestamps();

                // Indexing for fast lookups
                $table->index(['slug']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
