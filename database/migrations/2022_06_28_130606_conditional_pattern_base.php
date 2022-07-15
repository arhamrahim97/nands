<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConditionalPatternBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conditional_pattern_base', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('riwayat_id')->default(0);
            $table->string('nama_barang');
            $table->text('conditional_pattern_base');
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
        Schema::dropIfExists('conditional_pattern_base');
    }
}
