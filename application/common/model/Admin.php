<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    //
    use SoftDelete;


    protected $table = "dp_admin";
    //登陆校验
    public function login($data){
        $validate = new \app\common\validate\Admin();
        if(!$validate->scene("login")->check($data)){
            return $validate->getError();
        }

        $result = $this->where($data)->find();

        if($result){
            return 1;
        }
        else{
            return '用户名或密码错误';
        }

    
    }
}
