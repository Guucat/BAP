<?php


namespace app\api\controller;


use think\Db;
use think\facade\Request;

class Antibody extends Common
{
    public function antibody_info()
    {
        $data = $this->params;
        $antibody = Db::table('iip_antibody')
            ->where('antibody__antibody_id', $data['antibody_id'])
            ->select();
        if (!$antibody) {
            $this->return_msg(400, '查询失败！');
        }
        $antibody_structure = Db::table('iip_antibody_structure')
            ->where('antibody_structure__antibody_id', $data['antibody_id'])
            ->select();
        if (!$antibody_structure) {
            $this->return_msg(400, '查询失败！');
        }
        /* $sequence = Db::table('iip_sequence')
             ->where('sequence__sequence_id', $antibody_structure[0]['antibody_structure__sequence_id'])
             ->select();*/
        $sequence = Db::query("select * from iip_sequence where sequence__sequence_id 
                in (select antibody_structure__sequence_id from iip_antibody_structure 
                where antibody_structure__antibody_id=1);");
        if (!$sequence) {
            $this->return_msg(400, '查询失败！');
        }
        $result['table_antibody'] = $antibody;
        $result['table_antibody_structure'] = $antibody_structure;
        $result['table_sequence'] = $sequence;

        $this->return_msg(200, '查询成功！', $result);
    }

    public function update_antibody_info()
    {
        //插入时必须要用主键作为insert的条件
        $params = Request::post();
        #$this->check_time($params['time']);
        #$this->check_token($params['token']);
        $data = $params['data'];
        $total1 = 0;
        $total2 = 0;
        $total3 = 0;

        $one = $data['table_antibody']['0'];
        $key_num1 = $one['antibody__antibody_id'];
        $special_key1 = ['antibody__antibody_id','antibody__microbe_id',
            'antibody__research_status_ref_id','antibody__research_status_ref_id',
            'antibody__antigen_antibody_affinity_ref_id',
            'antibody__antibody_screening_method_ref_id'];
        foreach ($one as $key1=>$value1){
            if (in_array($key1,$special_key1)){
                $total1 = $total1 + 0;
            }else{
                $res1 = Db::table('iip_antibody')
                    ->where('antibody__antibody_id', $key_num1)
                    ->update([$key1 => $value1]);
                $total1 = $total1 + $res1; }
        }

        $count2 = Db::table('iip_antibody_structure')
            ->where('antibody_structure__antibody_id',
                $data['table_antibody_structure'][0]['antibody_structure__antibody_id'])
            ->count();
        #dump($count);
        $flag2 = 0;
        do{
            $two = $data['table_antibody_structure'][$flag2];
            $key_num2 = $two['antibody_structure__antibody_stru_id'];
            $special_key2 = ['antibody_structure__antibody_id','antibody_structure__sequence_id',
                'antibody_structure__ref_id'];
            foreach ($two as $key2=>$value2){
                if (in_array($key2,$special_key2)){
                    $total2 = $total2 + 0;
                }else{
                    $res2 = Db::table('iip_antibody_structure')
                        ->where('antibody_structure__antibody_stru_id', $key_num2)
                        ->update([$key2 => $value2]);
                    $total2 = $total2 + $res2; }
            }
            $flag2 = $flag2 + 1;
        }while($flag2 <= $count2 - 1);

        $count3 = Db::table('iip_antibody_structure')
            ->where('antibody_structure__antibody_id',
                $data['table_antibody_structure'][0]['antibody_structure__antibody_id'])
            ->count();
        #dump($count);
        $flag3 = 0;
        do{
            $three = $data['table_sequence'][$flag3];
            $key_num3 = $three['sequence__sequence_id'];
            $special_key3 = ['sequence__sequence_id'];
            foreach ($three as $key3=>$value3){
                if (in_array($key3,$special_key3)){
                    $total3 = $total3 + 0;
                }else{
                    $res3 = Db::table('iip_sequence')
                        ->where('sequence__sequence_id', $key_num3)
                        ->update([$key3 => $value3]);
                    $total3 = $total3 + $res3; }
            }
            $flag3 = $flag3 + 1;
        }while($flag3 <= $count3 - 1);



        $total = $total1 + $total2 + $total3;
        if($total==0){
            $this->return_msg('400','修改失败');
        }else{
            $this->return_msg('200','修改成功');
        }
    }
}