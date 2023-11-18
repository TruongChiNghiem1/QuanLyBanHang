<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HangHoaRequest extends FormRequest
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
            'MaLoaiHangHoa' => 'required',
            'image' => request()->route('MaHang')
                ? 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                : 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'TenHangHoa' => request()->route('id')
                ? ('required|' . Rule::unique('_hang_hoa')->ignore(request()->route('id'), 'MaHang'))
                : 'required|unique:_hang_hoa',
            'DonGia' => 'required|integer',
            'SoLuong' => 'required|integer',
            'SoLuongCanhBao' => 'required|integer',
            'DonViTinh' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'MaLoaiHangHoa.required' => 'Vui lòng chọn loại hàng hóa',
            'image.mimes' => 'Vui lòng chọn đúng định dạng hình',
            'image.image' => 'Vui lòng chọn đúng định dạng hình',
            'image.max' => 'Ảnh tối đa 2MB',
            'TenHangHoa.required' => 'Vui lòng nhập tên hàng hóa',
            'TenHangHoa.unique' => 'Sản phẩm này tồn tại rồi',
            'DonGia.required' => 'Vui lòng nhập đơn giá',
            'DonGia.integer' => 'Đơn giá phải là số',
            'SoLuong.required' => 'Vui lòng nhập số lượng trong kho',
            'SoLuong.integer' => 'Số lượng phải là số',
            'SoLuongCanhBao.required' => 'Vui lòng nhập số lượng cảnh báo khi sắp hết hàng',
            'SoLuongCanhBao.integer' => 'Số lượng cảnh báo phải là số',
            'DonViTinh.required' => 'Vui lòng nhập đơn vị tính cho hàng hóa này',
        ];
    }
}
