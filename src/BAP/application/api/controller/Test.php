<?php


namespace app\api\controller;
use think\Db;
use think\facade\Request;

class Test extends Common
{

    public function hello(){

        echo "Hello";
    }

    public function test()
    {
        $data = Db::table('iip_source')->select();
        $this->return_msg(202, 'success', $data);
    }

    public function test_re()
    {

        $data = Request::post();
        dump($data['time']);
    }

    public function test_get()
    {
        $parms['microbe_id'] = 1;
        $micore = Db::table('iip_microbe')->where('microbe__microbe_id', $parms['microbe_id'])->select();
        $micore_host = Db::table('iip_microbe_host')->where('microbe_host__microbe_id', $parms['microbe_id'])->select();
        $micore_tax = Db::table('iip_microbe_tax')->where('microbe_tax__microbe_id', $parms['microbe_id'])->select();
        $data['1'] = $micore;
        $data['2'] = $micore_host;
        $data['3'] = $micore_tax;
        $this->return_msg(200, 'success', $data);

    }

    public function test_json()
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
        $special_key1 = ['microbe__microbe_id', 'microbe__shape_ref',
            'microbe__size_ref', 'microbe__nuc_type_ref',
            'microbe__transmission_route_ref'];
        foreach ($one as $key1 => $value1) {
            if (in_array($key1, $special_key1)) {
                $total1 = $total1 + 0;
            } else {
                $res1 = Db::table('iip_microbe')
                    ->where('microbe__microbe_id', $key_num1)
                    ->update([$key1 => $value1]);
                $total1 = $total1 + $res1;
            }
        }

        $two = $data['table_microbe_host']['0'];
        $key_num2 = $two['microbe_host__microbe_id'];
        $special_key2 = ['microbe_host__id', 'microbe_host__microbe_id',
            'microbe_host__host_ref'];
        foreach ($two as $key2 => $value2) {
            if (in_array($key2, $special_key2)) {
                $total1 = $total1 + 0;
            } else {
                $res2 = Db::table('iip_microbe_host')
                    ->where('microbe_host__microbe_id', $key_num2)
                    ->update([$key2 => $value2]);
                $total2 = $total2 + $res2;
            }
        }

        $three = $data['table_microbe_tax']['0'];
        $key_num3 = $three['microbe_tax__microbe_id'];
        $special_key3 = ['microbe_tax__microbe_id'];
        foreach ($three as $key3 => $value3) {
            if (in_array($key3, $special_key3)) {
                $total1 = $total1 + 0;
            } else {
                $res3 = Db::table('iip_microbe_tax')
                    ->where('microbe_tax__microbe_id', $key_num3)
                    ->update([$key3 => $value3]);
                $total3 = $total3 + $res3;
            }
        }

        $total = $total1 + $total2 + $total3;
        if ($total == 0) {
            $this->return_msg('400', '修改失败');
        } else {
            $this->return_msg('200', '修改成功');
        }


        /*dump($key);
        dump($value);
        dump($res1);
        $aaa = Db::name('CmsArchives')->getLastSql();
        echo $aaa;
        echo "<br>";*/

        //$result = '0';
        /*
      foreach ($one as $k=>$v) {
          $status = Db::name('iip_microbe')
              ->where('microbe__microbe_id', 1)
              ->update([$k => $v]);

            //if结果=1直接赋值
            if (status == 1) {
                $result = 1;
            }
        }
        if($result == 1){
            $data = ['status'=>1,'msg'=>'修改成功'];
        }else{
            $data = ['status'=>0,'msg'=>'修改失败'];
        }
        return json($data);
         */

        /*
        $res = Db::name('iip_microbe')
            ->where('microbe__microbe_id', 1)
            ->update(['microbe__standard_name' => '1111']);

        */
    }

    public function test_select()
    {
    $antibody_structure = Db::table('iip_antibody_structure')
        ->where('antibody_structure__antibody_id', 1)
        ->select();
    dump($antibody_structure);

    dump($antibody_structure[0]['antibody_structure__sequence_id']);

    }

    public function solve_bug(){
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

        /*$count = Db::table('iip_antibody_structure')
            ->where('antibody_structure__antibody_id', $data['antibody_id'])
            ->count();*/

        #echo ($count);
        #$n = 1;
        #$this->return_msg(200, '查询成功！', $result);

         /*$test = Db::query("select * from iip_sequence where sequence__sequence_id
                in (select antibody_structure__sequence_id from iip_antibody_structure 
                where antibody_structure__antibody_id=1);");*/

        $this->return_msg(200, '查询成功！', $result);
    }

    public function solve_bugg(){
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



        /*
        do{
            $one = $data['table_antibody_structure'][$n];
            $key_num1 = $one['antibody_structure__antibody_stru_id'];
            $special_key1 = ['antibody_structure__antibody_id','antibody_structure__sequence_id',
                'antibody_structure__ref_id'];
            foreach ($one as $key1=>$value1){
                if (in_array($key1,$special_key1)){
                    $total1 = $total1 + 0;
                }else{
                    $res1 = Db::table('iip_antibody_structure')
                        ->where('antibody_structure__antibody_stru_id', $key_num1)
                        ->update([$key1 => $value1]);
                    $total1 = $total1 + $res1; }
            }
            $n = $n + 1;
        }while($n < $count-1);
        */


        #$one = $data['table_antibody_structure'][$count];



        /*$key_num1 = $one['antigen__antigen_id'];
        $special_key1 = ['antigen__antigen_id','antigen__microbe_id'];
        foreach ($one as $key1=>$value1){
            if (in_array($key1,$special_key1)){
                $total1 = $total1 + 0;
            }else{
                $res1 = Db::table('iip_antigen')
                    ->where('antigen__antigen_id', $key_num1)
                    ->update([$key1 => $value1]);
                $total1 = $total1 + $res1; }
        }*/

    }
}
