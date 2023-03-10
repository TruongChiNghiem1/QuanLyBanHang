@extends('admin.master')

@section('content')
    <div class="col-lg-12 ui-sortable-handle" draggable="false" style="">
        <div class="card_box box_shadow position-relative mb_30     ">
            <div class="white_box_tittle     ">
                <div class="main-title2 ">
                    <h4 class="mb-2 nowrap ">Tên khách hàng: {{ $khachHang->TenKhachHang }}</h4>
                </div>
            </div>
            <div class="box_body">
                <h5 class="mb-2 nowrap ">Số điện thoại: {{ $khachHang->SoDienThoai }}</h5>
                <h5 class="mb-2 nowrap ">Địa chỉ: {{ $khachHang->DiaChi }}</h5>
                <h5 class="mb-2 nowrap ">Mã: {{ $khachHang->MaKH }}</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h3 class="m-0">Data table</h3>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4>Danh sách hóa đơn vụ {{ $Vu }}</h4>
                    </div>
                    <div class="QA_table mb_30">
                        <table id="my_table" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">MHĐ</th>
                                    <th scope="col">Vụ</th>
                                    <th scope="col">Ngày in</th>
                                    <th scope="col">Nợ cũ</th>
                                    <th scope="col">Nợ mới</th>
                                    <th scope="col">Tổng công nợ</th>
                                    <th scope="col">Sửa</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hoaDon as $hd)
                                    <?php
                                    $NoMoi = 0;
                                    foreach ($hoaDon_HangHoa as $hd_hh) {
                                        if ($hd_hh->MaHoaDon == $hd->MaHoaDon) {
                                            $GiaChietKhau = ($hd->ChietKhau * $hd_hh->DonGia) / 100;
                                            $DonGiaCK = $hd_hh->DonGia - $GiaChietKhau;
                                            $tong = $hd_hh->SoLuong * $DonGiaCK;
                                            $NoMoi += $tong;
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <th scope="row"> <a href="{{ route('admin._hoa_don.createPDF', ['MaHoaDon' => $hd->MaHoaDon]) }}"
                                                class="question_content">XH{{ $hd->MaHoaDon }}</a></th>
                                        <td>{{ $hd->Vu }}</td>
                                        <td>
                                            {{ date('d/m/Y', strtotime($hd->NgayGiao)) }}
                                        </td>
                                        <td>{{ ($hd->LoaiHoaDon == 1 || $hd->LoaiHoaDon == 3) ? number_format($hd->NoCu, 0, '', '.') . ' VNĐ' : 'Tiền mặt' }}
                                        </td>
                                        <td>{{ number_format($NoMoi, 0, '', '.') }}
                                            VNĐ</td>
                                        <td>{{ ($hd->LoaiHoaDon == 1 || $hd->LoaiHoaDon == 3) ? number_format($hd->NoCu + $NoMoi, 0, '', '.') . ' VNĐ' : 'Tiền mặt' }}
                                        </td>
                                        </td>
                                        <td><a href="{{ route('admin._hoa_don.edit', ['id' => $hd->MaHoaDon]) }}">Sửa</a>
                                        </td>
                                        <td><a style='color: red;'
                                                href="{{ route('admin._hoa_don.destroy', ['id' => $hd->MaHoaDon]) }}">Xóa</a>
                                        </td>
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
