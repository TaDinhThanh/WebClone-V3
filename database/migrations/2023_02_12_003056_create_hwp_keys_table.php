<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHwpKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hwp_keys', function (Blueprint $table) {
            $table->id();
            $table->string("tien_to",245)->nullable()->default('');
            $table->string("ten",255)->default('');
            $table->string("hau_to",245)->nullable()->default('');
            $table->string("url_key_cha",245)->nullable()->default('');
            $table->boolean("check")->default(0);
            $table->integer("id_cam")->default(0);
            $table->string("ky_hieu",145)->nullable()->default(null);
            $table->string("key_con_1",245)->nullable()->default('');
            $table->string("url_key_con_1",1045)->nullable()->default('');
            $table->string("key_con_2",245)->nullable()->default('');
            $table->string("url_key_con_2",1045)->nullable()->default('');
            $table->string("key_con_3",245)->nullable()->default('');
            $table->string("url_key_con_3",1045)->nullable()->default('');
            $table->string("key_con_4",245)->nullable()->default('');
            $table->string("url_key_con_4",1045)->nullable()->default('');
            $table->string("top_view_1",245)->nullable()->default('');
            $table->string("url_top_view_1",1045)->nullable()->default('');
            $table->string("top_view_2",245)->nullable()->default('');
            $table->string("url_top_view_2",1045)->nullable()->default('');
            $table->string("top_view_3",245)->nullable()->default('');
            $table->string("url_top_view_3",1045)->nullable()->default('');
            $table->string("top_view_4",245)->nullable()->default('');
            $table->string("url_top_view_4",1045)->nullable()->default('');
            $table->string("top_view_5",245)->nullable()->default('');
            $table->string("url_top_view_5",1045)->nullable()->default('');
            $table->string("id_list_vd",45)->nullable()->default(null);
            $table->integer("count_request_y")->nullable()->default(null);
            $table->integer("count_request_g")->nullable()->default(null);
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
        Schema::dropIfExists('hwp_keys');
    }
}
