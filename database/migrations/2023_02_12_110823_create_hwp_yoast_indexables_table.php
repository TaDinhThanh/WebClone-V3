<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHwpYoastIndexablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hwp_yoast_indexables', function (Blueprint $table) {
            $table->id();
            $table->longText('permalink')->nullable()->default(null);
            $table->string('permalink_hash', 40)->nullable()->default(null);
            $table->bigInteger('object_id')->nullable()->default(null);
            $table->string('object_type', 32);
            $table->string('object_sub_type', 32)->nullable()->default(null);
            $table->bigInteger('author_id')->nullable()->default(null);
            $table->bigInteger('post_parent')->nullable()->default(null);
            $table->text('title')->nullable()->default(null);
            $table->mediumText('description')->nullable()->default(null);
            $table->text('breadcrumb_title')->nullable()->default(null);
            $table->string('post_status', 20)->nullable()->default(null);
            $table->tinyInteger('is_public')->nullable()->default(null);
            $table->tinyInteger('is_protected')->default(0);
            $table->tinyInteger('has_public_posts')->nullable()->default(null);
            $table->unsignedInteger('number_of_pages')->nullable()->default(null);
            $table->longText('canonical')->nullable()->default(null);
            $table->string('primary_focus_keyword', 191)->nullable()->default(null);
            $table->integer('primary_focus_keyword_score')->nullable()->default(null);
            $table->integer('readability_score')->nullable()->default(0);
            $table->tinyInteger('is_cornerstone')->nullable()->default(0);
            $table->tinyInteger('is_robots_noindex')->nullable()->default(0);
            $table->tinyInteger('is_robots_nofollow')->nullable()->default(0);
            $table->tinyInteger('is_robots_noarchive')->nullable()->default(0);
            $table->tinyInteger('is_robots_noimageindex')->nullable()->default(0);
            $table->tinyInteger('is_robots_nosnippet')->nullable()->default(0);
            $table->text('twitter_title')->nullable()->default(null);
            $table->longText('twitter_image')->nullable()->default(null);
            $table->longText('twitter_description')->nullable()->default(null);
            $table->string('twitter_image_id', 191)->nullable()->default(null);
            $table->text('twitter_image_source')->nullable()->default(null);
            $table->text('open_graph_title')->nullable()->default(null);
            $table->longText('open_graph_description')->nullable()->default(null);
            $table->longText('open_graph_image')->nullable()->default(null);
            $table->string('open_graph_image_id', 191)->nullable()->default(null);
            $table->text('open_graph_image_source')->nullable()->default(null);
            $table->mediumText('open_graph_image_meta')->nullable()->default(null);
            $table->integer('link_count')->nullable()->default(null);
            $table->integer('incoming_link_count')->nullable()->default(null);
            $table->integer('prominent_words_version')->nullable()->default(null);
            $table->bigInteger('blog_id')->default(1);
            $table->string('language', 32)->nullable()->default(null);
            $table->string('region', 32)->nullable()->default(null);
            $table->string('schema_page_type', 64)->nullable()->default(null);
            $table->string('schema_article_type', 64)->nullable()->default(null);
            $table->tinyInteger('has_ancestors')->nullable()->default(0);
            $table->integer('estimated_reading_time_minutes')->nullable()->default(null);
            $table->integer('version')->default(1);
            $table->dateTime('object_last_modified')->nullable()->default(null);
            $table->dateTime('object_published_at')->nullable()->default(null);
            $table->string('meta_robot', 50);
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
        Schema::dropIfExists('hwp_yoast_indexables');
    }
}
