@extends('admin.master')

@section('content')
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_body">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4>Hàng hóa</h4>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalImport">
                                Import hàng hóa
                            </button>
                            <div class="add_button ms-2">
                                <a href="{{ route('admin._hang_hoa.create') }}" class="btn_1">Thêm hàng hóa</a>
                            </div>
                        </div>
                    </div>
                    <div class="QA_table mb_30">
                        <table id="my_table" class="table ">
                            <thead>
                                <tr>
                                    <th scope="col">Mã</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Loại hàng hóa</th>
                                    <th scope="col">Tên hàng hóa</th>
                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Đơn vị tính</th>
                                    <th scope="col">Công dụng</th>
                                    <th scope="col">Sửa</th>
                                    <th scope="col">Xóa</th>
                                    <th scope="col">Tình trạng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hangHoa as $hh)
                                    <tr>
                                        <th scope="row"> <a href="#"
                                                class="question_content">{{ $hh->MaHang }}</a></th>
                                        @php
                                            $image = !empty($hh->image) ? $hh->image : 'default.png';
                                        @endphp
                                        <td><img src="{{ asset('images/' . $image) }}" width="50px" /></td>
                                        <td>{{ $hh->LoaiHangHoa }}</td>
                                        <td>{{ $hh->TenHangHoa }}</td>
                                        <td>{{ $hh->DonGia }}</td>
                                        <td>{{ $hh->SoLuong }}</td>
                                        <td>{{ $hh->DonViTinh }}</td>
                                        <td>{{ $hh->CongDung }}</td>
                                        <td><a href="{{ route('admin._hang_hoa.edit', ['id' => $hh->MaHang]) }}">Sửa</a>
                                        </td>
                                        <td><a style='color: red;'
                                                href="{{ route('admin._hang_hoa.destroy', ['id' => $hh->MaHang]) }}" onclick="return confirm('Bạn có muốn xóa hàng hóa này?');">Xóa</a>
                                        </td>
                                        <td><a href="#"
                                                class="status_btn
                                                        @if ($hh->SoLuong <= 0) red_btn
                                                        @elseif ($hh->SoLuong <= $hh->SoLuongCanhBao) yellow_btn
                                                        @endif">
                                                @if ($hh->SoLuong <= 0)
                                                    Hết hàng
                                                @elseif ($hh->SoLuong <= $hh->SoLuongCanhBao)
                                                    Sắp hết
                                                @else
                                                    Còn hàng
                                                @endif
                                            </a></td>
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

@section('modal')
    <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin._hang_hoa.import') }}" method="post" enctype="multipart/form-data" class="form-ajax">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-import-certificate"> Import hàng hóa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="import_file" id="import_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
