<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('author')->nullable()->constrained('users')->onDelete('set null');
            $table->text('content');
            $table->foreignId('post-id')->nullable()->constrained('posts')->onDelete('set null');
            $table->foreignId('comment-id')->nullable()->constrained('comments')->onDelete('set null');
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
        Schema::dropIfExists('comments');
    }
}
