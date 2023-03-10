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
        Schema::create('hoadon_hanghoa', function (Blueprint $table) {
            $table->id('MaHoaDonHangHoa');
            $table->unsignedBigInteger('MaHoaDon')->nullable();
            $table->foreign('MaHoaDon')->references('MaHoaDon')->on('_hoa_don');

            $table->unsignedBigInteger('MaHang')->nullable();
            $table->foreign('MaHang')->references('MaHang')->on('_hang_hoa');
            $table->integer('SoLuong');
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
        Schema::dropIfExists('hoadon_hanghoa');
    }
};
