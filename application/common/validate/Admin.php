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
	];

	//场景验证
	public function sceneLogin(){
		$this->only(['username','password']);
	}
}