@extends('admin.master')

@section('content')
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h3 class="m-0">Sửa hàng hóa</h3>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <div class="card-body">
                    <form action="{{ route('admin._hang_hoa.update', ['id' => $hangHoa->MaHang]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="row mb-3 col-lg-11">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="form-label" for="inputAddress">Loại hàng hóa</label>
                                        <select class="form-select" name="MaLoaiHangHoa" id="inputGroupSelect01">
                                            <option selected="">Chọn loại hàng nè</option>
                                            @foreach ($loaiHangHoa as $lhh)
                                                <option
                                                    {{ old('MaLoaiHangHoa', $hangHoa->MaLoaiHangHoa) == $lhh->MaLoaiHangHoa ? 'selected' : '' }}
                                                    value="{{ old('MaLoaiHangHoa', $lhh->MaLoaiHangHoa) }}">
                                                    {{ $lhh->LoaiHangHoa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label" for="inputAddress">Đổi ảnh mới</label>
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" name="image">
                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="form-label" for="inputAddress">Tên hàng hóa</label>
                                        <input type="text" class="form-control" name="TenHangHoa"
                                            value="{{ old('TenHangHoa', $hangHoa->TenHangHoa) }}" id="inputAddress">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label" for="inputAddress">Đơn giá</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="DonGia"
                                                value="{{ old('DonGia', $hangHoa->DonGia) }}"
                                                aria-label="Dollar amount (with dot and two decimal places)">
                                            <div class="input-group-text">
                                                <span class="">VND</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <label class="form-label" for="inputAddress">Ảnh cũ</label>
                                <div class="input-group mb-3">
                                    @php
                                        $anhCu = !empty($hangHoa->image) ? $hangHoa->image : 'default.png';
                                    @endphp
                                    <div>
                                        <img src="{{ asset('images/' . $anhCu) }}" width="120px" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="mb-3 col-lg-3">
                                <label class="form-label" for="inputAddress">Số lượng</label>
                                <input type="text" class="form-control" name="SoLuong" id="inputAddress" placeholder="35,..." value="{{ old('SoLuong', $hangHoa->SoLuong) }}">
                            </div>
                            <div class="mb-3 col-lg-3">
                                <label class="form-label" for="inputAddress">Số lượng cảnh báo</label>
                                <input type="text" class="form-control" name="SoLuongCanhBao" id="inputAddress" placeholder="35,..." value="{{ old('SoLuongCanhBao', $hangHoa->SoLuongCanhBao) }}">
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="inputAddress">Đơn vị tính</label>
                                <input type="text" class="form-control" name="DonViTinh" id="inputAddress"
                                    value="{{ old('DonViTinh', $hangHoa->DonViTinh) }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6 class="card-subtitle mb-2">Công dụng</h6>
                            <textarea class="form-control" maxlength="225" rows="3" name="CongDung" id="maxlength-textarea"
                                value="{{ old('CongDung', $hangHoa->CongDung) }}">{{ old('CongDung', $hangHoa->CongDung) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
