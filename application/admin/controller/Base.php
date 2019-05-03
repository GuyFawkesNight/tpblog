<?php

namespace app\admin\controller;

use think\Controller;

class base extends Controller
{
    public function  initialize()
    {
       if(!session('?admin.id')){
           return $this->redirect('admin/index/login');
       }
    }
}
