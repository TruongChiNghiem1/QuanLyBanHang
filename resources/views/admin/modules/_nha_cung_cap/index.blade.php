@extends('admin.master')

@section('content')
<div class="col-lg-12">
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_body">
            <div class="QA_section">
                <div class="white_box_tittle list_header">
                    <h4>Nhà cung cấp</h4>
                    <div class="box_right d-flex lms_block">
                        {{-- <div class="serach_field_2">
                            <div class="search_inner">
                                <form Active="#">
                                    <div class="search_field">
                                        <input type="text" placeholder="Search content here...">
                                    </div>
                                    <button type="submit"> <i class="ti-search"></i> </button>
                                </form>
                            </div>
                        </div> --}}
                        <div class="add_button ms-2">
                            <a href="{{ route('admin._nha_cung_cap.create') }}" class="btn_1">Thêm nhà cung cấp</a>
                        </div>
                    </div>
                </div>
                <div class="QA_table mb_30">
                    <table id="my_table" class="table ">
                        <thead>
                            <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Tên nhà cung cấp</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Sửa</th>
                                <th scope="col">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nhaCungCap as $ncc)
                                <tr>
                                    <th scope="row"> <a href="#" class="question_content">{{$ncc->MaKH}}</a></th>
                                    <td>{{$ncc->TenKhachHang}}</td>
                                    <td>{{$ncc->SoDienThoai}}</td>
                                    <td>{{$ncc->DiaChi}}</td>
                                    <td><a href="{{ route('admin._nha_cung_cap.edit', ['id' => $ncc->MaKH]) }}" >Sửa</a></td>
                                    <td><a style='color: red;' href="{{ route('admin._nha_cung_cap.destroy', ['id' => $ncc->MaKH]) }}" onclick="return confirm('Bạn có muốn xóa nhà cung cấp này?');">Xóa</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12"></div>
@endsection