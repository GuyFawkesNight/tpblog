<?php

namespace app\admin\controller;



class Cate extends Base
{
    public  function list(){

        $cates = model("Cate")->order('sort','asc')->paginate(10);
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

    public function sort(){
        $data = [
            "id"=>input("post.id"),
            "sort" =>input("post.sort")
        ];

        $result = model("cate")->sort($data);
        if($result != 1) $this->error($result);

        return $this->success("排序更新成功","admin/cate/list");
    }

    public function edit(){

        if(request()->isAjax()){
            $data = [
                "id" =>input("post.id"),
              "catename"=>input("post.catename"),
              "sort"=>input("post.cateorder")
            ];

            $result = model("cate")->edit($data);
            if($result != 1) return $this->error($result);

            return $this->success("更新成功","admin/cate/list");
        }

        $cateInfo = model("cate")->find(input("id"));
        $this->assign(["cateInfo"=>$cateInfo]);
        return view();
    }

    public function delete(){
        //关联删除
        $cateInfo = model('cate')
            ->with("artical")
            ->find(input('post.id'));

        if(!$cateInfo) return $this->error("找不到记录");

        $result = $cateInfo->together("artical")->delete();
        if(!$result) return $this->error("删除失败");

        return $this->success("删除成功",'admin/cate/list');

    }
}
