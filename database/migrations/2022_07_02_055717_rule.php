<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rule', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('riwayat_id')->default(0);
            // $table->text('rule');
            $table->text('if');
            $table->text('then');
            $table->bigInteger('support_count');
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
        Schema::dropIfExists('rule');
    }
}
