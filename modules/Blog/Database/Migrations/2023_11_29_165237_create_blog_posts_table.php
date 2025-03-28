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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_author_id')->nullable();
            $table->foreignId('blog_category_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->string('meta_tag_title', 60)->nullable();
            $table->string('meta_tag_description', 160)->nullable();
            $table->date('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('blog_author_id')
                ->references('id')
                ->on('blog_authors')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreign('blog_category_id')
                ->references('id')
                ->on('blog_categories')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
