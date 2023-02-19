<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHwpHwTrendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hwp_hw_trending', function (Blueprint $table) {
            $table->bigIncrements("ID");
            $table->unsignedBigInteger('post_id')->default(0);
            $table->dateTime('post_date')->nullable();
            $table->string('post_type',20)->default("");
            $table->string('action',20)->default("");
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hwp_hw_trending');
    }
}
