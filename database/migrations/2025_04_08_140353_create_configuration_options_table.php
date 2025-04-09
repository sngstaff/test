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
        Schema::create('configuration_options', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('configuration_id');
            $table->unsignedBigInteger('option_id');

            $table->foreign('configuration_id')
                ->on('configurations')
                ->references('id')
                ->cascadeOnDelete();

            $table->foreign('option_id')
                ->on('options')
                ->references('id')
                ->cascadeOnDelete();

            $table->unique(['configuration_id', 'option_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuration_options');
    }
};
