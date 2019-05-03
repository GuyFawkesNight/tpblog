<?php

namespace app\admin\controller;

use think\Controller;

//继承自自定义控制器Base,校验身份是否登陆

class Home extends Base
{
    //
    public function index(){
        return view();
    }


    public function loginout(){

        session(null);
        if(session('?admin.id'))
            return $this->error("退出失败！");
        return $this->success("退出成功","admin/index/login");
    }
}
