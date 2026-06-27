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
        Schema::table('running_texts', function (Blueprint $table) {
            $table->dropColumn(['display_order', 'background_color', 'text_color']);
        });
    }

    public function down(): void
    {
        Schema::table('running_texts', function (Blueprint $table) {
            $table->integer('display_order')->default(0);
            $table->string('background_color')->default('#000000');
            $table->string('text_color')->default('#ffffff');
        });
    }
};
