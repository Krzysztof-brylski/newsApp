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
        Schema::create('live_relation_messages', function (Blueprint $table) {
            $table->id();
            $table->string('relation_title');
            $table->string('title',200);
            $table->string('content');
            $table->foreignId('prev_message')->constrained('live_relation_messages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_relation_messages');
    }
};
