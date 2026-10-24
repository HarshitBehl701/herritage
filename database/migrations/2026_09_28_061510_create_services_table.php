<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (config('app.panel.service_required')) {
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('order')->unique()->nullable();
                $table->foreignId('parent_id')
                    ->nullable()
                    ->constrained('services')
                    ->nullOnDelete();
                
                $table->string('slug')->unique();
                $table->string('title');
                $table->string('image')->nullable();
                $table->text('description')->nullable();
                $table->json('content')->nullable();

                $table->boolean('status')->default(true);
                $table->boolean('explore')->default(false);
                $table->boolean('seo')->default(false);
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};