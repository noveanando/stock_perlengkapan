<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asset_code')->nullable();
            $table->string('item_name');
            $table->integer('category_id')->nullable();
            $table->text('asset_desc')->nullable();
            $table->integer('asset_status_id');
            $table->integer('location_id')->nullable();
            $table->integer('child_location_id')->nullable();
            $table->integer('media_id')->nullable();
            $table->integer('company_id');
            $table->date('purchase_date')->nullable();
            $table->decimal('price', 11, 0)->nullable();
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
        Schema::dropIfExists('assets');
    }
}
