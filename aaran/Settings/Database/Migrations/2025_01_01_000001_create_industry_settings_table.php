<?php

namespace Aaran\Core\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustrySettingsTable extends Migration
{
    public function up()
    {
        Schema::create('industry_settings', function (Blueprint $table) {
            $table->id();
            $table->string('industry');
            $table->string('key');
            $table->text('value')->nullable();
            $table->timestamps();
            $table->unique(['industry', 'key']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('industry_settings');
    }
}
