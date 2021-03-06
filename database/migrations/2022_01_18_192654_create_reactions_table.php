<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->boolean('type'); /*  Like/dislike  */

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('post_id')
                ->nullable()
                ->constrained('posts')
                ->cascadeOnDelete();

            $table->foreignId('comment_id')
                ->nullable()
                ->constrained('comments')
                ->cascadeOnDelete();

            $table->foreignId('nested_comment_id')
                ->nullable()
                ->constrained('nested_comments')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reactions');
    }
};
