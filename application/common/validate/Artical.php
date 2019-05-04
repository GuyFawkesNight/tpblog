<?php

namespace app\common\validate;

use think\Validate;

class Artical extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    "id|主键"=>"require",
	    "title|标题" => "require|unique:artical",
        "tags|标签" => "require",
        "atop|置顶"=>"require",
        "cateid|栏目id"=>"require",
        "desc|文章概要"=>"require",
        "content|文章内容"=>"require"
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [];

    public function sceneAdd(){
        $this->only(["title","tags","is_top","cateid","desc","content"]);
    }

    public function sceneTop()
    {
        $this->only(["id","atop"]);
    }

    public function sceneEdit(){
        $this->only(["tags","cateid","desc","content"])
        ->append("title","require");
    }
}
