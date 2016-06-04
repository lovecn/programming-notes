<?php
//( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F 运算符-的优先级要比&高,按位异或 减去本身 再进行的与运算，整体来看应该是( ( $g ^ ord( $a[ $f + 8 ] ) ) - $g )和0x1F进行与运算，
而0x1F就是十进制的31，取与的结果范围就限定在了0 - 31之间 
function make_coupon_card() {    
    $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';    
    $rand = $code[rand(0,25)]    
        .strtoupper(dechex(date('m')))    
        .date('d').substr(time(),-5)    
        .substr(microtime(),2,5)    
        .sprintf('%02d',rand(0,99));    
    for(    
        $a = md5( $rand, true ),    
        $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',    
        $d = '',    
        $f = 0;    
        $f < 8;        
        $g = ord( $a[ $f ] ),    
        $d .= $s[ ( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F ],    
        $f++    
    );    
    return $d;    
}  
