<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHwpTermTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hwp_term_taxonomies', function (Blueprint $table) {
            $table->bigIncrements('term_taxonomy_id');
            $table->bigInteger('term_id')->default(0);
            $table->string('taxonomy',32)->default('');
            $table->longText('description');
            $table->unsignedBigInteger('parent')->default(0);
            $table->integer('count')->default(0);
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
        Schema::dropIfExists('hwp_term_taxonomies');
    }
}
