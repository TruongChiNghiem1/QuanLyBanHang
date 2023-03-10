<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CongNoRequest extends FormRequest
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
            'MaKH' => 'required',
            'Vu' => 'required',
            'NgayBatDau' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'MaKH.required' => 'Vui lòng chọn khách hàng cho công nợ này',
            'Vu.required' => 'Vui lòng nhập vụ mấy',
            'NgayBatDau.required' => 'Vui lòng chọn ngày bắt đầu vụ'
        ];
    }
}
