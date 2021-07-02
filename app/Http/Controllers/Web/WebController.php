<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Helpers\HttpResponse;

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
        return redirect($url);
    }
    /**
     * view
     * @param array $data
     * @param string $v
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    protected function view($data=[],$page=false){
        if (!$page){
            $method = $this->method();
            $page = strtolower($this->current_version.'/'.convstr(str_ireplace('controller', '', $method->controller)).'/'.convstr($method->action));
        }
        return view($page,$data);
    }
    /**
     * 错误页面
     */
    protected function errorView($data){
        $path = strtolower($this->current_version.'/common/error');
        return $this->view($data,$path);
    }
    /**
     * 成功页面
     */
    protected function succView($data){
        $path = strtolower($this->current_version.'/common/success');
        return $this->view($data,$path);
    }
    /**
     * 格式化返回RPC返回数据
     * @param array $data
     * @return mixed
     */
    protected function getRpcData($res){
        if ($res->code == HttpResponse::HTTP_OK){
            return $res->data;
        }
        if ($res->data){
            return $this->errorView($res->data);
        }
        return $this->errorView(errBack($res->msg,[],$res->code));
    }
}