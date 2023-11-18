@extends('admin.master')

@section('content')
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h3 class="m-0"></h3>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4>Danh sách hóa đơn nhập hàng</h4>
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
                                <a href="{{ route('admin._hoa_don.createNhapHang') }}" class="btn_1">Thêm hóa đơn nhập hàng</a>
                            </div>
                        </div>
                    </div>
                    <div class="QA_table mb_30">
                        <table id="my_table" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">MHĐ</th>
                                    <th scope="col">Tên nhà cung cấp</th>
                                    <th scope="col">Đợt</th>
                                    <th scope="col">Ngày in</th>
                                    <th scope="col">Nợ cũ</th>
                                    <th scope="col">Nợ mới</th>
                                    <th scope="col">Tổng công nợ</th>
                                    {{-- <th scope="col">Sửa</th> --}}
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hoaDon as $hd)
                                    <?php
                                        $NoMoi = 0;
                                    foreach ($hoaDon_HangHoa as $hd_hh) {
                                        if($hd_hh->MaHoaDon == $hd->MaHoaDon){
                                            $GiaChietKhau = ($hd->ChietKhau * $hd_hh->DonGia) / 100;
                                            $DonGiaCK = $hd_hh->DonGia - $GiaChietKhau;
                                            $tong = $hd_hh->SoLuong * $DonGiaCK;
                                            $NoMoi += $tong;
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <th scope="row"> <a href="#"
                                                class="question_content">XH{{ $hd->MaHoaDon }}</a></th>
                                        <td><a href="{{ route('admin._hoa_don.createPDF', ['MaHoaDon' => $hd->MaHoaDon]) }}">{{ $hd->TenKhachHang }}</a></td>
                                        <td>{{ $hd->Vu }}</td>
                                        <td>
                                            {{ date('d/m/Y', strtotime($hd->NgayGiao)) }}
                                        </td>
                                        <td>{{ $hd->LoaiHoaDon == 1 ? number_format($hd->NoCu, 0, '', '.') . ' VNĐ' : "Tiền mặt" }}
                                            </td>
                                        <td>{{ number_format($NoMoi, 0, '', '.') }}
                                            VNĐ</td>
                                        <td>{{ $hd->LoaiHoaDon == 1 ? number_format($hd->NoCu + $NoMoi, 0, '', '.') . ' VNĐ' : "Tiền mặt" }}</td>
                                        </td>
                                        {{-- <td><a href="{{ route('admin._hoa_don.edit', ['id' => $hd->MaHoaDon]) }}">Sửa</a>
                                        </td> --}}
                                        <td><a style='color: red;'
                                                href="{{ route('admin._hoa_don.destroy', ['id' => $hd->MaHoaDon]) }}" onclick="return confirm('Bạn có muốn xóa hóa đơn này?');">Xóa</a>
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
