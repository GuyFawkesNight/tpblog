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

    /**
     * @param $data
     * @return array|int|string
     */
    public function register($data){

        $validate = new \app\common\validate\Admin();
        if(!$validate->scene("register")->check($data)){
            return $validate->getError();
        }

        $result = $this->allowField(true)->save($data);
        if($result){
            return 1;
        }
        else{
            return '注册失败';
        }

    }



    public function forget($data){

        //邮箱验证
        $validate = new \app\common\validate\Admin();

        if(!$validate->scene("forget")->check($data)){
            return $validate->getError();
        }

        //查找用户信息
        $adminInfo = model("Admin")->where(["email"=>$data]);
    }


    //密码重置
    public function reset($data){
        $validate = new \app\common\validate\Admin();

        if(!$validate->scene('reset')->check($data))
            return $validate->getError();

        if(session('code') != $data['code'])
            return "验证码不一致";

        $adminInfo = $this->where(['email'=>$data['email']])
            ->find();

        //随机生成密码
        $password = mt_rand(100000,999999);
        $adminInfo->password = $password;
        $result = $adminInfo->save();

        if(!$result) return "重置密码失败";

        $content = "用户名：".$adminInfo["username"];
        $content .= "新密码:" . $password;
        $mail_result = mailto($data['email'],"密码重置成功",$content);
        if(!$mail_result) return "邮件发送失败";

        return 1;
    }


}
