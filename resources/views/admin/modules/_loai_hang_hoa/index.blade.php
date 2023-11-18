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
                    <h4>Loại hàng hóa</h4>
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
                            Import loại hàng hóa
                        </button>
                        <div class="add_button ms-2">
                            <a href="{{ route('admin._loai_hang_hoa.create') }}" class="btn_1">Thêm Loại hàng hóa</a>
                        </div>
                    </div>
                </div>
                <div class="QA_table mb_30">
                    <table id="my_table" class="table ">
                        <thead>
                            <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Loại hàng</th>
                                <th scope="col">Công dụng</th>
                                <th scope="col">Sửa</th>
                                <th scope="col">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loaiHangHoa as $lhh)
                                <tr>
                                    <th scope="row"> <a href="#" class="question_content">{{$lhh->MaLoaiHangHoa}}</a></th>
                                    <td>{{$lhh->LoaiHangHoa}}</td>
                                    <td>{{$lhh->CongDung}}</td>
                                    <td><a href="{{ route('admin._loai_hang_hoa.edit', ['id' => $lhh->MaLoaiHangHoa]) }}" >Sửa</a></td>
                                    <td><a style='color: red;' href="{{ route('admin._loai_hang_hoa.destroy', ['id' => $lhh->MaLoaiHangHoa]) }}" onclick="return confirm('Để xóa được loại hàng hóa bạn cần phải xóa các hàng hóa có loại hàng hóa này !');">Xóa</a></td>
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
            <form action="{{ route('admin._loai_hang_hoa.import') }}" method="post" enctype="multipart/form-data" class="form-ajax">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-import-certificate"> Import khách hàng</h5>
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