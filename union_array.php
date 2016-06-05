<?php
//https://segmentfault.com/q/1010000005636420
$arr1 = array(
    array('num'=>'500', 'id'=>'a1'),
    array('num'=>'300', 'id'=>'a2'),
    array('num'=>'200', 'id'=>'a3')
);

$arr2 = array(
    array('num'=>'400', 'id'=>'b1'),
    array('num'=>'200', 'id'=>'b2'),
    array('num'=>'200', 'id'=>'b3'),
    array('num'=>'100', 'id'=>'b4'),
    array('num'=>'100', 'id'=>'b5')
);

st($arr1, $arr2);

// 从$a往$b的水桶倒水 $a=>$b
function st($a, $b){
    $a_len = count($a);
    $b_len = count($b);
    $i = 0;   // $a的当前位置
    $j = 0;   // $b的当前位置
    $result = array();
    while( $i<$a_len && $j<$b_len ){
        $item_1 = $a[$i];
        $item_2 = $b[$j];
        $item = array();

        $item_1['num'] = intval( $item_1['num'] );
        $item_2['num'] = intval( $item_2['num'] );

        if( $item_2['num'] > $item_1['num'] ){
            // 当前b的水桶比a的大，把a倒完，再从a里取下一个水桶，因此$i++
            // num值为a的水桶里所有的水

            $item = array('aid'=>$item_1['id'], 'bid'=>$item_2['id'], 'num'=>$item_1['num']);
            $b[$j]['num'] -= $item_1['num']; // b的水桶还能倒的水
            $i++;
        }else if( $item_2['num'] < $item_1['num'] ){
            // 当前b的水桶小，会溢出来，因此b当前的这个桶就装满了。倒满之后再取一个桶，因此$j++
            // num值为b的体积

            $item = array('aid'=>$item_1['id'], 'bid'=>$item_2['id'], 'num'=>$item_2['num']);
            $a[$i]['num'] -= $item_2['num'];
            $j++;
        }else{
            $item = array('aid'=>$item_1['id'], 'bid'=>$item_2['id'], 'num'=>$item_2['num']);
            $i++;
            $j++;
        }
        array_push($result, $item);
    }
    echo "<pre>";
    print_r($result);
}
$arr = (
    array(aid=>'a1',bid=>'b1','num'=>'400'), //b1结束
    array(aid=>'a1',bid=>'b2','num'=>'100'),//a1的num值剩下的100 放到b2 a1结束
    array(aid=>'a2',bid=>'b2','num'=>'100'),//b2 差的100从a2里取 b2结束
    array(aid=>'a2',bid=>'b3','num'=>'100'),//a2 剩下的200 放到b3 a2结束 b3结束
    array(aid=>'a3',bid=>'b4','num'=>'100'),//a3 取100 给b4 b4结束
    array(aid=>'a2',bid=>'b5','num'=>'100'),//a3 上下的100 给b5 b5结束 a3结束
);
