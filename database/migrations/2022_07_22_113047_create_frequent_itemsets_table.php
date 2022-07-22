<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequentItemsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequent_itemset', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('riwayat_id')->default(0);
            $table->string('itemset');
            $table->bigInteger('support_count');
            $table->double('support', 10, 4);
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
        Schema::dropIfExists('frequent_itemset');
    }
}
