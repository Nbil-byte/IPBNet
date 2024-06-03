<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->text('text');
            $table->string('type', 6)->default('post'); // Column to store the type of post ('news' or 'event')
            $table->boolean('found')->default(false); // Additional attribute for 'news' type
            $table->datetime('isOn_start')->nullable(); // Start time for 'event' type
            $table->datetime('isOn_end')->nullable(); // End time for 'event' type
            $table->timestamps();
            $table->string('title',40)->nullable()->default("Title"); // New column for title
            $table->integer('likes')->default(0); // New column for likes

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
