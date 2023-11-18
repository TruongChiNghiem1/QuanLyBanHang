<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UserImport implements ToModel, WithStartRow
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
        $name = $row[1];
        $phone = $row[2];
        $address = $row[3];
        $error = false;
        if(empty($name)){
            $this->errors[] = 'Tên khách hàng dòng <b>'. $row[0] .'</b> không được trống';
            $error = true;
        }
        if(empty($phone)){
            $this->errors[] = 'Số điện thoại dòng <b>'. $row[0] .'</b> không được trống';
            $error = true;
        } else {
            $checkDuplicatePhone = DB::table('_khach_hang')->where('SoDienThoai', $phone)->exists();
            if($checkDuplicatePhone){
                $this->errors[] = 'Số điện thoại dòng <b>'. $row[0] .'</b> đã tồn tại';
                $error = true;
            }
        }
//        else if(is_numeric($phone)){
//            $this->errors[] = 'Số điện thoại dòng <b>'. $row[0] .'</b> phải là số';
//            $error = true;
//        }

        if(empty($address)){
            $this->errors[] = 'Địa chỉ dòng <b>'. $row[0] .'</b> không được trống';
            $error = true;
        }



        if($error) {
            return null;
        }

        $data['MaKH'] = Str::uuid();
        $data['LoaiKhachHang'] = 1;
        $data['created_at'] = new \DateTime();
        $data['TenKhachHang'] = $name;
        $data['SoDienThoai'] = $phone;
        $data['DiaChi'] = $address;
        DB::table('_khach_hang')->insert($data);
    }

    public function startRow(): int
    {
        return 3;
    }
}
