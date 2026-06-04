<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cv_id')
                ->constrained('cvs')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('level')->nullable();
            $table->string('certification')->nullable();
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['cv_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
