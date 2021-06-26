<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Common\CommonController;

class WebController extends CommonController{
    
    /**
     * 跳转
     * @param unknown $url
     */
    public function redirect($url){
        return redirect(url($url));
    }
    /**
     * view
     * @param string $view
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view($v=false){
        $method = $this->method();
        $v = $v?$v:convstr($method->action);
        $v= convstr(str_ireplace('controller', '', $method->controller)).'/'.$v;
        return view($v);
    }
}