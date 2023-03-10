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
        Schema::create('_loai_hang_hoa', function (Blueprint $table) {
            $table->id('MaLoaiHangHoa');
            $table->String('LoaiHangHoa');
            $table->String('CongDung')->nullable();
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
        Schema::dropIfExists('_loai_hang_hoa');
    }
};
