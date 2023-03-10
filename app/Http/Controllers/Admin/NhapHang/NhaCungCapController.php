<?php

namespace App\Http\Controllers\Admin\NhapHang;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\NhaCungCapRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NhaCungCapController extends BaseController
{
    public function __construct(){
        parent::__construct('_nha_cung_cap');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['nhaCungCap'] = DB::table('_khach_hang')->where('LoaiKhachHang', 2)->orderBy('MaKH')->get(); 
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
    public function store(NhaCungCapRequest $request)
    {
        $data = $request->except('_token');
        $data['MaKH'] = Str::uuid();
        $data['LoaiKhachHang'] = 2;
        $data['created_at'] = new \DateTime();
        DB::table('_khach_hang')->insert($data);
        return $this->route_admin('index', ['success' => 'Thêm nhà cung cấp thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nhaCungCap = DB::table('_khach_hang')->where('MaKH', $id);
        if($nhaCungCap->exists()){
            $data['nhaCungCap'] = $nhaCungCap->first();
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
    public function update(NhaCungCapRequest $request, $id)
    {
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();

        DB::table('_khach_hang')->where('MaKH',$id)->update($data);
        return $this->route_admin('index', ['success' => 'Cập nhật nhà cung cấp thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nhaCungCap = DB::table('_khach_hang')->where('MaKH', $id);

        if ($nhaCungCap->exists()) {
            $nhaCungCap->delete();
            return $this->route_admin('index', ['success' => 'Xóa nhà cung cấp thành công']);
        } else {
            abort(404);
        }
    }
}