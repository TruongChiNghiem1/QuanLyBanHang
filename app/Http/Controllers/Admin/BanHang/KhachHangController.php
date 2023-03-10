<?php

namespace App\Http\Controllers\Admin\BanHang;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\KhachHangRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KhachHangController extends BaseController
{
    public function __construct()
    {
        parent::__construct('_khach_hang');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['khachHang'] = $this->db->where('LoaiKhachHang', 1)->orderBy('MaKH')->get();

        return $this->view_admin('index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view_admin('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KhachHangRequest $request)
    {
        $data = $request->except('_token');
        $data['MaKH'] = Str::uuid();
        $data['LoaiKhachHang'] = 1;
        $data['created_at'] = new \DateTime();
        $this->db->insert($data);

        // $dataCongNo = $request->except('_token', 'TenKhachHang', 'SoDienThoai', 'DiaChi');
        // $dataCongNo['MaKH'] = $data['MaKH'];
        // $dataCongNo['created_at'] = new \DateTime();
        // DB::table('_cong_no')->insert($dataCongNo);

        return $this->route_admin('index', ['success' => 'Thêm khách hàng thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $khachHang = $this->db->where('MaKH', $id);
        if($khachHang->exists()){
            $data['khachHang'] = $khachHang->first();
            return $this->view_admin('edit', $data);
        } else
            abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KhachHangRequest $request, $id)
    {
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();

        $this->db->where('MaKH',$id)->update($data);
        return $this->route_admin('index', ['success' => 'Cập nhật khách hàng thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $khachHang = $this->db->where('MaKH', $id);

        if ($khachHang->exists()) {
            $khachHang->delete();
            return $this->route_admin('index', ['success' => 'Xóa khách hàng thành công']);
        } else {
            abort(404);
        }
    }
}
