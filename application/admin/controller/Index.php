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

    /**
     * 注册
     * @return \think\response\View|void
     */
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

    //忘记密码获取验证码
    public function forget()
    {
        if(request()->isAjax())
        {
            $adminInfo = model("Admin")
                ->where(["email"=>input("post.email")])
                ->find();

            if(!$adminInfo) return $this->error("找不到用户");

            $code = mt_rand(1000,9999);

            session("code",$code);
            $result = mailto($adminInfo["email"],"重置邮箱验证码","验证码为：".$code);

            if(!$result) return $this->error("验证码邮件发送失败");

            return $this->success("验证码邮件发送成功");

        }
        return view();
    }

    //验证码匹配并修改密码
    public function reset(){
      $data = [
          'email' => input('post.email'),
          'code' =>input('post.code')
      ];

      $result = model('Admin')->reset($data);
      if($result != 1) return $this->error("密码重置失败：".$result);


      return $this->success("密码重置成功");

    }

}
