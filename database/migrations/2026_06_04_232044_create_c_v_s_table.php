<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('job_offer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('professional_title')->nullable();
            $table->text('professional_summary')->nullable();

            $table->string('language', 2)->default('es');

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['job_offer_id', 'deleted_at']);
            $table->index(['user_id', 'job_offer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
