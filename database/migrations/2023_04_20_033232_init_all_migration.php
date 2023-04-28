<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tanggal_all', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('Tanggal');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('doutlet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_store');
            $table->unsignedBigInteger('branch_id_bee_cloud');
            $table->unsignedBigInteger('doutlet_id_laporta');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('list_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sales');
            $table->unsignedBigInteger('id_channel_bee_cloud');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('satuan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('satuan');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('list_item_bee_cloud', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Item');
            
            $table->unsignedBigInteger('id_satuan');
            $table->foreign('id_satuan')->references('id')->on('satuan');

            $table->unsignedBigInteger('bee_cloud_item_id');
            $table->string('bee_cloud_item_code');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('transaksi_bee_cloud', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('id_tanggal');
            $table->foreign('id_tanggal')->references('id')->on('tanggal_all');

            $table->time('time');

            $table->unsignedBigInteger('id_outlet');
            $table->foreign('id_outlet')->references('id')->on('doutlet');

            $table->unsignedBigInteger('id_list_sales');
            $table->foreign('id_list_sales')->references('id')->on('list_sales');

            $table->unsignedInteger('total');

            $table->unsignedBigInteger('id_transaksi_bee_cloud');

            $table->string('trxno_bee_cloud');

            $table->timestamps();
        });
        Schema::create('sinkronisasi_transaksi_bee_cloud', function(Blueprint $table){
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('start_transaksi_id');
            $table->foreign('start_transaksi_id')->references('id')->on('transaksi_bee_cloud');
            
            $table->unsignedBigInteger('end_transaksi_id');
            $table->foreign('end_transaksi_id')->references('id')->on('transaksi_bee_cloud');
            
            $table->timestamps();
        });
        Schema::create('detail_transaksi_bee_cloud', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('id_transaksi');
            $table->foreign('id_transaksi')->references('id')->on('transaksi_bee_cloud');

            $table->unsignedBigInteger('id_list_item');
            $table->foreign('id_list_item')->references('id')->on('list_item_bee_cloud');

            $table->mediumInteger('qty')->unsigned();
            $table->unsignedInteger('total');

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
        //
    }
};
