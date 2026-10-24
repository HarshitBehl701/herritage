<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * The slug resolver always probes the SubCategory model, so the table and
     * the nullable product key must exist even when the panel does not expose
     * sub-categories.
     */
    public function up(): void
    {
        if (!Schema::hasTable('sub_categories')) {
            Schema::create('sub_categories', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('order')->unique()->nullable();
                $table->foreignId('category_id')
                    ->constrained()
                    ->cascadeOnDelete();
                $table->string('slug')->unique();
                $table->string('title');
                $table->string('image')->nullable();
                $table->text('description')->nullable();
                $table->json('content')->nullable();
                $table->boolean('status')->default(true);
                $table->boolean('featured')->default(false);
                $table->boolean('explore')->default(false);
                $table->boolean('seo')->default(false);
                $table->softDeletes();
                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('products', 'sub_category_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->foreignId('sub_category_id')
                    ->nullable()
                    ->after('category_id')
                    ->constrained()
                    ->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('products', 'sub_category_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropConstrainedForeignId('sub_category_id');
            });
        }

        Schema::dropIfExists('sub_categories');
    }
};
