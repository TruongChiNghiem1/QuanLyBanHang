<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class LoaiHangHoaRequest extends FormRequest
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
            'LoaiHangHoa' => request()->route('id')
                ? ('required|' . Rule::unique('_loai_hang_hoa')->ignore(request()->route('id'), 'MaLoaiHangHoa'))
                : 'required|unique:_loai_hang_hoa',
        ];
    }

    public function messages(){
        return [
            'LoaiHangHoa.required' => 'Vui lòng nhập loại hàng hóa',
            'LoaiHangHoa.unique' => 'Loại hàng hóa này đã tồn tại rồi'
        ];
    }
}
