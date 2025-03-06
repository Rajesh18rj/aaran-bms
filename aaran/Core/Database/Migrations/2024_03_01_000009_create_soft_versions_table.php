<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        if (Aaran\Assets\Features\Customise::hasCore()) {

            Schema::create('soft_versions', function (Blueprint $table) {
                $table->id();
                $table->string('soft_version');
                $table->string('db_version');
                $table->string('title')->nullable();
                $table->longText('body')->nullable();
                $table->tinyInteger('active_id')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('soft_versions');
    }
};
