<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHwpPostsHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hwp_posts_hd', function (Blueprint $table) {
            $table->integer('ID_HD');
            $table->bigInteger('postHD_author');
            $table->dateTime('postHD_date');
            $table->dateTime('postHD_date_gmt');
            $table->longText('postHD_content');
            $table->text('postHD_title');
            $table->string('postHD_status',20);
            $table->string('postHD_name',200);
            $table->dateTime('postHD_modified');
            $table->dateTime('postHD_modified_gmt');
            $table->string('postHD_type',20);
            $table->string('postHD_view',1500);
            $table->string('keyHD',50);
            $table->mediumText('description');
            $table->longText('twitter_image');
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
        Schema::dropIfExists('hwp_posts_hd');
    }
}
