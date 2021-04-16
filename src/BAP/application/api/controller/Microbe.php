<?php


namespace app\api\controller;


use think\Db;
use think\facade\Request;

class Microbe extends Common
{
    public function microbe_info()
    {
        $data = $this->params;
        $micore = Db::table('iip_microbe')
            ->where('microbe__microbe_id', $data['microbe_id'])
            ->select();
        if (!$micore) {
            $this->return_msg(400, '查询失败！');
        }
        $micore_host = Db::table('iip_microbe_host')
            ->where('microbe_host__microbe_id', $data['microbe_id'])
            ->select();
        if (!$micore_host) {
            $this->return_msg(400, '查询失败！');
        }
        $micore_tax = Db::table('iip_microbe_tax')
            ->where('microbe_tax__microbe_id', $data['microbe_id'])
            ->select();
        if (!$micore_tax) {
            $this->return_msg(400, '查询失败！');
        }
        $result['table_microbe'] = $micore;
        $result['table_microbe_host'] = $micore_host;
        $result['table_microbe_tax'] = $micore_tax;
        $this->return_msg(200, '查询成功！', $result);
    }

    public function update_microbe_info()
    {
        $params = Request::post();
        #$this->check_time($params['time']);
        #$this->check_token($params['token']);
        $data = $params['data'];
        $total1 = 0;
        $total2 = 0;
        $total3 = 0;

        $one = $data['table_microbe']['0'];
        $key_num1 = $one['microbe__microbe_id'];
        $special_key1 = ['microbe__microbe_id','microbe__shape_ref',
            'microbe__size_ref', 'microbe__nuc_type_ref',
            'microbe__transmission_route_ref'];
        foreach ($one as $key1=>$value1){
            if (in_array($key1,$special_key1)){
                $total1 = $total1 + 0;
            }else{
                $res1 = Db::table('iip_microbe')
                    ->where('microbe__microbe_id', $key_num1)
                    ->update([$key1 => $value1]);
                $total1 = $total1 + $res1; }
        }

        $two = $data['table_microbe_host']['0'];
        $key_num2 =$two['microbe_host__microbe_id'];
        $special_key2 = ['microbe_host__id','microbe_host__microbe_id',
            'microbe_host__host_ref'];
        foreach ($two as $key2=>$value2){
            if (in_array($key2,$special_key2)){
                $total2 = $total2 + 0;
            }else{
                $res2 = Db::table('iip_microbe_host')
                    ->where('microbe_host__microbe_id', $key_num2)
                    ->update([$key2 => $value2]);
                $total2 = $total2 + $res2; }
        }

        $three = $data['table_microbe_tax']['0'];
        $key_num3 =$three['microbe_tax__microbe_id'];
        $special_key3 = ['microbe_tax__microbe_id'];
        foreach ($three as $key3=>$value3){
            if (in_array($key3,$special_key3)){
                $total3 = $total3 + 0;
            }else{
                $res3 = Db::table('iip_microbe_tax')
                    ->where('microbe_tax__microbe_id', $key_num3)
                    ->update([$key3 => $value3]);
                $total3 = $total3 + $res3; }
        }

        $total = $total1 + $total2 + $total3;
        if($total==0){
            $this->return_msg('400','修改失败');
        }else{
            $this->return_msg('200','修改成功');
        }
    }
}
