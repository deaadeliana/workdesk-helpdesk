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
         Schema::create('tickets', function (Blueprint $table) {
        $table->id();

        $table->string('ticket_number')->unique();

        $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->foreignId('ticket_category_id')
            ->constrained('ticket_categories')
            ->restrictOnDelete();

        $table->foreignId('technician_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->string('title');

        $table->text('description');

        $table->enum('priority', [
            'low',
            'medium',
            'high',
        ])->default('medium');

        $table->enum('status', [
            'open',
            'in_progress',
            'resolved',
            'closed',
        ])->default('open');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
