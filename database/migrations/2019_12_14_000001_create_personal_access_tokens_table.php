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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
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
        Schema::dropIfExists('personal_access_tokens');
        
        Schema::dropIfExists('sinkronisasi_transaksi_bee_cloud');
        Schema::dropIfExists('detail_transaksi_bee_cloud');
        Schema::dropIfExists('transaksi_bee_cloud');
        Schema::dropIfExists('list_item_bee_cloud');
        Schema::dropIfExists('satuan');
        Schema::dropIfExists('list_sales');
        Schema::dropIfExists('doutlet');
        Schema::dropIfExists('tanggal_all');
    }
};
