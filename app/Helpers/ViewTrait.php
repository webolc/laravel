<?php
namespace App\Helpers;

use App\Helpers\HttpResponse;

trait ViewTrait{
    
    protected $view_path;
    protected $__view_data = [];
    /**
     * 跳转
     * @param unknown $url
     */
    protected function redirect($url){
        return redirect($url);
    }
    /**
     * 传参到模板
     */
    protected function assign($key,$value=''){
        if (is_array($key)){
            $this->__view_data = array_merge($this->__view_data,$key);
        }else{
            $this->__view_data[$key] = $value;
        }
    }
    /**
     * view
     * @param array $data
     * @param string $v
     */
    protected function view($page=false,$data=[]){
        if (!$page){
            $method = $this->method();
            $page = strtolower($this->view_path.convstr(str_ireplace('controller', '', $method->controller)).'/'.convstr($method->action));
        }
        $data = array_merge($this->__view_data,$data);
        return view($page,$data);
    }
    /**
     * 错误页面
     */
    protected function errorView($page=false){
        if (!$page){
            $page= strtolower($this->view_path.'common/error');
        }
        return $this->view($page);
    }
    /**
     * 成功页面
     */
    protected function succView($page=false){
        if (!$page){
            $page= strtolower($this->view_path.'common/success');
        }
        return $this->view($page);
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
            $this->assign('data',$res->data);
            return $this->errorView();
        }
        $this->assign('data',errBack($res->msg,[],$res->code));
        return $this->errorView();
    }
}