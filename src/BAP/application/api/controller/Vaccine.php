<?php


namespace app\api\controller;


use think\Db;
use think\facade\Request;

class Vaccine extends Common
{
    public function vaccine_info(){
        $data = $this->params;
        $vaccine = Db::table('iip_vaccine')
            ->where('vaccine__vaccine_id', $data['vaccine_id'])
            ->select();
        if (!$vaccine) {
            $this->return_msg(400, '查询失败！');
        }else{
            $this->return_msg(200,'查询成功',$vaccine);
        }
    }

    public function update_info(){
        $params = Request::post();
        #$this->check_time($params['time']);
        #$this->check_token($params['token']);
        $data = $params['data'];
        $total = 0;

        $one = $data['0'];
        $key_num = $one['vaccine__vaccine_id'];
        $special_key = ['vaccine__vaccine_id','vaccine__microbe_id','vaccine__ref_id'];
        foreach ($one as $key=>$value){
            if (in_array($key,$special_key)){
                $total = $total + 0;
            }else{
                $res = Db::table('iip_vaccine')
                    ->where('vaccine__vaccine_id', $key_num)
                    ->update([$key => $value]);
                $total = $total + $res; }
        }
        if($total==0){
            $this->return_msg('400','修改失败');
        }else{
            $this->return_msg('200','修改成功');
        }
    }
}