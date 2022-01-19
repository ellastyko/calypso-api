<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('type' , ['like', 'dislike', 'none'])->default('none');
            $table->foreignId('post_id')->nullable()->constrained('posts')->onDelete('set null');
            $table->foreignId('comment_id')->nullable()->constrained('comments')->onDelete('set null');
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
        Schema::dropIfExists('likes');
    }
}
