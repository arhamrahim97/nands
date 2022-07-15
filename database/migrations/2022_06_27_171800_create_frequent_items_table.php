<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequent_item', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('riwayat_id')->default(0);
            $table->string('inisialisasi');
            $table->text('nama_barang');
            $table->bigInteger('support_count');
            $table->double('support', 10, 4);
            // $table->double('support_persen', 10, 4);
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
        Schema::dropIfExists('frequent_item');
    }
}
