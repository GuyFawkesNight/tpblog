<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Member extends Model
{

    protected  $table = "dp_member";

    //通过只读字段，保护字段不允许被修改,但是不会提醒错误
    //protected  $readonly = ['username','email'];

    //软删除
    use SoftDelete;


    public function add($data){

        $validate = new \app\common\validate\Member();
        if(!$validate->scene("add")->check($data))
            return $validate->getError();

        $result = $this->allowField(true)
            ->save($data);
        if(!$result) return "会员添加失败";

        return 1;
    }

    public function  edit($data){
        $validate = new \app\common\validate\Member();

        if(!$validate->scene("edit")->check($data))
            return $validate->geterror();



        $memberinfo = $this->find($data["id"]);
        if(!$memberinfo) return "找不到会员记录";

        if($data["oldpassword"] != $memberinfo->password)
            return "密码验证错误";



        $memberinfo->username = $data["username"];
        $memberinfo->password = $data["newpassword"];
        $memberinfo->nickname = $data["nickname"];
        $memberinfo->email = $data["email"];


        //$result = $memberinfo->allowField(true)->save($data);
        $result = $memberinfo->save();
        if(!$result) return "会员信息更新失败";

        return 1;

    }
}
