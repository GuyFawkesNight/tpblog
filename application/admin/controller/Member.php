<?php

namespace app\admin\controller;

use think\Controller;

class Member extends Base
{
    //获取会员列表
    public function all(){
        $members = model("Member")->order(['create_time','id'])->paginate(10);
        $dataView = [
            'members' =>$members
        ];

        $this->assign($dataView);
        return view();
    }


    public function add()
    {
        if(request()->isAjax()){
            $data = [
                'username'=>input("post.username"),
                'password'=>input("post.password"),
                'confirm'=>input("post.confirm"),
                'nickname'=>input("post.nickname"),
                'email'=>input("post.email"),
            ];

            $result = model("member")->add($data);
            if($result != 1) return $this->error($result);

            return $this->success("会员添加成功","admin/member/all");
        }
        return view();
    }
}
