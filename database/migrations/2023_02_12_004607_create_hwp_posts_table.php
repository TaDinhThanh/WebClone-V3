<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHwpPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hwp_posts', function (Blueprint $table) {
            $table->bigIncrements("ID");
            $table->unsignedBigInteger('post_author')->default(0);
            $table->dateTime('post_date')->nullable()->default(null);
            $table->dateTime('post_date_gmt')->nullable()->default(null);
            $table->longText('post_content');
            $table->text('post_title');
            $table->text('post_excerpt');
            $table->string('post_status',20)->default("publish");
            $table->string('comment_status',20)->default("open");
            $table->string('ping_status')->default("open");
            $table->string('post_password',255)->default('');
            $table->string('post_name',200)->default('');
            $table->text('to_ping',200);
            $table->text('pinged',200);
            $table->dateTime('post_modified')->nullable()->default(null);
            $table->dateTime('post_modified_gmt')->nullable()->default(null);
            $table->longText('post_content_filtered',200);
            $table->unsignedBigInteger('post_parent')->default(0);
            $table->string('guid',255)->default('');
            $table->integer('menu_order')->default(0);
            $table->string('post_type',20)->default('post');
            $table->string('post_mime_type',100)->default('');
            $table->bigInteger('comment_count')->default(0);
            $table->string('post_view',200)->nullable()->default(null);
            $table->integer('id_key')->default(0);
            $table->integer('id_url')->default(0);
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
        Schema::dropIfExists('hwp_posts');
    }
}
