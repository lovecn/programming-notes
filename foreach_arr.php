$a = array('a' => array('a'));
$b = array('b' => array('b'));

foreach ($b as $key => &$item) {
    $item[] = 'd';
}
$a = array_merge($b, $a);
$b['b'][] = 'c';
var_dump($a);
var_dump($b);
//变量b指向的一个引用类型,所以改了b的值,a中的b的值也随着变
array (size=2)
  'b' => &
    array (size=3)
      0 => string 'b' (length=1)
      1 => string 'd' (length=1)
      2 => string 'c' (length=1)
  'a' => 
    array (size=1)
      0 => string 'a' (length=1)
array (size=1)
  'b' => &
    array (size=3)
      0 => string 'b' (length=1)
      1 => string 'd' (length=1)
      2 => string 'c' (length=1)
