<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->timestamps();
        });

        Schema::create('meow_tag', function (Blueprint $table) {
            $table->foreignId('meow_id')->constrained();
            $table->foreignId('tag_id')->constrained();
            $table->primary(['meow_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meow_tag');
        Schema::dropIfExists('tags');
    }
};
