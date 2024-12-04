@extends('admin.master')

@section('content')
    <form action="{{ route('admin._hoa_don.store') }}" id="formThemHoaDon" method="post" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-lg-9">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <input type="hidden" id="HoaDon" value="1"/>
                                <h3 class="m-0">Thêm hóa đơn</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="">
                            @csrf
                            {{-- <div class="row mb-3">
                            <div class="col-lg-15">
                                <label class="form-label" for="inputAddress">Tên khách hàng</label>
                                <select class="form-select" name="MaLoaiHangHoa" id="inputGroupSelect01">
                                    <option selected="">Choose...</option>
                                    @foreach ($khachHang as $kh)
                                        <option value="{{ $kh->MaKH }}">{{ $kh->MaKH . ' - ' . $kh->TenKhachHang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}

                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label class="form-label " for="inputAddress">Tên khách hàng</label>
                                    <input id="searchKhachHang" type="text" class="form-control" name="TenKhachHang"
                                        placeholder="Nguyễn Văn A,...">
                                    <input type="hidden" id="khachHang" class="form-control" name="khachHang">
                                    <div id="searchListKhachHang"></div>
                                </div>
                                <div class="col-lg-2">
                                    <label class="form-label" for="inputAddress">Số điện thoại</label>
                                    <input type="text" class="form-control" name="SoDienThoai" id="inputPhone"
                                        placeholder="09..">
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="inputAddress">Địa chỉ</label>
                                    <input type="text" class="form-control" name="DiaChi" id="diaChi"
                                        placeholder="Ấp Tân Long A, xã Tân Tiến, huyện Đầm Dơi, tỉnh Cà Mau,...">
                                </div>
                            </div>
                            <hr />
                            <div class="row mb-3 ">
                                <div class="row mb-3 col-lg-12">
                                    <div class="col-lg-5">
{{--                                        <div class="input-group">--}}
{{--                                            <div class="input-group-text">--}}
{{--                                                <i class="ti-search"></i>--}}
{{--                                            </div>--}}
{{--                                            <input type="text" class="form-control" name="HangHoa" id="searchHangHoa"--}}
{{--                                                placeholder="Tìm hàng hóa">--}}
{{--                                        </div>--}}
                                        <label class="form-label" for="inputAddress">Hàng hóa</label>
                                        <select id="idHangHoa" name="idHangHoa" class="form-select select2"
                                            style="display:block; position:relative;width:100%;">
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label class="form-label" for="inputAddress">Số lượng</label>
                                        <input type="number" class="form-control" value="1" name="SoLuong"
                                            id="SoLuong">
                                    </div>
                                    <div class="col-lg-2">
                                        <label class="form-label" for="inputAddress">Đơn giá</label>
                                        {{-- <input type='hidden' id="dongia" class="" > --}}
                                        <h5 id="dongia"></h5>
                                    </div>
                                    <div class="col-lg-2">
                                        <label class="form-label" for="inputAddress">Tổng</label>
                                        <h5 id="tong"></h5>
                                    </div>
                                    <div class="col-lg-1">
                                        <label class="form-label" for="inputAddress"></label>
                                        <button type="button" class="btn btn-outline-success mb-3"
                                            id="add">Thêm</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="QA_table mb_30 col-lg-12">
                                    <table class="table " id="subTotal">
                                        <thead>
                                            <tr class="color_tr">
                                                <th scope="col">STT</th>
                                                <th scope="col">Loại hàng hóa</th>
                                                <th scope="col">Tên hàng hóa</th>
                                                <th scope="col">Công dụng</th>
                                                <th scope="col">Đơn giá</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Đơn vị tính</th>
                                                <th scope="col">Tổng</th>
                                                <th scope="col">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody id="new">
                                        </tbody>
                                        <tr>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td class="text-right text-dark">
                                                <h5><strong>Tổng: </strong></h5>
                                            </td>
                                            <td class="text-center text-danger">
                                                <h5 class="btn btn-success rounded-pill mb-3 margin_12" id="totalPayment">
                                                    <strong>
                                                    </strong>
                                                </h5>

                                            </td>
                                            <td> </td>
                                        </tr>
                                    </table>
                                    <div class="mb-3">
                                        <h6 class="card-subtitle mb-2">Ghi chú</h6>
                                        <textarea class="form-control" maxlength="225" rows="3" name="GhiChu" id="maxlength-textarea"
                                            placeholder="Ghi chú">{{ old('GhiChu') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="white_card card_height_100 mb_30 ">
                    <div class="white_card_body typography">
                        <h4 class="f_w_800 btn btn-success rounded-pill mb-3 margin_12">Tiền hàng</h4>
                        <h5 class="f_w_500">Tổng số lượng: <strong id="TongSoLuong">0</strong></h5>
                        <h5 class="f_w_500">Tổng tiền: <strong id="TongTien">0 VNĐ</strong></h5>
                        <h5 class="f_w_500 flex">Chiết khấu: <input type="number" class="form-control chiet_khau"
                                name="ChietKhau" value="0"> %
                        </h5>
                        <hr />
                        <h5 class="f_w_800 btn-outline-danger tongCong1">Tổng cộng: <strong>0 VNĐ</strong></h5>
                    </div>
                    <div class="white_card_body typography">
                        <h4 class="f_w_800 btn btn-success rounded-pill mb-3 margin_12">Công nợ <strong
                                id="vu"></strong>
                        </h4>
                        <h5 class="f_w_500" id="noCu"><input type="hidden" id="NoCuLay" name="NoCu"
                                value="0">Nợ cũ: <strong>0 VNĐ</strong></h5>
                        <h5 class="f_w_500 tongCong2"><input type="hidden" id="NoMoiLay" name="NoMoi"
                                value="0">Nợ mới: <strong>0 VNĐ</strong></h5>
                        <hr />
                        <h5 class="f_w_800 btn-outline-danger ">Tổng công nợ: <strong class="tongCongNo">0 VNĐ</strong>
                        </h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="action" value="ThemVaIn" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Lưu công nợ & in
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="action" value="TienMat" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Tiền mặt
                            </label>
                        </div>
                        {{-- <a href="{{ route('admin._hoa_don.createPDF') }}" class="btn btn-primary color_background">in</a> --}}
{{--                        <button type="submit" name="action" value="ThemVaIn" class="btn btn-primary color_background">Lưu công nợ & in</button>--}}
{{--                        <button type="submit" name="action" value="TienMat" class="btn btn-primary color_background">Tiền mặt</button>--}}
                        <button type="submit" class="btn btn-primary color_background  mt-3">Thêm hóa đơn</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
