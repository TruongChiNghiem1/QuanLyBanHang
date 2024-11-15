<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToModel;

class HangHoaImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $errors =[];
    public function __construct()
    {
        $this->errors = [];
    }

    public function model(array $row)
    {
        $maLoaiHangHoa = $row[1];
        $tenHangHoa = $row[3];
        $donGia = $row[4];
        $soLuong = $row[5];
        $soLuongCanhBao = $row[6];
        $donViTinh = $row[7];
        $congDung = $row[8];
        $error = false;
        if(empty($maLoaiHangHoa)){
            $this->errors[] = 'Mã loại hàng hóa dòng <b>'. $row[0] .'</b> không được trống';
            $error = true;
        } else {
            $checkExistsLHH = DB::table('_loai_hang_hoa')->where('MaLoaiHangHoa', $maLoaiHangHoa)->exists();
            if(!$checkExistsLHH){
                $this->errors[] = 'Mã loại hàng hóa dòng <b>'. $row[0] .'</b> không tồn tại';
                $error = true;
            }
        }
        if(empty($donGia) && $donGia != 0){
            $this->errors[] = 'Đơn giá dòng <b>'. $row[0] .'</b> không được trống';
            $error = true;
        }
        if(empty($soLuong)){
            $this->errors[] = 'Số lượng dòng <b>'. $row[0] .'</b> không được trống';
            $error = true;
        }
        if(empty($soLuongCanhBao)){
            $this->errors[] = 'Số lượng cảnh báo dòng <b>'. $row[0] .'</b> không được trống';
            $error = true;
        }
        if(empty($donViTinh)){
            $this->errors[] = 'Đơn vị tính dòng <b>'. $row[0] .'</b> không được trống';
            $error = true;
        }
        if(empty($tenHangHoa)){
            $this->errors[] = 'Tên hàng hóa dòng <b>'. $row[0] .'</b> không được trống';
            $error = true;
        } else {
            $checkDuplicatePhone = DB::table('_hang_hoa')->where('TenHangHoa', $tenHangHoa)->exists();
            if($checkDuplicatePhone){
                $this->errors[] = 'Tên hàng hóa dòng <b>'. $row[0] .'</b> đã tồn tại';
                $error = true;
            }
        }

        if($error) {
            return null;
        }

        $data['created_at'] = new \DateTime();
        $data['MaLoaiHangHoa'] = $maLoaiHangHoa;
        $data['TenHangHoa'] = $tenHangHoa;
        $data['DonViTinh'] = $donViTinh;
        $data['DonGia'] = $donGia;
        $data['SoLuong'] = $soLuong;
        $data['SoLuongCanhBao'] = $soLuongCanhBao;
        $data['CongDung'] = $congDung;
        DB::table('_hang_hoa')->insert($data);
    }

    public function startRow(): int
    {
        return 3;
    }
}
