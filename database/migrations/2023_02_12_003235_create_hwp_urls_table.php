<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHwpUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hwp_urls', function (Blueprint $table) {
            $table->id();
            $table->string('url',1005);
            $table->string('id_key',45);
            $table->boolean('check')->default(0)->comment('False là chưa đọc, True là đọc rồi');
            $table->string('url_image',1045)->nullable()->default(null);
            $table->string('ky_hieu',45)->nullable()->default(null);
            $table->string('url_title',1045)->nullable()->default(null);
            $table->string('url_description',3000)->nullable()->default(null);
            $table->integer('stt')->nullable()->default(null);
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
        Schema::dropIfExists('hwp_urls');
    }
}
