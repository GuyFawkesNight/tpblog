<?php

namespace app\common\validate;

use think\Validate;

class Member extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'username|用户名'=>'require|unique:member',
        'password|密码'=>'require',
        'confirm|确认密码'=>'require|confirm:password',
        'nickname|昵称'=>'require',
        'email|邮箱'=>'require|email|unique:member'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [];


    public function sceneAdd(){
        $this->only(['username','password','confirm','nickname','email']);
    }
}
