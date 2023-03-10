@extends('admin.master')

@section('content')
<div class="col-lg-12">
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
            <div class="box_header m-0">
                <div class="main-title">
                    <h3 class="m-0">Sửa loại hàng hóa</h3>
                </div>
            </div>
        </div>
        <div class="white_card_body">
            <div class="card-body">
                <form action="{{ route('admin._loai_hang_hoa.update', ['id' => $loaiHangHoa->MaLoaiHangHoa]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="inputAddress">Loại hàng hóa</label>
                        <input type="text" class="form-control" name="LoaiHangHoa" id="inputAddress" value="{{ old('LoaiHangHoa', $loaiHangHoa->LoaiHangHoa) }}">
                    </div>
                    <div class="mb-3">
                        <h6 class="card-subtitle mb-2">Công dụng</h6>
                        <textarea class="form-control" maxlength="225" rows="6" name="CongDung" id="maxlength-textarea">{{ old('CongDung', $loaiHangHoa->CongDung) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection