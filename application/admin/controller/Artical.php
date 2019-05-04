<?php

namespace app\admin\controller;

use think\Controller;

class Artical extends Base
{

    public function list(){

        $articals = model("artical")
            ->with("cate")
            ->order(["atop","create_time"])
            ->paginate(10);

        $viewData = [
            "articals"=>$articals
        ];
        $this->assign($viewData);
        return view();
    }
    //文章添加
    public function add(){

        if (request()->isAjax()) {

            //Request::only([]);
            $data = [
                "title"=>input("post.title"),
                "tags"=>input("post.tags"),
                "atop"=>input("post.is_top",0),
                "cateid"=>input("post.cateid"),
                "desc"=>input("post.desc"),
                "content"=>input("post.content")
            ];

            $result = model("Artical")->add($data);
            if($result != 1) return $this->error($result);

            return $this->success("文章添加成功","admin/artical/list");
        }

        $cateList = model("cate")->where("delete_time is null")->field("id,catename")->select();
        $viewData = [
            "cateList"=>$cateList
        ];
        $this->assign($viewData);
        return view();
    }

    //文章置顶/取消置顶
    public function top()
    {
        $data = [
            "id" =>input("post.id"),
            "atop"=>input("post.top")==0?1:0
        ];

        $result = model("artical")->top($data);
        if($result != 1) return $this->error($result);

        return $this->success("置顶更新成功","admin/artical/list");
    }

    public function edit(){
        if (request()->isAjax()) {

            $data = [
                "id"=>input("post.id"),
                "title"=>input("post.title"),
                "tags"=>input("post.tags"),
                "atop"=>input("post.is_top",0),
                "cateid"=>input("post.cateid"),
                "desc"=>input("post.desc"),
                "content"=>input("post.content")
            ];

            $result = model("artical")->edit($data);
            if($result != 1) return $this->error($result);

            return $this->success("文章更新成功","admin/artical/list");
        }


        $articalInfo = model("artical")->find(input("id"));
        $cates = model("cate")->select();
        $viewData = [
            "articalInfo"=>$articalInfo,
            "cates"=>$cates
        ];

        $this->assign($viewData);
        return view();
    }
}
