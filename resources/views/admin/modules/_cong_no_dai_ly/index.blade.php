@extends('admin.master')

@section('content')
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
                        <h4>Công nợ đại lý</h4>
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
                                <a href="{{ route('admin._cong_no_dai_ly.create') }}" class="btn_1">Thêm công nợ</a>
                            </div>
                        </div>
                    </div>
                    <div class="QA_table mb_30">
                        <table id="my_table" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Mã</th>
                                    <th scope="col">Tên khách hàng</th>
                                    <th scope="col">Đợt</th>
                                    <th scope="col">Công nợ</th>
                                    <th scope="col">Đã thanh toán</th>
                                    <th scope="col">Tổng công nợ</th>
                                    <th scope="col">Ngày bắt đầu</th>
                                    <th scope="col">Ngày kết thúc</th>
                                    <th scope="col">Sửa</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                    $sumTongCongNo = 0;
                                    $sumDaThanhToan = 0;
                                    $sumCongNo = 0;
                                @endphp
                                @foreach ($congNo as $cn)
                                    <tr>
                                        <th scope="row"> <a href="#"
                                                class="question_content">{{ $cn->MaCongNo }}</a></th>
                                        <td><a
                                                href="{{ route('admin._cong_no_dai_ly.show', ['id' => $cn->MaKH]) }}">{{ $cn->TenKhachHang }}</a>
                                        </td>
                                        <td>{{ $cn->Vu }}</td>
                                        <td>{{ number_format($cn->SoTien, 0, '', '.'), $sumTongCongNo += $cn->SoTien }}
                                            VNĐ</td>
                                        <td>{{ number_format($cn->DaThanhToan, 0, '', '.'), $sumDaThanhToan += $cn->DaThanhToan }}
                                            VNĐ</td>
                                        <td>{{ number_format($cn->SoTien - $cn->DaThanhToan, 0, '', '.'), $sumCongNo += $cn->SoTien - $cn->DaThanhToan }}
                                            VNĐ</td>
                                        <td>{{ date('d/m/Y', strtotime($cn->NgayBatDau)) }}</td>
                                        <td>{{ $cn->NgayKetThuc == NULL ? 'Đang nuôi' : date('d/m/Y', strtotime($cn->NgayKetThuc)) }}</td>
                                        <td><a href="{{ route('admin._cong_no_dai_ly.edit', ['id' => $cn->MaCongNo]) }}">Sửa</a>
                                        </td>
                                        <td><a style='color: red;'
                                                href="{{ route('admin._cong_no_dai_ly.destroy', ['id' => $cn->MaCongNo]) }}" onclick="return confirm('Bạn có muốn xóa công nợ này?');">Xóa</a>
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tr>
                                <td><hr/></td>
                                <td><hr/></td>
                                <th>Tổng {{ $i }} vụ</th>
                                <td>{{ number_format($sumTongCongNo, 0, '', '.') }} VNĐ</td>
                                <td>{{ number_format($sumDaThanhToan, 0, '', '.') }} VNĐ</td>
                                <td>{{ number_format($sumCongNo, 0, '', '.') }} VNĐ</td>
                                <td><hr/></td>
                                <td><hr/></td>
                                <td><hr/></td>
                                <td><hr/></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12"></div>
@endsection
