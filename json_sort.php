<?php
//取出level最大的role https://segmentfault.com/q/1010000000654057
$t = json_decode('{
    "data":[
            {"roleId":"qai41","role":"qai43","level":"45","sex":"0"},
            {"roleId":"qai41","role":"qai41","level":"78","sex":"0"},
            {"roleId":"qai41","role":"qai42","level":"44","sex":"0"}

          ]
}', true);
function levelSort($a, $b) {
    if($a['level'] == $b['level']) return 0;
    return ($a['level']<$b['level']) ? 1 : -1;
}

usort($t['data'], 'levelSort');
print_r($t['data'][0]['roleId']);

$str = '{
            "data":[
                    {"roleId":"qai41","role":"qai43","level":"45","sex":"0"},
                    {"roleId":"qai41","role":"qai41","level":"78","sex":"0"},
                    {"roleId":"qai41","role":"qai42","level":"44","sex":"0"}

                  ]
        }';
$arr = json_decode($str);
foreach ($arr->data as $k => $v) {
    $t[$v->level] = $v->role;//level做键，role做值
}
krsort($t);//按键逆序排序
$t = array_merge($t);//让键0打头
var_dump($t[0]);//第一个即最大的level的role
