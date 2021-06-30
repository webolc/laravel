<?php
namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Admin\AdminController;

class IndexController extends AdminController{
    
    public function index(){
        return $this->success('Admin');
    }
}