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
        Schema::create('_hang_hoa', function (Blueprint $table) {
            $table->id('MaHang');
            $table->unsignedBigInteger('MaLoaiHangHoa')->nullable();
            $table->foreign('MaLoaiHangHoa')->references('MaLoaiHangHoa')->on('_loai_hang_hoa');
            $table->String('image')->nullable();
            $table->String('TenHangHoa');
            $table->String('DonViTinh')->nullable();
            $table->String('CongDung')->nullable();
            $table->integer('DonGia');
            $table->integer('SoLuong');
            $table->integer('SoLuongCanhBao')->default(5);
            $table->date('NgayNhapMoiNhat')->nullable();
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
        Schema::dropIfExists('_hang_hoa');
    }
};