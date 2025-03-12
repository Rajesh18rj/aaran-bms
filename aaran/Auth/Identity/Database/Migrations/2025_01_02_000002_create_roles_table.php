<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        if (Aaran\Assets\Features\Customise::hasCore()) {

            Schema::create('roles', function (Blueprint $table) {
                $table->id();
                $table->string('vname')->unique(); // Unique role name
                $table->string('slug')->unique()->nullable(); // Unique role identifier
                $table->text('description')->nullable(); // Optional description
                $table->smallInteger('active_id')->nullable();

                // Indexing for better performance
                $table->index(['slug']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
