<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HoaDonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'TenKhachHang' => 'required',
            'hangHoaThem' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'TenKhachHang.required' => 'Vui lòng nhập tên khách hàng',
            'hangHoaThem.required' => 'Vui lòng thêm hàng hóa',
        ];
    }
}
