<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poll_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_option_id')->constrained()->cascadeOnDelete();
            $table->foreignId('poll_id')->constrained()->cascadeOnDelete();
            $table->string('ip_address', 45);
            $table->text('response_text')->nullable();
            $table->timestamps();

            $table->unique(['poll_id', 'ip_address', 'poll_option_id'], 'poll_vote_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poll_votes');
    }
};
