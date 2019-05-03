<?php
namespace app\common\validate;

use think\Validate;

/**
 * 管理员验证器
 */
class Admin  extends Validate{

	protected $rule= [
		'username|管理员账户'=>'require',
		'password|密码'=>'require',
		'conpass|确认密码'=>'require|confirm:password',
		'nickname|昵称'=>'require',
		'email|邮箱'=>'require|email',
        'code|验证码'=>'require'
	];

	//登陆验证
	public function sceneLogin(){
		$this->only(['username','password']);
	}

	//注册验证
	public function sceneRegister(){
		$this->only(['username','password','conpass','nickname'])
		->append('username','unique:admin')
            ->append('email','require|email|unique:admin');

	
	}

	//重置密码邮箱验证
    public function sceneForget()
    {
        $this->only(['email']);
    }

    public function sceneReset(){
	    return $this->only(['email','code']);
    }

}