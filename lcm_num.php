function xmzenger($n)
{
    //1和2的最小公倍数https://segmentfault.com/q/1010000005841270
    $res = 2;
    for ($i=1; $i <= $n; $i++) { 
        //$res为$a之前的数的最小公约数，赋予$b继续和$a求最小公倍数
        $a = $i;
        $b = $res;
        //$c为两数的乘积
        $c = $a * $b;
        //交换值使$a总是比$b大
        if($a < $b){
            $r = $a;
            $a = $b;
            $b = $r;
        }
        //辗转相除法求两个自然数的最大公约数
        while (true) {
            $r = $a % $b;
            //如果$r为0则$b为最大公约数
            if($r == 0){
                //小学学过的公式：“(a,b)[a,b]=ab(a,b均为整数)”
                $res = $c/$b;
                break;
            }else{
                $a = $b;
                $b = $r;
            }
        }
    }
 
    return $res;
}
 
echo xmzenger(10);
