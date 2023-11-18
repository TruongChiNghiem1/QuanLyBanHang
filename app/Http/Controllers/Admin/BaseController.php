<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    protected $website = 'admin';
    protected $view = null;
    protected $folder = null;
    protected $folderParent = null;
    public $db;

    public function __construct($folder){
        $this->view = $this->website . ".modules." . $folder;
        $this->folderParent = $this->website . "." . $folder;
        $this->db = DB::table($folder);
    }

    public function view_admin (string $page, array $data = []){
        return view($this->view . "." . $page, $data);
    }

    public function route_admin(string $page, array $flash = []){
        if (empty($flash)){
            return redirect()->route($this->folderParent . "." . $page);
        } else {
            return redirect()->route($this->folderParent . "." . $page)->with($flash);
        }
    }

    public function validateRequest($rules, Request $request, $attributeNames = null)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($attributeNames) {
            $validator->setAttributeNames($attributeNames);
        }

        if ($validator->fails()) {
            json_message($validator->errors()->all()[0], 'error');
        }
    }
}
