<?php


namespace app\api\controller;


use think\Db;
use think\facade\Request;

class Antigen extends Common
{
    public function antigen_info(){
        $data = $this->params;
        $antigen = Db::table('iip_antigen')
            ->where('antigen__antigen_id', $data['antigen_id'])
            ->select();
        if (!$antigen) {
            $this->return_msg(400, '查询失败！');
        }
        $antigen_modification = Db::table('iip_antigen_modification')
            ->where('antigen_modification__antigen_id', $data['antigen_id'])
            ->select();
        if (!$antigen_modification) {
            $this->return_msg(400, '查询失败！');
        }
        $antigen_epitope = Db::table('iip_antigen_epitope')
            ->where('antigen_epitope__antigen_id', $data['antigen_id'])
            ->select();
        if (!$antigen_epitope) {
            $this->return_msg(400, '查询失败！');
        }
        $antigen_property = Db::table('iip_antigen_property')
            ->where('antigen_property__antigen_id', $data['antigen_id'])
            ->select();
        if (!$antigen_property) {
            $this->return_msg(400, '查询失败！');
        }
        $antigen_protein_production = Db::table('iip_antigen_protein_production')
            ->where('antigen_protein_production__antigen_id', $data['antigen_id'])
            ->select();
        if (!$antigen_protein_production) {
            $this->return_msg(400, '查询失败！');
        }

        $antigen_mutation = Db::table('iip_antigen_mutation')
            ->where('antigen_mutation__antigen_id', $data['antigen_id'])
            ->select();
        if (!$antigen_mutation) {
            $this->return_msg(400, '查询失败！');
        }

        $result['table_antigen'] = $antigen;
        $result['table_antigen_modification'] = $antigen_modification;
        $result['table_antigen_epitope'] = $antigen_epitope;
        $result['table_antigen_property'] = $antigen_property;
        $result['table_antigen_protein_production'] = $antigen_protein_production;
        $result['table_antigen_mutation'] = $antigen_mutation;

        $this->return_msg(200, '查询成功！', $result);
    }


    public function update_antigen_info(){
        $params = Request::post();
        #$this->check_time($params['time']);
        #$this->check_token($params['token']);
        $data = $params['data'];
        $total1 = 0;
        $total2 = 0;
        $total3 = 0;
        $total4 = 0;
        $total5 = 0;
        $total6 = 0;

        $one = $data['table_antigen']['0'];
        $key_num1 = $one['antigen__antigen_id'];
        $special_key1 = ['antigen__antigen_id','antigen__microbe_id'];
        foreach ($one as $key1=>$value1){
            if (in_array($key1,$special_key1)){
                $total1 = $total1 + 0;
            }else{
                $res1 = Db::table('iip_antigen')
                    ->where('antigen__antigen_id', $key_num1)
                    ->update([$key1 => $value1]);
                $total1 = $total1 + $res1; }
        }

        $count2 = Db::table('iip_antigen_modification')
            ->where('antigen_modification__antigen_id',
                $data['table_antigen_modification'][0]['antigen_modification__antigen_id'])
            ->count();
        #dump($count);
        $flag2 = 0;
        do {
            $two = $data['table_antigen_modification'][$flag2];
            $key_num2 = $two['antigen_modification__antigen_id'];
            $special_key2 = ['antigen_modification__antigen_id', 'antigen_modification__receptor_id',
                'antigen_modification__modification_id', 'antigen_modification__antibody_id',
                'antigen_modification__ref_id'];
            foreach ($two as $key2 => $value2) {
                if (in_array($key2, $special_key2)) {
                    $total2 = $total2 + 0;
                } else {
                    $res2 = Db::table('iip_antigen_modification')
                        ->where('antigen_modification__antigen_id', $key_num2)
                        ->update([$key2 => $value2]);
                    $total2 = $total2 + $res2;
                }
                $flag2 = $flag2 + 1;
            }
        }while($flag2 <= $count2 - 1);

        $count3 = Db::table('iip_antigen_epitope')
            ->where('antigen_epitope__antigen_id',
                $data['table_antigen_epitope'][0]['antigen_epitope__antigen_id'])
            ->count();
        #dump($count);
        $flag3 = 0;
        do {
            $three = $data['table_antigen_epitope']['0'];
            $key_num3 = $three['antigen_epitope__antigen_id'];
            $special_key3 = ['antigen_epitope__antigen_id', 'antigen_epitope__antigen_epitope_id',
                'antigen_epitope__microbe_id', 'antigen_epitope__antibody_id',
                'antigen_epitope__ref_id'];
            foreach ($three as $key3 => $value3) {
                if (in_array($key3, $special_key3)) {
                    $total3 = $total3 + 0;
                } else {
                    $res3 = Db::table('iip_antigen_epitope')
                        ->where('antigen_epitope__antigen_id', $key_num3)
                        ->update([$key3 => $value3]);
                    $total3 = $total3 + $res3;
                }
                $flag3 = $flag3 + 1;
            }
        }while($flag3 <= $count3 - 1);

        $four = $data['table_antigen_property']['0'];
        $key_num4 = $four['antigen_property__antigen_id'];
        $special_key4 = ['antigen_property__antigen_id'];
        foreach ($four as $key4=>$value4){
            if (in_array($key4,$special_key4)){
                $total4 = $total4 + 0;
            }else{
                $res4 = Db::table('iip_antigen_property')
                    ->where('antigen_property__antigen_id', $key_num4)
                    ->update([$key4 => $value4]);
                $total4 = $total4 + $res4; }
        }

        $count5 = Db::table('iip_antigen_protein_production')
            ->where('antigen_protein_production__antigen_id',
                $data['table_antigen_protein_production'][0]['antigen_protein_production__antigen_id'])
            ->count();
        #dump($count);
        $flag5 = 0;
        do {
            $five = $data['table_antigen_protein_production']['0'];
            $key_num5 = $five['antigen_protein_production__antigen_id'];
            $special_key5 = ['antigen_protein_production__antigen_id', 'antigen_protein_production__APP_method_id',
                'antigen_protein_production__microbe_id', 'antigen_protein_production__expression_system_ref_id',
                'antigen_protein_production__purification_ref_id'];
            foreach ($five as $key5 => $value5) {
                if (in_array($key5, $special_key5)) {
                    $total5 = $total5 + 0;
                } else {
                    $res5 = Db::table('iip_antigen_protein_production')
                        ->where('antigen_protein_production__antigen_id', $key_num5)
                        ->update([$key5 => $value5]);
                    $total5 = $total5 + $res5;
                }
                $flag5 = $flag5 + 1;
            }
        }while($flag5 <= $count5 - 1);

        $count6 = Db::table('iip_antigen_mutation')
            ->where('antigen_mutation__antigen_id',
                $data['table_antigen_mutation'][0]['antigen_mutation__antigen_id'])
            ->count();
        #dump($count);
        $flag6 = 0;
        do {
            $six = $data['table_antigen_mutation']['0'];
            $key_num6 = $six['antigen_mutation__antigen_id'];
            $special_key6 = ['antigen_mutation__antigen_id', 'antigen_mutation__AM_id',
                'antigen_mutation__new_antibody_id', 'antigen_mutation__ref_id'];
            foreach ($six as $key6 => $value6) {
                if (in_array($key6, $special_key6)) {
                    $total6 = $total6 + 0;
                } else {
                    $res6 = Db::table('iip_antigen_mutation')
                        ->where('antigen_mutation__antigen_id', $key_num6)
                        ->update([$key6 => $value6]);
                    $total6 = $total6 + $res6;
                }
                $flag6 = $flag6 + 1;
            }
        }while($flag6 <= $count6 - 1);

        $total = $total1 + $total2 + $total3 + $total4 + $total5 + $total6;
        if($total==0){
            $this->return_msg('400','修改失败');
        }else{
            $this->return_msg('200','修改成功');
        }

    }
}