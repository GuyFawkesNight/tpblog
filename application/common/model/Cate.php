<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Cate extends Model
{
    use SoftDelete;

    protected  $table = "dp_cate";


    public function artical(){
        return $this->hasMany("artical","cateid","id");
    }


    public function add($data){
        $validate = new \app\common\validate\Cate();

        if(!$validate->scene("add")->check($data)){
            return $validate->getError();
        }

        $result = $this->allowField(true)->save($data);
        if(!$result) return "栏目添加失败";

        return 1;

    }

    public function sort($data){
        $validate = new \app\common\validate\Cate();

        if(!$validate->scene("sort")->check($data))
            return $validate->getError();

        $cateInfo = model("cate")->where(["id"=>$data["id"]])->find();
        if(!$cateInfo) return "找不到对应记录";

        $cateInfo["sort"] = $data["sort"];
        $result = $cateInfo->save();
        if(!$result) return "更新失败";

        return 1;


    }

    public function edit($data){
        $validate = new \app\common\validate\Cate();

        if(!$validate->scene("edit")->check($data))
            return $validate->getError();

        $cateInfo = model("cate")->find($data["id"]);
        if(!$cateInfo) return "找不到记录";

        $cateInfo->catename = $data["catename"];
        $cateInfo->sort = $data["sort"];
        $result = $cateInfo->save($data);
        if(!$result) return "更新失败";

        return 1;


    }
}
