<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaseModel extends Model{
    
    use HasFactory;
    
    /**
     * 查询单条数据
     */
    public function _find($where){
        if (is_array($where)){
            return DB::table($this->getTable())->where($where)->first();
        }else{
            return DB::table($this->getTable())->find($where);
        }
    }
    /**
     * 批量插入
     * @param unknown $data
     * @return boolean
     */
    public function _addAll($data){
        return DB::table($this->getTable())->insert($data);
    }
    
    
    
}