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
        Schema::create('blog_posts_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_post_id');
            $table->foreignId('blog_tag_id');
            $table->timestamps();

            $table->foreign('blog_post_id')
                ->references('id')
                ->on('blog_posts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('blog_tag_id')
                ->references('id')
                ->on('blog_tags')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts_tags');
    }
};
