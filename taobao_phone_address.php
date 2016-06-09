<?php
    $res = file_get_contents('https://tcc.taobao.com/cc/json/mobile_tel_segment.htm?tel=15011923452');
    /*"__GetZoneResult_ = {
    mts:'1501192',
    province:'广东',
    catName:'中国移动',
    telString:'15011923452',
	areaVid:'30517',
	ispVid:'3236139',
	carrier:'广东移动'
}"*/
    $res = trim(explode('=',$res)[1]);
    $res = iconv('gbk','utf-8', $res);//在 Chrome 里打开接口地址，查看网络请求，可以看到 Reponse 中 content-type:application/javascript;charset=GBK json只支持utf-8编码
    $res = str_replace("'",'"', $res);
    $res = preg_replace('/(\w+):/is', '"$1":', $res);
    print_r(json_decode($res,1));
    /*Array
(
    [mts] => 1501192
    [province] => 广东
    [catName] => 中国移动
    [telString] => 15011923452
    [areaVid] => 30517
    [ispVid] => 3236139
    [carrier] => 广东移动
)*/
