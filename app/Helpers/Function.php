<?php
/**
 * 返回成功数据
 * @param string  $msg
 * @param array   $data
 * @param integer $code
 * @return array
 */
function succBack($msg='success',$data=[],$code=1000){
    return backData(1, $msg, $data, $code);
}
/**
 * 返回失败数据
 * @param string  $msg
 * @param array   $data
 * @param integer $code
 * @return array
 */
function errBack($msg='error',$data=[],$code=4000){
    return backData(0, $msg, $data, $code);
}
/**
 * 数据返回
 * @param integer $status
 * @param string  $msg
 * @param array   $data
 * @param integer $code
 * @return array
 */
function backData($status,$msg,$data,$code){
    return [
        'status' => $status,
        'msg' => $msg,
        'data' => $data,
        'code' => $code
    ];
}
/**
 * 驼峰转下划线/下划线转驼峰
 * @param unknown $str
 * @param string $flag
 * @return mixed
 */
function convstr($str,$flag=true,$separator='_'){
    if ($flag){
        return strtolower(preg_replace('/((?<=[a-z])(?=[A-Z]))/', '_',$str));
    }else{
        $str = str_replace($separator, " ", strtolower($str));
        return str_replace(" ", "", ucwords($str));
    }
}