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
        Schema::create('_hoa_don', function (Blueprint $table) {
            $table->id('MaHoaDon');
            $table->uuid('MaKH')->nullable();
            $table->foreign('MaKH')->references('MaKH')->on('_khach_hang');
            $table->integer('Vu');
            $table->date('NgayGiao');
            $table->float('ChietKhau')->default(0);
            $table->integer('NoCu')->default(0);
            $table->String('GhiChu')->nullable();
            //1: Hoa don ban hang
            //2: Hoa don ban hang tien mat
            //3: Hoa don nhap hang
            //4: Hoa don nhap hang tien mat
            $table->unsignedBigInteger('LoaiHoaDon');
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
        Schema::dropIfExists('_hoa_don');
    }
};