<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHwpVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hwp_videos', function (Blueprint $table) {
            $table->id();
            $table->string('link',1000)->nullable()->default(null);
            $table->integer('id_key')->nullable()->default(null);
            $table->string('video_title',1045)->nullable()->default(null);
            $table->string('video_description',1045)->nullable()->default(null);
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
        Schema::dropIfExists('hwp_videos');
    }
}
