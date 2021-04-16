<?php


namespace app\api\controller;


use think\Db;
use think\facade\Request;

class Clinicaltesting extends Common
{
    public function clinical_testing_info()
    {
        $data = $this->params;
        $class = Db::table('iip_clinical_testing')
            ->where('clinical_testing__clinical_testing_id', $data['testing_id'])
            ->select();
        if (!$class) {
            $this->return_msg(400, '查询失败！');
        }else{
            $this->return_msg(200,'查询成功',$class);
        }
    }

    public function update_clinical_testing_info()
    {
        $params = Request::post();
        #$this->check_time($params['time']);
        #$this->check_token($params['token']);
        $data = $params['data'];
        $total = 0;

        $one = $data['0'];
        $key_num = $one['clinical_testing__clinical_testing_id'];
        $special_key = ['clinical_testing__clinical_testing_id','clinical_testing__microbe_id',
            'vaccine__ref_id','clinical_testing__antigen_id','clinical_testing__antibody_id',
            'clinical_testing__ref_id'];
        foreach ($one as $key=>$value){
            if (in_array($key,$special_key)){
                $total = $total + 0;
            }else{
                $res = Db::table('iip_clinical_testing')
                    ->where('clinical_testing__clinical_testing_id', $key_num)
                    ->update([$key => $value]);
                $total = $total + $res; }
        }
        if($total==0){
            $this->return_msg('400','修改失败');
        }else {
            $this->return_msg('200', '修改成功');
        }
    }
}