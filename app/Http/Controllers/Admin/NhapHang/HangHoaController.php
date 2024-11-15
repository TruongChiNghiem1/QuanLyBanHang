<?php

namespace App\Http\Controllers\Admin\NhapHang;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\HangHoaRequest;
use App\Imports\HangHoaImport;
use App\Imports\LoaiHangHoaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HangHoaController extends BaseController
{
    public function __construct()
    {
        parent::__construct('_hang_hoa');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['hangHoa'] = $this->db->orderBy('MaHang')
            ->select('_hang_hoa.*', '_loai_hang_hoa.LoaiHangHoa as LoaiHangHoa')
            ->join('_loai_hang_hoa', '_hang_hoa.MaLoaiHangHoa', '=', '_loai_hang_hoa.MaLoaiHangHoa')
            ->get();
        // dd($data);
        return $this->view_admin('index', $data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['loaiHangHoa'] = DB::table('_loai_hang_hoa')->get();
        return $this->view_admin('create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HangHoaRequest $request)
    {
        $data = $request->except('_token');
        $data['created_at'] = new \DateTime();
        if ($request->images != null) {
            $imageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $this->db->insert($data);
        return $this->route_admin('index', ['success' => 'Thêm hàng hóa thành công']);
    }

    public function import(Request $request){
        $this->validateRequest([
            'import_file' => 'required|file'
        ], $request, [
            'import_file' => 'File import'
        ]);

        $file = $request->file('import_file');

        $import = new HangHoaImport();
        \Excel::import($import, $file);
        if ($import->errors) {
            session()->put('errors', $import->errors);
            session()->save();
            json_result([
                'status' => 'error',
                'message' => 'Lỗi import',
                'redirect' => route('admin._hang_hoa.index')
            ]);
        } else {
            json_result([
                'status' => 'success',
                'message' => 'Import thành công',
                'redirect' => route('admin._hang_hoa.index')
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
        $data['loaiHangHoa'] = DB::table('_loai_hang_hoa')->get();
        $hangHoa = $this->db->where('MaHang', $id);
        if ($hangHoa->exists()) {
            $data['hangHoa'] = $hangHoa->first();
            return $this->view_admin('edit', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HangHoaRequest $request, $id)
    {
        $hangHoaCu = $this->db->where('MaHang', $id)->first();

        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();

        if (empty($request->image)) {
            $data['image'] = $hangHoaCu->image;
        } else {
            $image_path = public_path('images') . "/" . $hangHoaCu->image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $imageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $this->db->where('MaHang', $id)->update($data);

        return $this->route_admin('index', ['success' => 'Cập nhật hàng hóa thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hangHoa = $this->db->where('MaHang', $id);

        if ($hangHoa->exists()) {
            $hangHoa_current = $hangHoa->first();

            if (!empty($hangHoa_current->image)) {
                $image_path = public_path('images') . "/" . $hangHoa_current->image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $hangHoa->delete();
            return $this->route_admin('index', ['success' => 'Xóa hàng hóa thành công']);
        } else {
            abort(404);
        }
    }
}
