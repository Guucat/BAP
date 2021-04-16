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

/*
Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

return [

];
*/

//api.baptest.cn => baptest.cn/index.php/api
//Route::domain('api','api');
use \think\facade\Route;

Route::group('/rest/v1/', function(){
    Route::domain('api','api');

    Route::get('hello','test/hello');//test
	Route::get('list_something', 'index/index'); //test
	Route::get('test_get', 'test/test_get'); //test
    Route::get('test_select', 'test/test_select'); //test
    Route::get('solve_bug/:time/:token/:antibody_id', 'test/solve_bug'); //test

    Route::post('test_json', 'test/test_json'); //test
    Route::post('solve_bugg','test/solve_bugg'); //debug
    Route::post('test_re','test/test_re'); //test




	//例：注册接口的路由
	Route::post('user/register','user/register');

    //登陆接口的路由
    Route::post('user/login','user/login');

	//例：发送验证码的路由	
	Route::get('code/:time/:token/:username/:is_exist$','code/get_code')
        ->pattern(['time'=>'[0-9]+','token'=>'[0-9]+','username'=>'.*','is_exist'=>'[0-1]{1}']);

    //获取资源的路由
    Route::get('source/:time/:token/:source_id','link/source');

    //获取资源的路由
    Route::get('tool/:time/:token/:tool_id','link/tool');

    //获取微生物物种信息
    Route::get('microbe_info/:time/:token/:microbe_id','microbe/microbe_info');

    //修改微生物物种信息
    Route::post('update_microbe_info', 'microbe/update_microbe_info');

    //获取微生物物种分类信息
    Route::get('classification_info/:time/:token/:microbe_id','classification/classification_info');

    //修改微生物物种分类信息
    Route::post('update_classification_info', 'classification/update_classification_info');

    //获取文献信息
    Route::get('reference_info/:time/:token/:ref_id','reference/reference_info');

    //修改文献信息
    Route::post('update_reference_info','reference/update_reference_info');

    //获取所有微生物下信息
    Route::get('all_microbe_info/:time/:token/:microbe_id','allmicrobe/all_microbe_info');

    //修改所有微生物信息
    Route::post('update_all_microbe_info','allmicrobe/update_all_microbe_info');

    //获取受体信息
    Route::get('receptor_info/:time/:token/:receptor_id','receptor/receptor_info');

    //修改所有微生物信息
    Route::post('update_receptor_info','receptor/update_receptor_info');

    //获取抗原信息
    Route::get('antigen_info/:time/:token/:antigen_id','antigen/antigen_info');

    //修改抗原信息
    Route::post('update_antigen_info','antigen/update_antigen_info');

    //获取抗体信息
    Route::get('antibody_info/:time/:token/:antibody_id','antibody/antibody_info');

    //修改抗体信息
    Route::post('update_antibody_info','antibody/update_antibody_info');

    //获取疫苗信息
    Route::get('vaccine_info/:time/:token/:vaccine_id','vaccine/vaccine_info');

    //修改疫苗信息
    Route::post('update_vaccine_info','vaccine/update_vaccine_info');

    //获取临床检测信息
    Route::get('clinical_testing_info/:time/:token/:testing_id','clinicaltesting/clinical_testing_info');

    //修改临床检测信息
    Route::post('update_clinical_testing_info','clinicaltesting/update_clinical_testing_info');


});


//Route::miss('index/return_404');
