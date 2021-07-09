<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Helpers\ViewTrait;

class WebController extends Controller{
    
    use ViewTrait;
    protected function __init(){
        $this->current_version = 'V1';
        $this->view_path = 'web/'.$this->current_version.'/';
        
        $public_path = config('view.public_path');
        $this->assign('public_path', $public_path);
    }
}