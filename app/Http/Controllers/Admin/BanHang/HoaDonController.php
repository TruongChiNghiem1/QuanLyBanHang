<?php

namespace App\Http\Controllers\Admin\BanHang;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\HoaDonRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class HoaDonController extends BaseController
{
    public function __construct()
    {
        parent::__construct('_hoa_don');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['hoaDon'] = DB::table('_hoa_don')
            // ->where('_hoa_don.MaHoaDon', '=', $MaHoaDon)
            ->select('_hoa_don.*', '_khach_hang.*', '_hoa_don.created_at as hd_created_at', '_khach_hang.created_at as kh_created_at')
            ->where('LoaiHoaDon', '=', 1)
            ->orWhere('LoaiHoaDon', '=', 2)
            ->join('_khach_hang', '_khach_hang.MaKH', '=', '_hoa_don.MaKH')
            ->orderByDesc('_hoa_don.created_at')
            ->get();
        $data['hoaDon_HangHoa'] = DB::table('hoadon_hanghoa')
            // ->where('hoadon_hanghoa.MaHoaDon', '=', $MaHoaDon)
            ->select('hoadon_hanghoa.SoLuong', 'hoadon_hanghoa.GiaBan', 'hoadon_hanghoa.MaHoaDon', '_hang_hoa.TenHangHoa', '_loai_hang_hoa.LoaiHangHoa', '_hang_hoa.DonViTinh', '_hang_hoa.DonGia')
            ->join('_hang_hoa', 'hoadon_hanghoa.MaHang', '=', '_hang_hoa.MaHang')
            ->join('_loai_hang_hoa', '_loai_hang_hoa.MaLoaiHangHoa', '=', '_hang_hoa.MaLoaiHangHoa')
            ->get();
        return $this->view_admin('index', $data);
    }

    public function indexNhapHang()
    {
        $data['hoaDon'] = DB::table('_hoa_don')
            // ->where('_hoa_don.MaHoaDon', '=', $MaHoaDon)
            ->where('LoaiHoaDon', '=', 3)
            ->orWhere('LoaiHoaDon', '=', 4)

            ->select('_hoa_don.*', '_khach_hang.*')
            ->join('_khach_hang', '_khach_hang.MaKH', '=', '_hoa_don.MaKH')
            ->get();
        $data['hoaDon_HangHoa'] = DB::table('hoadon_hanghoa')
            // ->where('hoadon_hanghoa.MaHoaDon', '=', $MaHoaDon)
            ->select('hoadon_hanghoa.SoLuong', 'hoadon_hanghoa.MaHoaDon', '_hang_hoa.TenHangHoa', '_loai_hang_hoa.LoaiHangHoa', '_hang_hoa.DonViTinh', '_hang_hoa.DonGia')
            ->join('_hang_hoa', 'hoadon_hanghoa.MaHang', '=', '_hang_hoa.MaHang')
            ->join('_loai_hang_hoa', '_loai_hang_hoa.MaLoaiHangHoa', '=', '_hang_hoa.MaLoaiHangHoa')
            ->get();
        return $this->view_admin('indexNhapHang', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function fetchKhachHang(Request $request)
    {
        if ($request->query) {
            $query = $request->get('query');
            $data = DB::table('_khach_hang')
                ->where('LoaiKhachHang', '=', $request->HoaDon)
                ->where('TenKhachHang', 'like', "%{$query}%")
                ->get();
            return $data;
        }
    }

    public function fetchKhachHangNhap(Request $request)
    {
        if ($request->query) {
            $query = $request->get('query');
            // dd($query);
            $data = DB::table('_khach_hang')
                ->where('LoaiKhachHang', '=', 2)
                ->where('TenKhachHang', 'like', "%{$query}%")
                ->get();
            return $data;
        }
    }

    public function fetchChonKhachHang(Request $request)
    {
        $id = $request->id;
        if ((DB::table('_cong_no')->where('MaKH', '=', $id)->first()) == NULL) {
            $data = DB::table('_khach_hang')->where('MaKH', '=', $id)->first();
        } else {
            $data = DB::table('_khach_hang')
                ->select('_khach_hang.*', '_cong_no.*')
                ->join('_cong_no', '_cong_no.MaKH', '=', '_khach_hang.MaKH')
                ->where('_khach_hang.MaKH', '=', $id)
                ->orderByDesc('Vu')
                ->first();
        }
        return $data;
    }

    public function fetchHangHoa(Request $request)
    {
        if ($request->query) {
            $query = $request->get('query');
            // dd($query);
            $data = DB::table('_hang_hoa')
                ->where('TenHangHoa', 'like', "%{$query}%")
                ->get();
            // $khachHang = array();
            // $output = '';
            // foreach ($data as $row) {
            //     $output .= '<option id="'. $row->MaHang. '" class="dropdown-item searchHangHoa" value="'. $row->MaHang. '">' . $row->TenHangHoa. '</option>';
            //     // $khachHang[] = ['output' => $output];
            // }

            return $data;
        }
    }

    public function fetchFullHangHoa()
    {
        $data = DB::table('_hang_hoa')->orderBy('TenHangHoa')->get();
        return $data;
    }

    public function fetchHangHoaHien()
    {
        $getPrice = $_GET['id'];
        $price  = DB::table('_hang_hoa')->where('MaHang', $getPrice)->get();
        // dd($price);
        return $price;
    }

    public function fetchHangHoaTable(Request $request)
    {
        $MaHang = $request->MaHang;
        $HangHoa = DB::table('_hang_hoa')
            ->where('MaHang', $MaHang)
            ->select('_hang_hoa.*', '_loai_hang_hoa.LoaiHangHoa')
            ->join('_loai_hang_hoa', '_loai_hang_hoa.MaLoaiHangHoa', '=', '_hang_hoa.MaLoaiHangHoa')
            ->first();
        return $HangHoa;
    }

    public function createPDF($MaHoaDon)
    {
        // $data = DB::table('_khach_hang')
        //     ->select('_khach_hang.*', '_cong_no.*')
        //     ->join('_cong_no', '_cong_no.MaKH', '=', '_khach_hang.MaKH')
        //     ->where('_khach_hang.MaKH', '=', $id)
        //     ->orderByDesc('Vu')
        //     ->first();
        $dataHoaDon = DB::table('_hoa_don')
            ->where('_hoa_don.MaHoaDon', '=', $MaHoaDon)
            ->select('_hoa_don.*', '_khach_hang.*')
            ->join('_khach_hang', '_khach_hang.MaKH', '=', '_hoa_don.MaKH')
            ->first();
        $dataHoaDon_HangHoa = DB::table('hoadon_hanghoa')
            ->where('hoadon_hanghoa.MaHoaDon', '=', $MaHoaDon)
            ->select('hoadon_hanghoa.SoLuong', 'hoadon_hanghoa.GiaBan', '_hang_hoa.TenHangHoa', '_loai_hang_hoa.LoaiHangHoa', '_hang_hoa.DonViTinh', '_hang_hoa.DonGia')
            ->join('_hang_hoa', 'hoadon_hanghoa.MaHang', '=', '_hang_hoa.MaHang')
            ->join('_loai_hang_hoa', '_loai_hang_hoa.MaLoaiHangHoa', '=', '_hang_hoa.MaLoaiHangHoa')
            ->get();
        // dd($dataHoaDon_HangHoa);
        $dataPdf['TenKhachHang'] = $dataHoaDon->TenKhachHang;
        $dataPdf['GhiChu'] = $dataHoaDon->GhiChu;
        $dataPdf['ChietKhau'] = $dataHoaDon->ChietKhau;
        $dataPdf['SoDienThoai'] = $dataHoaDon->SoDienThoai;
        $dataPdf['DiaChi'] = $dataHoaDon->DiaChi;
        $dataPdf['NoCu'] = $dataHoaDon->NoCu;
        $dataPdf['MaHoaDonCu'] = $MaHoaDonCu;
        $dataPdf['MaHoaDon'] = $MaHoaDon;
        $dataPdf['LoaiHoaDon'] = $dataHoaDon->LoaiHoaDon;
        $ngayHomNay = new \DateTime();
        $dataPdf['NgayIn'] = $ngayHomNay->format('d/m/Y');
        $dataPdf['HangHoa'] = $dataHoaDon_HangHoa;

        if ($dataPdf['LoaiHoaDon'] == 1 || $dataPdf['LoaiHoaDon'] == 2) {
            $pdf = Pdf::loadView('admin.modules._hoa_don.pdf_view', $dataPdf)
                ->setPaper('a4', 'potrait')
                ->setWarnings(false);
        } else {
            $pdf = Pdf::loadView('admin.modules._hoa_don.pdf_view_nhaphang', $dataPdf)
                ->setPaper('a4', 'potrait')
                ->setWarnings(false);
        }
        return $pdf->stream();
    }

    public function create()
    {
        $data['khachHang'] = DB::table('_khach_hang')->where('LoaiKhachHang', 1)->orderBy('TenKhachHang')->get();
        $data['hangHoa'] = DB::table('_hang_hoa')->orderBy('TenHangHoa')->get();

        return $this->view_admin('create', $data);
    }

    public function createNhapHang()
    {
        $data['khachHang'] = DB::table('_khach_hang')->where('LoaiKhachHang', 2)->orderBy('TenKhachHang')->get();
        $data['hangHoa'] = DB::table('_hang_hoa')->orderBy('TenHangHoa')->get();
        return view('admin.modules._nhap_hang.create', $data);
    }

    public function storeNhapHang(HoaDonRequest $request)
    {
        //Lưu công nợ và in
        //nếu là khách sỉ thì lưu công nợ mới nhất
        if (!empty($request->khachHang)) {
            $MaKH = $request->khachHang;
            $data['MaKH'] = $MaKH;
            //nếu là khách lẻ thì thêm vào khách hàng loại 3 và lưu công nợ
        }
        if ($request->action == "ThemVaIn") {
            //Lưu công nợ
            $update = $request->except('_token', 'khachHang', 'TenKhachHang', 'SoDienThoai', 'DiaChi', 'HangHoa', 'idHangHoa', 'SoLuong', 'hangHoaThem', 'soLuongHangHoaThem', 'ChietKhau', 'NoCu', 'NoMoi', 'GhiChu', 'action');
            $dataKhachHang = DB::table('_cong_no')->where('MaKH', $MaKH)->first();
            $update['updated_at'] = new \DateTime();
            // nếu khách chưa có công nợ thì tự tạo công nợ mới ghi là đợt 1
            if ($dataKhachHang == NULL) {
                $update['MaKH'] = $MaKH;
                $update['SoTien'] = $request->NoMoi;
                $update['Vu'] = 1;
                $data['Vu'] = 1;
                $update['created_at'] = new \DateTime();
                $update['NgayBatDau'] = new \DateTime();
                DB::table('_cong_no')->insert($update);
                //nếu đã có công nợ rồi thì thêm vào công nợ đợt mới nhất
            } else {
                $update['SoTien'] = $request->NoCu + $request->NoMoi;
                $congNo = DB::table('_cong_no')->where('MaKH', $MaKH)->orderByDesc('Vu')->limit(1)->first();
                $congNoUpdate = DB::table('_cong_no')->where('MaKH', $MaKH)->orderByDesc('Vu')->limit(1);
                $data['Vu'] = $congNo->Vu;
                $congNoUpdate->update($update);
            }
            $data['LoaiHoaDon'] = 3;
        } else {
            $congNo = DB::table('_cong_no')->where('MaKH', $MaKH)->orderByDesc('Vu')->limit(1)->first();
            if ($congNo != NULL) {
                $data['Vu'] = $congNo->Vu;
            }
            $data['LoaiHoaDon'] = 4;
        }

        $data['NgayGiao'] = new \DateTime();
        $data['ChietKhau'] = $request->ChietKhau;
        $data['NoCu'] = $request->NoCu;
        $data['GhiChu'] = $request->GhiChu;
        $data['created_at'] = new \DateTime();

        $hoaDon = $this->db->insertGetId($data);
        $ngayHomNay = new \DateTime();
        $i = 0;
        foreach ($request->hangHoaThem as $MaHangHoa) {
            $soLuongCu = DB::table('_hang_hoa')->where('MaHang', $MaHangHoa)->first();
            $updateHangHoa['SoLuong'] = $soLuongCu->SoLuong + $request->soLuongHangHoaThem[$i];
            DB::table('_hang_hoa')->where('MaHang', $MaHangHoa)->update($updateHangHoa);
            DB::table('hoadon_hanghoa')->insert([
                'MaHoaDon' => $hoaDon,
                'SoLuong' => $request->soLuongHangHoaThem[$i],
                'MaHang' => $MaHangHoa,
                'GiaBan' => $soLuongCu->DonGia,
                'created_at' => $ngayHomNay
            ]);
            $i++;
        }

        return response()->json([
            'title' => 'Thành công',
            'message' => 'Hóa đơn đã được lưu.',
            'icon' => 'success',
            'confirmButtonText' => 'OK',
            'maHoaDon' => $hoaDon
        ]);
//        return $this->createPDF($hoaDon);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HoaDonRequest $request)
    {
        //Lưu công nợ và in
        //nếu là khách sỉ thì lưu công nợ mới nhất
        if ($request->action == "ThemVaIn") {
            if (!empty($request->khachHang)) {
                $MaKH = $request->khachHang;
                $data['MaKH'] = $MaKH;
                //nếu là khách lẻ thì thêm vào khách hàng loại 3 và lưu công nợ
            } else {
                $update = $request->except('_token', 'khachHang', 'HangHoa', 'idHangHoa', 'SoLuong', 'hangHoaThem', 'soLuongHangHoaThem', 'ChietKhau', 'NoCu', 'TongCong', 'NoMoi', 'GhiChu', 'action');
                $update['MaKH'] = Str::uuid();
                $update['LoaiKhachHang'] = 1;
                $update['created_at'] = new \DateTime();
                // $update['TenKhachHang'] = $request->TenKhachHang;
                $data['MaKH'] = $update['MaKH'];
                DB::table('_khach_hang')->insert($update);
                $MaKH = $update['MaKH'];
            }
            //Lưu công nợ
            $update = $request->except('_token', 'khachHang', 'TenKhachHang', 'SoDienThoai', 'DiaChi', 'HangHoa', 'idHangHoa', 'SoLuong', 'hangHoaThem', 'soLuongHangHoaThem', 'ChietKhau', 'NoCu', 'NoMoi', 'GhiChu', 'action');
            $dataKhachHang = DB::table('_cong_no')->where('MaKH', $MaKH)->first();
            $update['updated_at'] = new \DateTime();
            // nếu khách chưa có công nợ thì tự tạo công nợ mới ghi là vụ 1
            if ($dataKhachHang == NULL) {
                $update['MaKH'] = $MaKH;
                $update['SoTien'] = $request->NoMoi;
                $update['Vu'] = 1;
                $data['Vu'] = 1;
                $update['created_at'] = new \DateTime();
                $update['NgayBatDau'] = new \DateTime();
                DB::table('_cong_no')->insert($update);
                //nếu đã có công nợ rồi thì thêm vào công nợ vụ mới nhất
            } else {
                $update['SoTien'] = $request->NoCu + $request->NoMoi;
                $congNo = DB::table('_cong_no')->where('MaKH', $MaKH)->orderByDesc('Vu')->limit(1)->first();
                $congNoUpdate = DB::table('_cong_no')->where('MaKH', $MaKH)->orderByDesc('Vu')->limit(1);
                $data['Vu'] = $congNo->Vu;
                $congNoUpdate->update($update);
            }
            $data['LoaiHoaDon'] = 1;



            //Tiền mặt
        } else {
            if (!empty($request->khachHang)) {
                $MaKH = $request->khachHang;
                $data['MaKH'] = $MaKH;
                //nếu là khách lẻ thì thêm vào khách hàng loại 3 và lưu công nợ
            } else {
                $update = $request->except('_token', 'khachHang', 'HangHoa', 'idHangHoa', 'SoLuong', 'hangHoaThem', 'soLuongHangHoaThem', 'ChietKhau', 'NoCu', 'TongCong', 'NoMoi', 'GhiChu', 'action');
                $update['MaKH'] = Str::uuid();
                $update['LoaiKhachHang'] = 3;
                $update['created_at'] = new \DateTime();
                // $update['TenKhachHang'] = $request->TenKhachHang;
                $data['MaKH'] = $update['MaKH'];
                $data['Vu'] = 0;
                DB::table('_khach_hang')->insert($update);
                $MaKH = $update['MaKH'];
            }
            
            $congNo = DB::table('_cong_no')->where('MaKH', $MaKH)->orderByDesc('Vu')->limit(1)->first();
            if ($congNo != NULL) {
                $data['Vu'] = $congNo->Vu;
            }
            $data['LoaiHoaDon'] = 2;
        }

        $data['NgayGiao'] = new \DateTime();
        $data['ChietKhau'] = $request->ChietKhau;
        $data['NoCu'] = $request->NoCu;
        $data['GhiChu'] = $request->GhiChu;
        $data['created_at'] = new \DateTime();

        $hoaDon = $this->db->insertGetId($data);
        $ngayHomNay = new \DateTime();
        $i = 0;
        foreach ($request->hangHoaThem as $MaHangHoa) {
            $soLuongCu = DB::table('_hang_hoa')->where('MaHang', $MaHangHoa)->first();
            $updateHangHoa['SoLuong'] = $soLuongCu->SoLuong - $request->soLuongHangHoaThem[$i];
            DB::table('_hang_hoa')->where('MaHang', $MaHangHoa)->update($updateHangHoa);
            DB::table('hoadon_hanghoa')->insert([
                'MaHoaDon' => $hoaDon,
                'SoLuong' => $request->soLuongHangHoaThem[$i],
                'MaHang' => $MaHangHoa,
                'GiaBan' => $soLuongCu->DonGia,
                'created_at' => $ngayHomNay
            ]);
            $i++;
        }

        return response()->json([
            'title' => 'Thành công',
            'message' => 'Hóa đơn đã được lưu.',
            'icon' => 'success',
            'confirmButtonText' => 'OK',
            'maHoaDon' => $hoaDon
        ]);
//        return $this->createPDF($hoaDon);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $vu)
    {
        $data['khachHang'] = DB::table('_khach_hang')->where('MaKH', $id)->first();
        $data['hoaDon'] = DB::table('_hoa_don')
            ->select('_hoa_don.*', '_khach_hang.*')
            ->join('_khach_hang', '_khach_hang.MaKH', '=', '_hoa_don.MaKH')
            ->where('_hoa_don.MaKH', $id)
            ->where('_hoa_don.Vu', $vu)
            ->get();
        $data['hoaDon_HangHoa'] = DB::table('hoadon_hanghoa')
            ->select('hoadon_hanghoa.SoLuong', 'hoadon_hanghoa.MaHoaDon', '_hang_hoa.TenHangHoa', '_loai_hang_hoa.LoaiHangHoa', '_hang_hoa.DonViTinh', '_hang_hoa.DonGia')
            ->join('_hang_hoa', 'hoadon_hanghoa.MaHang', '=', '_hang_hoa.MaHang')
            ->join('_loai_hang_hoa', '_loai_hang_hoa.MaLoaiHangHoa', '=', '_hang_hoa.MaLoaiHangHoa')
            ->get();
        $data['Vu'] = $vu;
        return $this->view_admin('show', $data);
    }

    public function showLichSuDatHang($id)
    {
        $data['khachHang'] = DB::table('_khach_hang')->where('MaKH', $id)->first();
        $data['hoaDon'] = DB::table('_hoa_don')
            ->select('_hoa_don.*', '_khach_hang.*')
            ->join('_khach_hang', '_khach_hang.MaKH', '=', '_hoa_don.MaKH')
            ->where('_hoa_don.MaKH', $id)
            ->get();
        $data['hoaDon_HangHoa'] = DB::table('hoadon_hanghoa')
            ->select('hoadon_hanghoa.SoLuong', 'hoadon_hanghoa.MaHoaDon', '_hang_hoa.TenHangHoa', '_loai_hang_hoa.LoaiHangHoa', '_hang_hoa.DonViTinh', '_hang_hoa.DonGia')
            ->join('_hang_hoa', 'hoadon_hanghoa.MaHang', '=', '_hang_hoa.MaHang')
            ->join('_loai_hang_hoa', '_loai_hang_hoa.MaLoaiHangHoa', '=', '_hang_hoa.MaLoaiHangHoa')
            ->get();
        return $this->view_admin('showLichSuDatHang', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hoaDon = $this->db->where('MaHoaDon', $id);
        if ($hoaDon->exists()) {
            $data['hoaDon'] = $hoaDon->first();
            return $this->view_admin('edit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $hoaDonFind = $this->db->where('MaHoaDon', $id);
        if ($hoaDonFind->exists()) {
            $hoaDon = $this->db->where('MaHoaDon', $id)->first();
            $MaKH = $hoaDon->MaKH;
            $Vu = $hoaDon->Vu;

            $hoaDon_HangHoa = DB::table('hoadon_hanghoa')
                ->where('MaHoaDon', $id)
                ->select('hoadon_hanghoa.SoLuong','hoadon_hanghoa.GiaBan', 'hoadon_hanghoa.MaHoaDon', '_hang_hoa.TenHangHoa', '_hang_hoa.DonViTinh', '_hang_hoa.DonGia')
                ->join('_hang_hoa', 'hoadon_hanghoa.MaHang', '=', '_hang_hoa.MaHang')
                ->get();
            $hoaDon_HangHoaDelete = DB::table('hoadon_hanghoa')->where('MaHoaDon', $id);
            $hoaDonFull = DB::table('_hoa_don')->where('LoaiHoaDon', 1)->where('MaKH', $MaKH)->where('Vu', $Vu)->get();
            $congNo = DB::table('_cong_no')->where('MaKH', $MaKH)->where('Vu', $Vu)->first();
            $congNoMoi = DB::table('_cong_no')->where('MaKH', $MaKH)->where('Vu', $Vu);

            $NoMoi = 0;
            $flag = 0;
            //tổng tiền hóa đơn
            foreach ($hoaDon_HangHoa as $hd_hh) {
                if ($hd_hh->MaHoaDon == $hoaDon->MaHoaDon) {
                    $GiaChietKhau = ($hoaDon->ChietKhau * $hd_hh->GiaBan) / 100;
                    $DonGiaCK = $hd_hh->GiaBan - $GiaChietKhau;
                    $tong = $hd_hh->SoLuong * $DonGiaCK;
                    $NoMoi += $tong;
                }
            }
            //cập nhật nợ cũ
            foreach ($hoaDonFull as $hdf) {
                if ($hdf->MaHoaDon == $id) {
                    $flag = 1;
                }
                if ($flag == 1 && $hdf->MaHoaDon != $id) {
                    // dd($hdf->MaHoaDon);
                    $noCuUpdate['NoCu'] = abs($hdf->NoCu - $NoMoi);
                    $noCuUpdate['updated_at'] = new \DateTime();
                    DB::table('_hoa_don')->where('MaHoaDon', $hdf->MaHoaDon)->update($noCuUpdate);
                }
            }
            // if( $congNo->SoTien == null){
                $congNoUpdate['SoTien'] = abs($congNo->SoTien - $NoMoi);
                $congNoMoi->update($congNoUpdate);
            // }
            $hoaDon_HangHoaDelete->delete();
            $hoaDonFind->delete();

            return $this->route_admin('index', ['success' => 'Xóa hóa đơn thành công']);
        } else {
            abort(404);
        }
    }
}
