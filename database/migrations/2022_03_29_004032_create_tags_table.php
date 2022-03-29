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
        Schema::create('meowtags', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->timestamps();
        });

        Schema::create('meow_meowtag', function (Blueprint $table) {
            $table->foreignId('meow_id')->constrained();
            $table->foreignId('meowtag_id')->constrained();
            $table->primary(['meow_id', 'meowtag_id']);
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
