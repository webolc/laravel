<?php
namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Response;

class CommonController extends Controller{
    
    protected $request;
    /**
     * @var int
     */
    protected $httpCode = FoundationResponse::HTTP_OK;
    
    public function __construct(){
        $this->request = request();
        
    }
    /**
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }
    /**
     * @param null $httpCode
     * @return $this
     */
    public function setHttpCode($httpCode = null)
    {
        $this->httpCode = $httpCode;
        return $this;
    }
    
    /**
     * @param $data
     * @param array $header
     * @return mixed
     */
    public function respond($data, $header = [])
    {
        return Response::json($data, $this->getHttpCode(), $header);
    }
    
    /**
     * @param $httpCode
     * @param $statusCode
     * @param array $data
     * @param $status
     * @return mixed
     */
    public function status($httpCode, $statusCode, array $data, $status)
    {
        if ($httpCode) {
            $this->setHttpCode($httpCode);
        }
        $status = [
            'status' => $status,
            'code' => $statusCode
        ];
        
        $data = array_merge($status, $data);
        return $this->respond($data);
        
    }
    
    /**
     * @param $data
     * @param int $httpCode
     * @param int $statusCode
     * @param string $status
     * @return mixed
     */
    public function failed($data, $statusCode = 4000, $httpCode = FoundationResponse::HTTP_BAD_REQUEST, $status = 'error')
    {
        return $this->status($httpCode, $statusCode, ['data' => $data], $status);
    }
    
    /**
     * @param $data
     * @param string $status
     * @param int $httpCode
     * @param int $statusCode
     * @return mixed
     */
    public function success($data, $statusCode = 1000, $httpCode = FoundationResponse::HTTP_OK, $status = "success")
    {
        // 简化分页显示
        if ($data instanceof AnonymousResourceCollection && $data->resource instanceof LengthAwarePaginator) {
            $data = [
                'page' => $data->resource->currentPage(),
                'pages' => $data->resource->lastPage(),
                'total' => $data->resource->total(),
                'list' => $data->collection,
            ];
            return $this->status($httpCode, $statusCode, compact('data'), $status);
        }
        
        return $this->status($httpCode, $statusCode, compact('data'), $status);
    }
    
    /**
     * @param $data
     * @param string $status
     * @param int $httpCode
     * @param int $statusCode
     * @return mixed
     */
    public function message($data, $statusCode = 1000, $httpCode = FoundationResponse::HTTP_OK, $status = "success")
    {
        return $this->status($httpCode, $statusCode, ['data' => $data], $status);
    }
    /**
     * 输出trail返回数据
     * @param array $data
     * @return mixed
     */
    public function toTrait($res){
        if ($res['data']){
            $res['data'] = [
                'msg'  => $res['msg'],
                'data' => $res['data']
            ];
        }else{
            $res['data'] = $res['msg'];
        }
        if ($res['status']){
            return $this->success($res['data'],$res['code']);
        }
        return $this->failed($res['data'],$res['code']);
    }
    /**
     * 获取当前控制器和方法
     * @return object
     */
    public function method(){
        list($class, $method) = explode('@', $this->request->route()->getActionName());
        $class = explode('\\', $class);
        return (object)['controller'=>end($class),'action'=>$method];
    }
    /**
     * 获取当前控制器
     * @return string
     */
    public function controller(){
        return $this->method()->controller;
    }
    /**
     * 获取当前方法
     * @return string
     */
    public function action(){
        return $this->method()->action;
    }
    
}