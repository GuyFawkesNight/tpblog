<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    /**
     * 后台登陆
     *
     * @return void
     */
    public function login(){
        if(request()->isAjax()){
            $data = [
                'username' => input('post.username'),
                'password' =>input('post.password')
            ];

             // $result = $admin->login($data);
            $result = model('Admin')->login($data);
            if($result==1){
                //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('登陆成功','admin/home/index');
            }else{
                //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error($result);
            }
        }

        // $admin = new app\common\model\Admin();
       
        return view();
    }

    public function register(){
        if(request()->isAjax()){
            $data= [
                "username" => input("post.username"),
                "password" =>input("post.password"),
                "conpass" =>input("post.conpass"),
                "nickname" =>input("post.nickname"),
                "email" =>input("post.email")
            ];

            $result= model('Admin')->register($data);
            if($result == 1){
                 mailto($data["email"],"注册成功","恭喜你注册成功！");
                return $this->success('注册成功','admin/index/login');
            }
            else{
                return $this->error($result);
            }
        }
        return view();
    }
}
