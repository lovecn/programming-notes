//第一题https://post.zz173.com/detail_3sgV0gW_w9MFRX4PUqaldg.html
<?php
function test(){
 $a=1;
 $b=&$a;
 echo (++$a)+(++$a);
}
test();
//执行的值为6
//换种写法就等同于
$a=1;
$a=++$a; //2
$a=++$a; //3
$a=$a+$a;//3+3=6
?>

//第二题
<?php
function test(){
 $a=1;
 $b=&$a;
 echo (++$a)+(++$a)+(++$a);
}
test();
//执行的值为10
?>
