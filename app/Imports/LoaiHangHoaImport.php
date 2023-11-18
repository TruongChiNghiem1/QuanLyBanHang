<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToModel;

class LoaiHangHoaImport implements ToModel, WithStartRow
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
        $congDung = $row[2];
        $error = false;
        if(empty($name)){
            $this->errors[] = 'Loại hàng hóa dòng <b>'. $row[0] .'</b> không được trống';
            $error = true;
        } else {
            $checkDuplicatePhone = DB::table('_loai_hang_hoa')->where('LoaiHangHoa', $name)->exists();
            if($checkDuplicatePhone){
                $this->errors[] = 'Loại hàng hóa dòng <b>'. $row[0] .'</b> đã tồn tại';
                $error = true;
            }
        }

        if($error) {
            return null;
        }

        $data['created_at'] = new \DateTime();
        $data['LoaiHangHoa'] = $name;
        $data['CongDung'] = $congDung;
        DB::table('_loai_hang_hoa')->insert($data);
    }

    public function startRow(): int
    {
        return 3;
    }
}
