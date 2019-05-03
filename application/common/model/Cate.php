<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Cate extends Model
{
    use SoftDelete;

    protected  $table = "dp_cate";

    public function add($data){
        $validate = new \app\common\validate\Cate();

        if(!$validate->scene("add")->check($data)){
            return $validate->getError();
        }

        $result = $this->allowField(true)->save($data);
        if(!$result) return "栏目添加失败";

        return 1;

    }
}
