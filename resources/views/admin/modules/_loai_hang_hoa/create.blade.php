@extends('admin.master')

@section('content')
<div class="col-lg-12">
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
            <div class="box_header m-0">
                <div class="main-title">
                    <h3 class="m-0">Thêm loại hàng hóa</h3>
                </div>
            </div>
        </div>
        <div class="white_card_body">
            <div class="card-body">
                <form action="{{ route('admin._loai_hang_hoa.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="inputAddress">Loại hàng hóa</label>
                        <input type="text" class="form-control" name="LoaiHangHoa" value="{{ old('LoaiHangHoa') }}" placeholder="Thức ăn">
                    </div>
                    <div class="mb-3">
                        <h6 class="card-subtitle mb-2">Công dụng</h6>
                        <textarea class="form-control" maxlength="225" rows="3" name="CongDung" placeholder="Thức ăn cho tôm">{{ old('CongDung') }}</textarea>
                    </div>
                    <button class="btn btn-primary">Thêm loại hàng hóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection