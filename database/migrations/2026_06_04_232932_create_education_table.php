<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cv_id')
                ->constrained('cvs')
                ->cascadeOnDelete();

            $table->string('institution');
            $table->string('degree');
            $table->string('location')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['cv_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
