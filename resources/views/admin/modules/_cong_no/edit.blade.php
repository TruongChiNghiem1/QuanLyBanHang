@extends('admin.master')

@section('content')
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h3 class="m-0">Sửa công nợ</h3>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <div class="card-body">
                    <form action="{{ route('admin._cong_no.update', ['id' => $congNo->MaCongNo]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label class="form-label" for="inputAddress">Chọn khách hàng</label>
                                <select class="form-select" name="MaKH" id="inputGroupSelect01">
                                    @foreach ($khachHang as $kh)
                                        <option {{ old('MaKH',$congNo->MaKH) == $kh->MaKH ? 'selected' : '' }} value="{{ old('MaKH',$kh->MaKH) }}">{{ $kh->TenKhachHang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Vụ</label>
                            <input type="text" class="form-control" name="Vu" id="inputAddress"
                                placeholder="1,2,3,4,..." value="{{ old('Vu', $congNo->Vu) }}">
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" for="inputAddress">Số tiền</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money" name="SoTien"
                                        aria-label="Dollar amount (with dot and two decimal places)" id="checkMoney" value="{{ old('SoTien', $congNo->SoTien) }}">
                                    <div class="input-group-text">
                                        <span class="">VND</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="inputAddress">Đã thanh toán</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control money" name="DaThanhToan"
                                        aria-label="Dollar amount (with dot and two decimal places)" id="checkMoney" value="{{ old('DaThanhToan', $congNo->DaThanhToan) }}">
                                    <div class="input-group-text">
                                        <span class="">VND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="inputAddress">Ngày bắt đầu</label>
                                <input type="date" class="form-control" name="NgayBatDau" id="inputDate" value="{{ old('NgayBatDau', $congNo->NgayBatDau) }}">
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="inputAddress">Ngày kết thúc</label>
                                <input type="date" class="form-control" name="NgayKetThuc" id="inputDate" value="{{ old('NgayKetThuc', $congNo->NgayKetThuc) }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
