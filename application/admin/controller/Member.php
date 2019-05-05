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


    public function edit(){

        $memberInfo = model("Member")->find(input("id"));
        if (request()->isAjax()) {
            $data = [
                "id"=>input("post.id"),
                "username"=>input("post.username"),
                "oldpassword"=>input("post.oldpassword"),
                "newpassword"=>input("post.newpassword"),
                "nickname"=>input("post.nickname"),
                "email"=>input("post.email")
            ];



            $result = model("Member")->edit($data);
            if($result != 1) return $this->error($result);

            return $this->success("会员信息更新成功","admin/member/all");
        }

        $viewData = [
            "member"=>$memberInfo
        ];
        $this->assign($viewData);
        return view();
    }

    public function delete(){
        $memberInfo = model("Member")->find(input("post.id"));
        if(!$memberInfo) return $this->error("找不到会员信息");

        $result = $memberInfo->delete();
        if(!$result) return $this->error("会员删除失败");

        return $this->success("会员删除成功","admin/member/all");
    }
}
