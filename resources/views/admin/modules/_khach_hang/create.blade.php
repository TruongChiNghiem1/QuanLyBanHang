@extends('admin.master')

@section('content')
    <form action="{{ route('admin._khach_hang.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Thêm khách hàng</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Tên khách hàng</label>
                            <input type="text" class="form-control" value="{{ old('TenKhachHang') }}" name="TenKhachHang"
                                id="inputAddress" placeholder="Đoàn Thảo Vy,...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Số điện thoại</label>
                            <input type="text" class="form-control" value="{{ old('SoDienThoai') }}" name="SoDienThoai"
                                id="inputAddress" placeholder="09...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Địa chỉ</label>
                            <input type="text" class="form-control" value="{{ old('DiaChi') }}" name="DiaChi"
                                id="inputAddress" placeholder="ấp Tân Long A, xã Tân Tiến, huyện Đầm dơi,...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection
