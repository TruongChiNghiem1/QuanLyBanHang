<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;

    protected $table = '_khach_hang';
    protected $primaryKey = 'MaKhachHang';
    protected $fillable = [
        'TenKhachHang',
        'SoDienThoai',
        'DiaChi',
        'LoaiKhachHang',
    ];
}
