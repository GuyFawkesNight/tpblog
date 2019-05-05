<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::group('admin',function(){
    Route::rule('/','admin/index/login','get|post'); 
    Route::rule('register','admin/index/register','post|get');
    Route::rule('forget','admin/index/forget','get|post');
    Route::rule('reset','admin/index/reset','post');

    Route::rule('index','admin/home/index','get');
    Route::rule('loginout','admin/home/loginout','post');
    Route::rule('catelist','admin/cate/list','get');
    Route::rule('cateadd','admin/cate/add','get|post');
    Route::rule('sort','admin/cate/sort','post');
    Route::rule('cateedit/[:id]','admin/cate/edit','get|post');
    Route::rule('catedel','admin/cate/delete','post');
    Route::rule('articallist','admin/artical/list','get');
    Route::rule('articaladd','admin/artical/add','get|post');
    Route::rule('top','admin/artical/top','post');
    Route::rule('edit/[:id]','admin/artical/edit','get|post');
    Route::rule("articaldel",'admin/artical/delete','post');
    Route::rule("memberList",'admin/member/all','get');
    Route::rule('memberAdd','admin/member/add','get|post');
});