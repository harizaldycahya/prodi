<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenutunggalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menutunggals', function (Blueprint $table) {
            $table->id();
            $table->enum('bahasa', ['indonesia', 'english'])->default('indonesia');
            $table->string('judul')->default('-')->nullable();
            $table->string('slug')->nullable();
            $table->text('konten')->default('-')->nullable();
            $table->string('author')->default('-')->nullable();
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
        Schema::dropIfExists('menutunggals');
    }
}
