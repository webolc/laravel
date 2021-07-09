<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ViewTrait;

class AdminController extends Controller{
    
    use ViewTrait;
    protected function __init(){
        $this->current_version = 'V1';
        $this->view_path = 'admin/'.$this->current_version.'/';
        
        $config = config('view.public');
        $config['web_path'] = $config['web_path'].'admin/';
        $config['current_version'] = $this->current_version;
        $this->assign($config);
    }
}