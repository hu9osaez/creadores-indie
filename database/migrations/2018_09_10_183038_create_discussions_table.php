<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_category')->unsigned()->default(1);
            $table->integer('id_user')->unsigned();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->boolean('sticky')->default(false);
            $table->integer('views')->unsigned()->default(0);
            $table->boolean('answered')->default(0);
            $table->timestamp('last_reply_at')->useCurrent();
            $table->timestamps();
            $table->softDeletes();

            $table->index('slug');

            $table->foreign('id_category')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussions');
    }
}
