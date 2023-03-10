@extends('admin.master')

@section('content')
<div class="col-lg-12">
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
            <div class="box_header m-0">
                <div class="main-title">
                    <h3 class="m-0">Thêm nhà cung cấp</h3>
                </div>
            </div>
        </div>
        <div class="white_card_body">
            <div class="card-body">
                <form action="{{ route('admin._nha_cung_cap.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="inputAddress">Tên nhà cung cấp</label>
                        <input type="text" class="form-control" name="TenKhachHang" value="{{ old('TenKhachHang') }}" id="inputAddress" placeholder="Đại lý Tâm Lực,...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="inputAddress">Số điện thoại</label>
                        <input type="text" class="form-control" name="SoDienThoai" value="{{ old('SoDienThoai') }}" id="inputAddress" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="inputAddress">Địa chỉ</label>
                        <input type="text" class="form-control" name="DiaChi" value="{{ old('DiaChi') }}" id="inputAddress" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection