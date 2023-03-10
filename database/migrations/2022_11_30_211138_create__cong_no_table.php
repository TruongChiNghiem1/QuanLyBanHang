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
        Schema::create('_cong_no', function (Blueprint $table) {
            $table->id('MaCongNo');
            // $table->uuid();
            $table->uuid('MaKH')->nullable();
            $table->foreign('MaKH')->references('MaKH')->on('_khach_hang');
            $table->integer('Vu');
            $table->integer('SoTien')->default(0);
            $table->integer('DaThanhToan')->nullable();
            $table->date('NgayBatDau')->nullable();
            $table->date('NgayKetThuc')->nullable();
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
        Schema::dropIfExists('_cong_no');
    }
};