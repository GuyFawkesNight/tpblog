<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Artical extends Model
{


    use SoftDelete;

    protected  $table = "dp_article";
    //添加文章
    public function add($data){
        $validate = new \app\common\validate\Artical();

        if(!$validate->scene("add")->check($data))
            return $validate->getError();

        $result = $this->allowField(true)->save($data);
        if(!$result) return "数据添加失败";

        return 1;
    }

    public function top($data)
    {
        $validate = new \app\common\validate\Artical();

        if(!$validate->scene("top")->check($data))
            return $validate->getError();

        $articalInfo = $this->where("delete_time is null")->find($data["id"]);
        if(!$articalInfo) return "找不到文章记录";

        $articalInfo->atop = $data["atop"];
        $result = $articalInfo->save();
        if(!$result) return "置顶更新失败";

        return 1;
    }
}
