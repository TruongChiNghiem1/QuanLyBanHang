<?php

namespace App\Http\Controllers\Admin\NhapHang;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\UserRequest;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct('users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = $this->db->get();

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
    public function store(UserRequest $request)
    {
        $data = $request->except('_token', 'password_confirmation');
        $data['password'] = bcrypt($request->password);
        $data['created_at'] = new \DateTime();
        if ($request->images != null) {
            $imageName = time() . '-' . $request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('images'), $imageName);
            $data['avatar'] = $imageName;
        }
        $this->db->insert($data);

        return $this->route_admin('index', [], ['success' => 'Thêm thành viên thành công']);
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
        $user = $this->db->where('id', $id);

        if ($user->exists()) {
            $data['user'] = $user->first();
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

    //$2y$10$mPwGYteZ41FlU0yZ11hB5OFu4dGkrLzMHKYYUCHDb.1DuZljHMdmy
    //$2y$10$mPwGYteZ41FlU0yZ11hB5OFu4dGkrLzMHKYYUCHDb.1DuZljHMdmy
    //$2y$10$D2z4B4ICsn6JTO67IflDw.BEgj1Yqp9d1P1mhWONY65AdH/0zBx6C
    public function update(UserRequest $request, $id)
    {
        $user_current = $this->db->where('id', $id)->first();

        $data = $request->except('_token', 'password_confirmation');
        $data['updated_at'] = new \DateTime();

        if (empty($request->password)) {
            $data['password'] = $user_current->password;
        } else {
            $request->validate([
                'password' => 'min:8'
            ], [
                'password.min' => 'Mật khẩu ít nhất 8 ký tự'
            ]);

            $data['password'] = bcrypt($request->password);
        }

        if (empty($request->avatar)) {
            $data['avatar'] = $user_current->avatar;
        } else {
            $image_path = public_path('images') . "/" . $user_current->avatar;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $imageName = time() . '-' . $request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('images'), $imageName);
            $data['avatar'] = $imageName;
        }

        $this->db->where('id', $id)->update($data);

        return $this->route_admin('index', [], ['success' => 'Sửa thành viên thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->db->where('id', $id);

        if ($user->exists()) {
            $user_current = $user->first();

            if (!empty($user_current->avatar)) {
                $image_path = public_path('images') . "/" . $user_current->avatar;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $user->delete();
            return $this->route_admin('index', [], ['success' => 'Xóa thành viên thành công']);
        } else {
            abort(404);
        }
    }
}
