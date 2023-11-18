<?php

namespace App\Http\Controllers\Admin\NhapHang;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\LoaiHangHoaRequest;
use App\Imports\LoaiHangHoaImport;
use App\Imports\UserImport;
use Illuminate\Http\Request;

class LoaiHangHoaController extends BaseController
{
    public function __construct(){
        parent::__construct('_loai_hang_hoa');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['loaiHangHoa'] = $this->db->orderBy('MaLoaiHangHoa')->get();
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
    public function store(LoaiHangHoaRequest $request)
    {
        $data = $request->except('_token');
        $data['created_at'] = new \DateTime();
        $this->db->insert($data);
        return $this->route_admin('index', ['success' => 'Thêm loại hàng hóa thành công']);
    }

    public function import(Request $request){
        $this->validateRequest([
            'import_file' => 'required|file'
        ], $request, [
            'import_file' => 'File import'
        ]);

        $file = $request->file('import_file');

        $import = new LoaiHangHoaImport();
        \Excel::import($import, $file);
        if ($import->errors) {
            session()->put('errors', $import->errors);
            session()->save();
            json_result([
                'status' => 'error',
                'message' => 'Lỗi import',
                'redirect' => route('admin._loai_hang_hoa.index')
            ]);
        } else {
            json_result([
                'status' => 'success',
                'message' => 'Import thành công',
                'redirect' => route('admin._loai_hang_hoa.index')
            ]);
        }
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
        $loaiHangHoa = $this->db->where('MaLoaiHangHoa', $id);
        if($loaiHangHoa->exists()){
            $data['loaiHangHoa'] = $loaiHangHoa->first();
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
    public function update(LoaiHangHoaRequest $request, $id)
    {
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();

        $this->db->where('MaLoaiHangHoa',$id)->update($data);
        return $this->route_admin('index', ['success' => 'Cập nhật loại hàng hóa thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loaiHangHoa = $this->db->where('MaLoaiHangHoa', $id);

        if ($loaiHangHoa->exists()) {
            $loaiHangHoa->delete();
            return $this->route_admin('index', ['success' => 'Xóa loại hàng hóa thành công']);
        } else {
            abort(404);
        }
    }
}
