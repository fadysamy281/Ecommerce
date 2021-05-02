<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeValueProductAttributeTable extends Migration
{

    public function up()
    {
        Schema::create('attribute_value_product_attribute', function (Blueprint $table) {
            $table->bigIncrements('id');

          //  $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

            $table->foreignId('attribute_value_id')->constrained('attribute_values');
            $table->foreignId('product_attribute_id')->constrained('product_attributes');
        });
    }


    public function down()
    {
        Schema::dropIfExists('attribute_value_product_attribute');
    }
}
