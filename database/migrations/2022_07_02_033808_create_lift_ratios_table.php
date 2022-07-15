<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiftRatiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lift_ratio', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('riwayat_id')->default(0);
            $table->double('support_B', 10, 4);
            $table->string('itemset');
            $table->bigInteger('support_count_itemset');
            $table->double('confidence', 10, 4);
            $table->double('confidence_persen', 10, 4);
            $table->double('lift_ratio', 10, 4);
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
        Schema::dropIfExists('lift_ratio');
    }
}
