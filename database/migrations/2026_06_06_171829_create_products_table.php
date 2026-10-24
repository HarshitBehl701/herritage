<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (config('app.panel.product_required')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('order')->unique()->nullable();
                if (config('app.panel.category_required')) {
                    $table->foreignId('category_id')
                        ->constrained()
                        ->nullable()
                        ->cascadeOnDelete();
                }
                if (config('app.panel.category_required') && config('app.panel.sub_category_required')) {
                    $table->foreignId('sub_category_id')
                        ->constrained()
                        ->nullable()
                        ->cascadeOnDelete();
                }
                $table->string("slug")->unique();
                $table->string("title");
                $table->string("image")->nullable();
                $table->text("description")->nullable();
                $table->json("content")->nullable();
                $table->boolean("status")->default(true);
                $table->boolean("featured")->default(false);
                $table->boolean("explore")->default(false);
                $table->boolean("seo")->default(false);
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
