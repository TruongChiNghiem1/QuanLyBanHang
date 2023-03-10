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
        Schema::create('_khach_hang', function (Blueprint $table) {
            $table->uuid('MaKH')->primary();
            // $table->uuid();
            $table->String('TenKhachHang');
            $table->String('SoDienThoai')->nullable();
            $table->String('DiaChi')->nullable();
            //1 : khach hang
            //2 : nha cung cap
            //3 : khách lẻ
            $table->integer('LoaiKhachHang');
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
        Schema::dropIfExists('_khach_hang');
    }
};