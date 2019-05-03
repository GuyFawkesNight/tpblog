<?php

namespace app\admin\controller;



class Cate extends Base
{
    public  function list(){

        $cates = model("Cate")->order('sort','asc')->paginate(1);
        $viewData = [
            'cates'=>$cates
        ];

        $this->assign($viewData);

        return view();

    }

    public function add(){
        if(request()->isAjax()){
            $data = [
                "catename" => input("post.catename"),
                "sort"=>input("post.cateorder")
            ];

            $result = model("Cate")->add($data);
            if($result != 1) return $this->error($result);

            return $this->success("栏目添加成功","admin/cate/list");
        }

        return view();

    }
}
