<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Member extends Model
{

    protected  $table = "dp_member";

    //通过只读字段，保护字段不允许被修改
    protected  $readonly = ['username','email'];

    //软删除
    use SoftDelete;


    public function Add($data){

        $validate = new \app\common\validate\Member();
        if(!$validate->scene("add")->check($data))
            return $validate->getError();

        $result = $this->allowField(true)
            ->save($data);
        if(!$result) return "会员添加失败";

        return 1;
    }
}
