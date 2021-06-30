<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class WebController extends Controller{
    
    /**
     * 当前版本
     * @var string
     */
    protected $current_version = 'V1';
    
    
    /**
     * 跳转
     * @param unknown $url
     */
    protected function redirect($url){
        return redirect(url($url));
    }
    /**
     * view
     * @param string $view
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    protected function view($v=false){
        $method = $this->method();
        $v = $v?$v:convstr($method->action);
        $v= convstr(str_ireplace('controller', '', $method->controller)).'/'.$v;
        return view($v);
    }
    /**
     * 错误页面
     */
    protected function errorView(){
        
    }
    /**
     * 成功页面
     */
    protected function succView(){
        
    }
    /**
     * 格式化返回RPC返回数据
     * @param array $data
     * @return mixed
     */
    protected function rpcData($res){
        if ($res['code'] == 200){
            return $this->success($res['data']['data'],$res['data']['code']);
        }
        if (!$res['data']){
            $res['data'] = $res['msg'];
        }
        return $this->failed($res['data'],$res['code']);
    }
}