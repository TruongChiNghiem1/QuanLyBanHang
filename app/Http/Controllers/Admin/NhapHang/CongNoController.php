<?php

namespace App\Http\Controllers\Admin\NhapHang;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\CongNoRequest;
use Illuminate\Support\Facades\DB;

class CongNoController extends BaseController
{
    public function __construct()
    {
        parent::__construct('_cong_no');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['congNo'] = $this->db->orderBy('MaCongNo')
            ->select('_cong_no.*', '_khach_hang.TenKhachHang as TenKhachHang')
            ->join('_khach_hang', '_cong_no.MaKH', '=', '_khach_hang.MaKH')
            ->where('_khach_hang.LoaiKhachHang', '=', 1)
            ->get();
        return $this->view_admin('index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['khachHang'] = DB::table('_khach_hang')->where('LoaiKhachHang', 1)->get();
        return $this->view_admin('create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CongNoRequest $request)
    {
        $dataCongNo = $request->except('_token');
        $dataCongNo['created_at'] = new \DateTime();
        DB::table('_cong_no')->insert($dataCongNo);
        return $this->route_admin('index', ['success' => 'Thêm công nợ thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['khachHang'] = DB::table('_khach_hang')->where('MaKH', $id)->first();
        $congNo = $this->db->where('MaKH', $id);

        if ($congNo->exists()) {
            $data['congNo'] = $congNo->get();
            return $this->view_admin('show', $data);
        } else{
            $data['congNo'] = NULL;
            return $this->view_admin('show', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['khachHang'] = DB::table('_khach_hang')->where('LoaiKhachHang', 1)->get();
        $congNo = $this->db->where('MaCongNo', $id);
        if ($congNo->exists()) {
            $data['congNo'] = $congNo->first();
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
    public function update(CongNoRequest $request, $id)
    {
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();

        $this->db->where('MaCongNo', $id)->update($data);
        return $this->route_admin('index', ['success' => 'Cập nhật công nợ thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $congNo = $this->db->where('MaCongNo', $id);

        if ($congNo->exists()) {
            $congNo->delete();
            return $this->route_admin('index', ['success' => 'Xóa công nợ thành công']);
        } else {
            abort(404);
        }
    }
}
