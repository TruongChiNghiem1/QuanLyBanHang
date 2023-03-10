@extends('admin.master')

@section('content')
    <form action="{{ route('admin._khach_hang.update', ['id' => $khachHang->MaKH]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Sửa khách hàng</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Tên khách hàng</label>
                            <input type="text" class="form-control" name="TenKhachHang" id="inputAddress"
                            value="{{ old('TenKhachHang', $khachHang->TenKhachHang) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Số điện thoại</label>
                            <input type="text" class="form-control" name="SoDienThoai" id="inputAddress"
                            value="{{ old('SoDienThoai', $khachHang->SoDienThoai) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Địa chỉ</label>
                            <input type="text" class="form-control" name="DiaChi" id="inputAddress"
                                placeholder="ấp Tân Long A, xã Tân Tiến, huyện Đầm dơi,..." value="{{ old('DiaChi', $khachHang->DiaChi) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div id="CongNo1" class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Công nợ</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Vụ</label>
                            <input type="text" class="form-control" name="Vu" id="inputAddress"
                                placeholder="1,2,3,4,...">
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" for="inputAddress">Số tiền</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money" name="SoTien"
                                        aria-label="Dollar amount (with dot and two decimal places)" id="checkMoney">
                                    <div class="input-group-text">
                                        <span class="">VND</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="inputAddress">Đã thanh toán</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money" name="DaThanhToan"
                                        aria-label="Dollar amount (with dot and two decimal places)" id="checkMoney">
                                    <div class="input-group-text">
                                        <span class="">VND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="inputAddress">Ngày bắt đầu</label>
                                <input type="date" class="form-control" name="NgayBatDau" id="inputDate">
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="inputAddress">Ngày kết thúc</label>
                                <input type="date" class="form-control" name="NgayKetThuc" id="inputDate">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
@endsection
