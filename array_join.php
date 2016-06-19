<?php
https://segmentfault.com/q/1010000005739891数组如下 ：
[123,345,567,1235,6435,77,33,444,555,666,111,999,19,101,5542]

要求出所有用这个数组中的元素（三个）组成出的所有组合，组合例如下

123，345，567
1235,6435,77
33,444,555
666,111,999
111,999,19
$data = [123, 345, 567, 1235, 6435, 77, 33, 444, 444, 123, 555, 666, 111, 999, 19, 101, 5542];

// 生成
$items = generate($data);
foreach ($items as $item) {
    echo implode("\t", $item) . PHP_EOL;
}

function generate($data)
{
    // 排序
    sort($data);

    // 去重
    $data = array_unique($data);
    $data = array_values($data);

    // 打印原始字符串
    echo implode(", ", $data) . PHP_EOL . PHP_EOL;

    $items = [];
    for ($i = 0; $i < count($data); $i++) {
        for ($j = 0; $j < count($data); $j++) {
            if ($j == $i) {
                continue;
            }
            for ($k = 0; $k < count($data); $k++) {
                if ($k == $j || $k == $i) {
                    continue;
                }
                $items[] = [$data[$i], $data[$j], $data[$k]];
            }
        }
    }

    return $items;
}

$arr  = ['a', 'b', 'c'];
        $func = function($arr, $start, $arrLen) use (&$func){
            $arrN  = [];
            if ($start<$arrLen) {
                $arrN = $func($arr, $start+1, $arrLen);
                for($i=$start+1; $i<$arrLen; $i++) {
                    $tmp = $arr;
                    $tmp[$start]= $arr[$i];
                    $tmp[$i]= $arr[$start];
                    $arrN[] = $tmp;
                    $arrNN  = $func($tmp, $start+1, $arrLen);
                    $arrN   = array_merge($arrN, $arrNN); 
                }
            }
            return $arrN;
        };
        $res = array_merge([$arr], $func($arr, 0, count($arr))) ;
        $res = array_map(function($v){
            return implode('', $v);
        }, $res);
        var_dump(array_unique($res));
